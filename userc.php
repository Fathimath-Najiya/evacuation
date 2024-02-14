<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Building Selection</title>
    <link rel="stylesheet" href="stylec.css">
</head>
<body>
    <div class="container">
        <h2>Choose Buildings</h2>
        <form action="user_building_selection.php" method="POST">
            <label for="buildings">Select Buildings:</label><br>
            <?php
            // Fetch buildings from the database
            require_once "database.php";
            $sql = "SELECT * FROM buildings";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<input type="checkbox" id="building_' . $row['building_id'] . '" name="buildings[]" value="' . $row['building_id'] . '">';
                    echo '<label for="building_' . $row['building_id'] . '">' . $row['building_name'] . ' - ' . $row['address'] . '</label><br>';
                }
            } else {
                echo "No buildings available.";
            }
            ?>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>
