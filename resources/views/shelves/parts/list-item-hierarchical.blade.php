@php
    $indentLevel = $indentLevel ?? 0;
    $isRoom = $shelf->parent_id === null;
@endphp

<div class="entity-list-item" style="padding-left: {{ $indentLevel * 20 }}px;">
    @if($indentLevel > 0)
        <span class="text-muted">↳</span>
    @endif
    @if($isRoom)
        <div class="badge badge-primary" style="display: inline-block; margin-right: 5px;">Room</div>
    @endif
    @include('shelves.parts.list-item', ['shelf' => $shelf])
</div>

@if($shelf->visibleChildren->count() > 0)
    @foreach($shelf->visibleChildren as $childShelf)
        @include('shelves.parts.list-item-hierarchical', ['shelf' => $childShelf, 'indentLevel' => $indentLevel + 1])
    @endforeach
@endif