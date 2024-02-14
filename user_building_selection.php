<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get selected buildings
    $selected_buildings = $_POST['buildings']; // Array of selected building IDs
    
    // Store the user's building choices in the database
    require_once "database.php";
    $user_id = $_SESSION['user_id']; // Assuming you have a session variable for the user ID
    foreach ($selected_buildings as $building_id) {
        // Insert user's building choices into a separate table (e.g., user_buildings)
        $sql = "INSERT INTO user_buildings (user_id, building_id) VALUES ('$user_id', '$building_id')";
        mysqli_query($conn, $sql);
    }
    echo "success";
    // Redirect or show a success message
    header("Location: user_dashboard.php");
    exit();
}
?>

