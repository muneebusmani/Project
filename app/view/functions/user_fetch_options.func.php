<?php
function fetch_options(mysqli $conn,string $column,string $table) {
    // Construct the SQL query
    $sql = "SELECT $column FROM $table";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $value = $row[$column];
        echo "<option value='$value'>$value</option>";
    }
}

