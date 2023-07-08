<?php
function fetch_options_adv(mysqli $conn, string $column, string $table,string $selectedValue) {
    
    
    // Construct the SQL query with a WHERE clause to exclude the selected value
    $sql = "SELECT $column FROM $table WHERE $column <> ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $selectedValue);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $value = $row[$column];
        if ($value === $selectedValue) {
            continue;
        }
        echo "<option value='$value'>$value</option>";
    }
}