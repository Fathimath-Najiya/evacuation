<?php
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    require_once "database.php";
    
    // Retrieve hashed password from the database
    $sql = "SELECT password FROM signup WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    
    if ($user) {
        // Hash the entered password for comparison
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Compare the hashed password from the database with the hashed entered password
        if (password_verify($password, $user['password'])) {
            // Passwords match, redirect to user dashboard
           echo "invalid password or username";
        } else {
            // Passwords don't match, show error message
            header("Location: userc.php");
            exit();
        }
    } else {
        // Username not found in the database, show error message
        echo "Invalid username or password";
    }
}
?>