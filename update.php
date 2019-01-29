<?php

include 'db.php';

// Update objects
if (isset($_POST['drag_id']) && isset($_POST['drop_id'])) {
    $drag_id = $_POST['drag_id'];
    $drop_id = $_POST['drop_id'];

    $replace_object = array_replace($objects,
        array_fill_keys(
            array_keys($objects, $drag_id),
            $drop_id
        )
    );
    $new_objects = implode(',', $replace_object);
    $update_sql = "UPDATE box SET objects='".$new_objects."' WHERE id=1";
    $result = $mysqli->query($update_sql);

    return $result;
}

// Add row
if (isset($_POST['add_row'])) {
    $add_row = $_POST['add_row'];
    $new_row_column = ($row+$add_row).'x'.$column;

    $update_sql = "UPDATE box SET row_column='".$new_row_column."' WHERE id=1";
    $result = $mysqli->query($update_sql);

    return $result;
}

// Add column
if (isset($_POST['add_column'])) {
    $add_column = $_POST['add_column'];
    $new_row_column = $row.'x'.($column+$add_column);

    $update_sql = "UPDATE box SET row_column='".$new_row_column."' WHERE id=1";
    $result = $mysqli->query($update_sql);

    return $result;
}


