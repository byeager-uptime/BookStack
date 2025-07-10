# BookStack Backup Repository

This repository contains backups of a BookStack installation, including configuration, customizations, and user-uploaded content.

## What's Included

- **Application Code**: All BookStack source files and customizations
- **Themes**: Any custom themes in `/themes` directory
- **User Uploads**: Images and files uploaded by users (`/storage/uploads/`)
- **Configuration Files**: Non-sensitive configuration files
- **Database Backups**: Compressed SQL dumps in `/storage/backups/`
- **Custom Scripts**: Any custom scripts or modifications

## What's Excluded

- `.env` file (contains sensitive credentials - backup separately!)
- Vendor directories (`/vendor`, `/node_modules`)
- Cache and session files
- Compiled assets (can be rebuilt)
- Log files

## Backup Process

1. Run the backup script: `./backup.sh`
2. Commit changes to git
3. Push to GitHub

## Restore Process

1. **Install BookStack** on the target server
2. **Clone this repository** to the server
3. **Restore .env file** from secure backup
4. **Restore database**:
   ```bash
   gunzip < storage/backups/[latest-backup].sql.gz | mysql -u[user] -p [database]
   ```
5. **Install dependencies**:
   ```bash
   composer install --no-dev
   npm install
   npm run production
   ```
6. **Set permissions**:
   ```bash
   chown -R www-data:www-data storage bootstrap/cache
   chmod -R 755 storage bootstrap/cache
   ```
7. **Run migrations**:
   ```bash
   php artisan migrate
   ```
8. **Clear caches**:
   ```bash
   php artisan cache:clear
   php artisan config:clear
   php artisan view:clear
   ```

## Security Notes

- **NEVER commit .env file** - it contains database passwords and app keys
- Keep this repository private if it contains sensitive user data
- Regularly rotate database backups
- Test restore process periodically

## Maintenance

- Run `./backup.sh` before major updates
- The script keeps only the last 5 database backups to save space
- Monitor repository size - consider using Git LFS for large files