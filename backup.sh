#!/bin/bash

# BookStack Backup Script
# This script creates a database backup and prepares files for git backup

set -e

# Colors for output
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

echo -e "${GREEN}Starting BookStack backup...${NC}"

# Get the directory where the script is located
SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
cd "$SCRIPT_DIR"

# Load environment variables
if [ -f .env ]; then
    export $(cat .env | grep -v '^#' | xargs)
else
    echo -e "${RED}Error: .env file not found!${NC}"
    exit 1
fi

# Create backup directory if it doesn't exist
BACKUP_DIR="storage/backups"
mkdir -p "$BACKUP_DIR"

# Backup database
echo -e "${YELLOW}Backing up database...${NC}"
DB_BACKUP_FILE="$BACKUP_DIR/bookstack_db_$(date +%Y%m%d_%H%M%S).sql"

# Check if database credentials are set
if [ -z "$DB_DATABASE" ] || [ -z "$DB_USERNAME" ]; then
    echo -e "${RED}Error: Database credentials not found in .env file!${NC}"
    exit 1
fi

# Create database backup
if [ -z "$DB_PASSWORD" ]; then
    mysqldump -h "$DB_HOST" -u "$DB_USERNAME" "$DB_DATABASE" > "$DB_BACKUP_FILE"
else
    mysqldump -h "$DB_HOST" -u "$DB_USERNAME" -p"$DB_PASSWORD" "$DB_DATABASE" > "$DB_BACKUP_FILE"
fi

# Compress the backup
gzip "$DB_BACKUP_FILE"
echo -e "${GREEN}Database backup created: ${DB_BACKUP_FILE}.gz${NC}"

# Keep only the last 5 database backups
echo -e "${YELLOW}Cleaning old database backups...${NC}"
ls -t "$BACKUP_DIR"/*.sql.gz 2>/dev/null | tail -n +6 | xargs -r rm

# Create a backup info file
echo -e "${YELLOW}Creating backup info file...${NC}"
cat > "$BACKUP_DIR/backup_info.txt" << EOF
BookStack Backup Information
============================
Date: $(date)
BookStack URL: $APP_URL
Database: $DB_DATABASE
Latest DB Backup: $(basename "$DB_BACKUP_FILE").gz

Important Directories:
- /storage/uploads/images - User uploaded images
- /storage/uploads/files - User uploaded files
- /public/uploads - Public uploads (if any)
- /themes - Custom themes
- /.env - Configuration (backup separately, contains sensitive data)

To restore:
1. Install BookStack
2. Copy .env file
3. Restore database: gunzip < backup.sql.gz | mysql -u[user] -p [database]
4. Copy storage/uploads directory
5. Run: php artisan key:generate (if needed)
6. Run: php artisan migrate
7. Clear cache: php artisan cache:clear
EOF

echo -e "${GREEN}Backup preparation complete!${NC}"
echo -e "${YELLOW}Next steps:${NC}"
echo "1. Review and copy .gitignore.backup to .gitignore if needed"
echo "2. Add files to git: git add -A"
echo "3. Commit changes: git commit -m 'Backup BookStack $(date +%Y-%m-%d)'"
echo "4. Push to GitHub: git push origin main"
echo ""
echo -e "${YELLOW}Important:${NC} The .env file contains sensitive data and is excluded from git."
echo "Make sure to backup .env file separately and securely!"