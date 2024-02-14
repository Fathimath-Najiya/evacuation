<?php
if(isset($_POST['submit'])){
   require_once "database.php";

   $building_names = $_POST['building_name'];
   $addresses = $_POST['address'];
   $errors = array();

   // Check if fields are empty
   if(empty($building_names) || empty($addresses)){
      array_push($errors, "All fields are required");
   }
 
   // You may add additional validations here if needed

   if(count($errors) == 0){
      // Loop through each building registration
      for($i = 0; $i < count($building_names); $i++) {
         $building_name = mysqli_real_escape_string($conn, $building_names[$i]);
         $address = mysqli_real_escape_string($conn, $addresses[$i]);

         // Check if the building already exists
         $check_query = "SELECT * FROM buildings WHERE building_name='$building_name'";
         $result = mysqli_query($conn, $check_query);
         $rowCount = mysqli_num_rows($result);
         if($rowCount > 0){
            array_push($errors, "Building name '$building_name' already registered");
         } else {
            // Insert building data into database
            $sql = "INSERT INTO buildings (building_name, address) VALUES ('$building_name', '$address')";
            if(mysqli_query($conn, $sql)){
               echo "Building registered successfully: $building_name at $address<br>";
            } else {
               array_push($errors, "Error: " . $sql . "<br>" . mysqli_error($conn));
            }
         }
      }
   } else {
      foreach($errors as $error) {
         echo $error . "<br>";
      }
   }

   mysqli_close($conn);
}
?>
