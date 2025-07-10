#!/bin/bash

echo "Starting BookStack development environment..."
echo ""

# Check if MySQL is running
if ! brew services list | grep -q "mysql.*started"; then
    echo "Starting MySQL..."
    brew services start mysql
else
    echo "MySQL is already running"
fi

echo ""
echo "Starting Laravel development server on http://127.0.0.1:8080"
echo ""
echo "Default login credentials:"
echo "  Email: admin@admin.com"
echo "  Password: password"
echo ""
echo "Press Ctrl+C to stop the server"
echo ""

php artisan serve --host=127.0.0.1 --port=8080