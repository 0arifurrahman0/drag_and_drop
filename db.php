<?php

$mysqli = new mysqli('localhost','root','','drag_drop');

if ($mysqli->connect_error) {
    printf('Connect failed: %s\n', $mysqli->connect_error);
    exit();
}

// Show row, column, object
$query = "SELECT * FROM box LIMIT 1";
$result = $mysqli->query($query)->fetch_assoc();
$row_column = explode('x', $result['row_column']);
$row = $row_column[0];
$column = $row_column[1];
$objects = explode(',', $result['objects']);
