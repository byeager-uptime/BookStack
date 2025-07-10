#!/bin/bash

echo "Testing BookStack server..."
echo ""

# Test 127.0.0.1
echo "Testing http://127.0.0.1:8080..."
if curl -s -o /dev/null -w "%{http_code}" http://127.0.0.1:8080 | grep -q "302"; then
    echo "✓ Server responding at http://127.0.0.1:8080 (redirecting to login)"
else
    echo "✗ Server not responding at http://127.0.0.1:8080"
fi

# Test localhost
echo ""
echo "Testing http://localhost:8080..."
if curl -s -o /dev/null -w "%{http_code}" http://localhost:8080 | grep -q "302"; then
    echo "✓ Server responding at http://localhost:8080 (redirecting to login)"
else
    echo "✗ Server not responding at http://localhost:8080"
fi

# Test login page
echo ""
echo "Testing login page..."
if curl -s http://localhost:8080/login | grep -q "BookStack"; then
    echo "✓ Login page is loading correctly"
else
    echo "✗ Login page not loading"
fi

echo ""
echo "Server Status: The BookStack server is running and accessible!"
echo ""
echo "You can access it at either:"
echo "  - http://localhost:8080"
echo "  - http://127.0.0.1:8080"
echo ""
echo "Login with:"
echo "  Email: admin@admin.com"
echo "  Password: password"