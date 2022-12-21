<?php
// Make sure that the request is a POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Validate the request data (email, phone, password, confirm password)
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // Check if the password and confirm password fields match
  if ($password != $confirm_password) {
    // Return an error message if the passwords do not match
    echo "Error: Passwords do not match";
    exit;
  }

  // Validate the other fields (email, phone) as necessary

  // Connect to the database
  $conn = mysqli_connect("host", "username", "password", "database");

  // Check the connection
  if (!$conn) {
    echo "Error: Unable to connect to database";
    exit;
  }

  // Insert the new user into the database
  $sql = "INSERT INTO users (email, phone, password) VALUES (?, ?, ?)";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "sss", $email, $phone, $password);
  if (mysqli_stmt_execute($stmt)) {
    // Return a success message if the user was created successfully
    echo "Success: User created successfully";
  } else {
    // Return an error message if there was a problem creating the user
    echo "Error: Unable to create user";
  }
}
?>
