<?php
if(isset($_POST['submit'])){
   $username = $_POST['username'];
   $password = $_POST['password'];
   $confirm_password = $_POST['confirm_password'];
   $passwordHash = password_hash($password, PASSWORD_DEFAULT);
   $errors = array();

   if(empty($username) || empty($password) || empty($confirm_password)){
      array_push($errors, "All fields are required");
   }
   
   if($password != $confirm_password){
      array_push($errors, "Passwords do not match");
   }

   require_once "database.php"; // Make sure this path is correct

   if(count($errors) == 0){
      // Check if the username already exists
      $sql = "SELECT * FROM signup WHERE username='$username'";
      $result = mysqli_query($conn, $sql);
      $rowCount = mysqli_num_rows($result);
      if($rowCount > 0){
         array_push($errors, "Username already exists");
      } else {
         // Insert new user into the database
         $sql = "INSERT INTO signup (username, password) VALUES (?, ?)";
         $stmt = mysqli_stmt_init($conn);
         if(mysqli_stmt_prepare($stmt, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $username, $passwordHash);
            if(mysqli_stmt_execute($stmt)){
               // User successfully registered
               header("Location: first.html"); // Redirect to a success page
               exit();
            } else {
               array_push($errors, "Error inserting user into database");
            }
         } else {
            array_push($errors, "SQL statement preparation failed");
         }
      }
   }
}
?>
