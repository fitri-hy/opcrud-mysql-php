<?php
// Function to execute insert query
function createData($mysqli, $table, $data) {
    $columns = implode(", ", array_keys($data));
    $values = implode(", ", array_fill(0, count($data), "?"));
    
    $sql = "INSERT INTO $table ($columns) VALUES ($values)";
    $stmt = $mysqli->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param(str_repeat('s', count($data)), ...array_values($data));
        $stmt->execute();
        $stmt->close();
        return true;
    }
    return false;
}

// Function to retrieve data
function readData($mysqli, $table, $conditions = []) {
    $sql = "SELECT * FROM $table";
    
    if (!empty($conditions)) {
        $sql .= " WHERE " . implode(" AND ", array_map(function($col) {
            return "$col = ?";
        }, array_keys($conditions)));
    }
    
    $stmt = $mysqli->prepare($sql);
    
    if ($stmt) {
        if (!empty($conditions)) {
            $stmt->bind_param(str_repeat('s', count($conditions)), ...array_values($conditions));
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $data;
    }
    return [];
}

// Function to update data
function updateData($mysqli, $table, $data, $conditions) {
    $setClause = implode(", ", array_map(function($col) {
        return "$col = ?";
    }, array_keys($data)));
    
    $whereClause = implode(" AND ", array_map(function($col) {
        return "$col = ?";
    }, array_keys($conditions)));
    
    $sql = "UPDATE $table SET $setClause WHERE $whereClause";
    $stmt = $mysqli->prepare($sql);
    
    if ($stmt) {
        $params = array_merge(array_values($data), array_values($conditions));
        $stmt->bind_param(str_repeat('s', count($params)), ...$params);
        $stmt->execute();
        $stmt->close();
        return true;
    }
    return false;
}

// Function to delete data
function deleteData($mysqli, $table, $conditions) {
    $whereClause = implode(" AND ", array_map(function($col) {
        return "$col = ?";
    }, array_keys($conditions)));
    
    $sql = "DELETE FROM $table WHERE $whereClause";
    $stmt = $mysqli->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param(str_repeat('s', count($conditions)), ...array_values($conditions));
        $stmt->execute();
        $stmt->close();
        return true;
    }
    return false;
}

// Function to read data with JOIN
function readDataWithJoin($mysqli, $table1, $table2, $joinCondition, $fields = "*", $conditions = []) {
    $fieldList = is_array($fields) ? implode(", ", $fields) : $fields;
    
    $sql = "SELECT $fieldList FROM $table1 JOIN $table2 ON $joinCondition";
    
    if (!empty($conditions)) {
        $sql .= " WHERE " . implode(" AND ", array_map(function($col) {
            return "$col = ?";
        }, array_keys($conditions)));
    }
    
    $stmt = $mysqli->prepare($sql);
    
    if ($stmt) {
        if (!empty($conditions)) {
            $stmt->bind_param(str_repeat('s', count($conditions)), ...array_values($conditions));
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $data;
    }
    return [];
}
?>
