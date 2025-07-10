<?php

namespace BookStack\Entities\Repos;

use BookStack\Activity\ActivityType;
use BookStack\Entities\Models\Bookshelf;
use BookStack\Entities\Queries\BookQueries;
use BookStack\Entities\Tools\TrashCan;
use BookStack\Facades\Activity;
use BookStack\Util\DatabaseTransaction;
use Exception;
use Illuminate\Validation\ValidationException;

class BookshelfRepo
{
    public function __construct(
        protected BaseRepo $baseRepo,
        protected BookQueries $bookQueries,
        protected TrashCan $trashCan,
    ) {
    }

    /**
     * Create a new shelf in the system.
     */
    public function create(array $input, array $bookIds): Bookshelf
    {
        return (new DatabaseTransaction(function () use ($input, $bookIds) {
            $shelf = new Bookshelf();
            
            // Validate parent shelf if provided
            if (!empty($input['parent_id'])) {
                $this->validateParentShelf($input['parent_id']);
                $parentShelf = Bookshelf::find($input['parent_id']);
                $input['depth'] = $parentShelf ? $parentShelf->depth + 1 : 0;
            } else {
                $input['parent_id'] = null;
                $input['depth'] = 0;
            }
            
            $this->baseRepo->create($shelf, $input);
            $this->baseRepo->updateCoverImage($shelf, $input['image'] ?? null);
            $this->updateBooks($shelf, $bookIds);
            Activity::add(ActivityType::BOOKSHELF_CREATE, $shelf);
            return $shelf;
        }))->run();
    }

    /**
     * Update an existing shelf in the system using the given input.
     */
    public function update(Bookshelf $shelf, array $input, ?array $bookIds): Bookshelf
    {
        // Validate parent change if parent_id is being updated
        if (array_key_exists('parent_id', $input)) {
            $this->validateParentChange($shelf, $input['parent_id']);
            
            // Update depth based on new parent
            if (!empty($input['parent_id'])) {
                $parentShelf = Bookshelf::find($input['parent_id']);
                $input['depth'] = $parentShelf ? $parentShelf->depth + 1 : 0;
            } else {
                $input['parent_id'] = null;
                $input['depth'] = 0;
            }
            
            // Update depth of all descendants
            $this->updateDescendantDepths($shelf);
        }
        
        $this->baseRepo->update($shelf, $input);

        if (!is_null($bookIds)) {
            $this->updateBooks($shelf, $bookIds);
        }

        if (array_key_exists('image', $input)) {
            $this->baseRepo->updateCoverImage($shelf, $input['image'], $input['image'] === null);
        }

        Activity::add(ActivityType::BOOKSHELF_UPDATE, $shelf);

        return $shelf;
    }

    /**
     * Update which books are assigned to this shelf by syncing the given book ids.
     * Function ensures the books are visible to the current user and existing.
     */
    protected function updateBooks(Bookshelf $shelf, array $bookIds)
    {
        $numericIDs = collect($bookIds)->map(function ($id) {
            return intval($id);
        });

        $syncData = $this->bookQueries->visibleForList()
            ->whereIn('id', $bookIds)
            ->pluck('id')
            ->mapWithKeys(function ($bookId) use ($numericIDs) {
                return [$bookId => ['order' => $numericIDs->search($bookId)]];
            });

        $shelf->books()->sync($syncData);
    }

    /**
     * Remove a bookshelf from the system.
     *
     * @throws Exception
     */
    public function destroy(Bookshelf $shelf)
    {
        $this->trashCan->softDestroyShelf($shelf);
        Activity::add(ActivityType::BOOKSHELF_DELETE, $shelf);
        $this->trashCan->autoClearOld();
    }

    /**
     * Validate that a parent shelf is valid.
     *
     * @throws ValidationException
     */
    protected function validateParentShelf(?int $parentId): void
    {
        if (empty($parentId)) {
            return;
        }

        $parentShelf = Bookshelf::find($parentId);
        if (!$parentShelf) {
            throw ValidationException::withMessages([
                'parent_id' => ['The selected parent shelf does not exist.']
            ]);
        }
    }

    /**
     * Validate that changing a shelf's parent won't create a circular reference.
     *
     * @throws ValidationException
     */
    protected function validateParentChange(Bookshelf $shelf, ?int $newParentId): void
    {
        if (empty($newParentId)) {
            return;
        }

        // Can't be its own parent
        if ($shelf->id === $newParentId) {
            throw ValidationException::withMessages([
                'parent_id' => ['A shelf cannot be its own parent.']
            ]);
        }

        // Check if the new parent is a descendant of the current shelf
        $descendants = $shelf->descendants()->pluck('id')->toArray();
        if (in_array($newParentId, $descendants)) {
            throw ValidationException::withMessages([
                'parent_id' => ['Cannot move a shelf under one of its own descendants.']
            ]);
        }

        $this->validateParentShelf($newParentId);
    }

    /**
     * Update the depth of all descendant shelves after a parent change.
     */
    protected function updateDescendantDepths(Bookshelf $shelf): void
    {
        $descendants = $shelf->descendants();
        
        foreach ($descendants as $descendant) {
            $ancestors = $descendant->ancestors();
            $descendant->depth = $ancestors->count();
            $descendant->save();
        }
    }
}
