# OpCRUD PHP Mysqli

This project provides efficient functions for data handling, making it easy to perform CRUD operations with a MySQL database in PHP.

## Features

- Simple and intuitive CRUD operations
- Secure data handling using prepared statements
- Supports dynamic query building
- Easy integration into existing PHP applications

## Usage

**Connection**

```
<?php
    $host = "localhost";
    $username = "user_database";
    $password = "password_database";
    $database = "name_database";
    
    $mysqli = new mysqli($host, $username, $password, $database);
    
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
?>
```

**Create**

```
<?php
    include 'opcrud.php';
    
    $data = [
        "username" => "john_doe",
        "email" => "john@example.com"
    ];
    
    if (createData($mysqli, "users", $data)) {
        echo "Data added successfully.";
    } else {
        echo "Failed to add data.";
    }
?>
```

**Read**

```
<?php
    include 'opcrud.php';
    
    $conditions = [
    "username" => "john_doe"
    ];
    
    $result = readData($mysqli, "users", $conditions);
    print_r($result);
?>
```

**Update**

```
<?php
    include 'opcrud.php';
    
    $data = [
        "email" => "john.doe@example.com"
    ];
    $conditions = [
        "username" => "john_doe"
    ];
    
    if (updateData($mysqli, "users", $data, $conditions)) {
        echo "Data updated successfully.";
    } else {
        echo "Failed to update data.";
    }
?>
```

**Delete**

```
<?php
    include 'opcrud.php';
    
   $conditions = [
        "username" => "john_doe"
    ];
    
    if (deleteData($mysqli, "users", $conditions)) {
        echo "Data deleted successfully.";
    } else {
        echo "Failed to delete data.";
    }
?>
```

**Read with Join**

```
<?php
    include 'opcrud.php';
    
    $joinCondition = "users.id = orders.user_id"; 
    
    $fields = ["users.username", "orders.product_id"];
    $conditions = [
        "users.username" => "john_doe"
    ];
    
    $result = readDataWithJoin($mysqli, "users", "orders", $joinCondition, $fields, $conditions);
    print_r($result);
?>
```

- OpCRUD MySQL: [Express.js Version](https://www.npmjs.com/package/opcrud-mysql)
