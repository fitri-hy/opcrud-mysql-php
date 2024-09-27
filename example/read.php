<?php
include 'config/database.php';
include 'core/opcrud.php';

$data = readData($mysqli, 'user');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read</title>
</head>
<body>
    <h2>Read Data</h2>
		<?php
		foreach ($data as $row) {
		?>
			<li>Username: <?php echo $row['username'] ?>, Email: <?php echo $row['email'] ?></li>
		<?php } ?>
    <ul>
	
	</ul>
</body>
</html>
