<?php
$servername = "localhost";
$username = "root"; // Change to your database username
$password = ""; // Change to your database password
$dbname = "clientsdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname); // Include $dbname in the connection

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO Myclients (firstname, lastname, email)
VALUES ('harry', 'mag', 'harry@gmail.com')";

if ($conn->query($sql) === TRUE) {
    
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();
?>