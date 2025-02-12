<?php
require_once 'Database.php';

try {
    $db = new Database();
    echo "Database connection successful!\n";
    
    // Test a simple query
    $db->query("SELECT current_timestamp");
    $result = $db->fetch();
    echo "Current database timestamp: " . print_r($result, true);
    
} catch (Exception $e) {
    echo "Connection failed: " . $e->getMessage();
}