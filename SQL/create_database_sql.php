<?php

// Path: SQL/doan1j2school.sql
$filename = 'doan1j2school.sql';
// MySQL host
$mysql_host = 'localhost';
// MySQL username
$mysql_username = 'root';
// MySQL password
$mysql_password = '';
// Database name
$mysql_database = 'doan1j2school';

// Connect to MySQL server
$conn = mysqli_connect($mysql_host, $mysql_username, $mysql_password);
if (!$conn) {
    die('Failed to connect to MySQL server: ' . mysqli_connect_error());
}
// Drop database
$sql = 'DROP DATABASE IF EXISTS ' . $mysql_database;
if (mysqli_query($conn, $sql)) {
    echo 'Database dropped successfully <br />';
} else {
    echo 'Error dropping database: ' . mysqli_error($conn) .'<br />';
}
// Create database
$sql = 'CREATE DATABASE ' . $mysql_database;
if (mysqli_query($conn, $sql)) {
    echo 'Database created successfully <br />';
} else {
    echo 'Error creating database: ' . mysqli_error($conn);
}
// Use database
$sql = 'USE ' . $mysql_database;
if (mysqli_query($conn, $sql)) {
    echo 'Database selected successfully <br />';
} else {
    echo 'Error selecting database: ' . mysqli_error($conn);
}

// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line) {
    // Skip it if it's a comment
    if (substr($line, 0, 2) == '--' || $line == '')
        continue;
    // Add this line to the current segment
    $templine .= $line;
    // If it has a semicolon at the end, it's the end of the query
    if (substr(trim($line), -1, 1) == ';') {
        // Perform the query
        mysqli_query($conn, $templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysqli_error($conn) . '<br /><br />');
        // Reset temp variable to empty
        $templine = '';
    }
}
echo 'Database imported successfully';
// Close connection
mysqli_close($conn);
