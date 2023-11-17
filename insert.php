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
VALUES ('ELH Z', 'DZ', 'joZUGV.com')";

$sql2 = "INSERT INTO accounts (rib, balance, currency,client_id)
VALUES ('3876397369773',0, 'Dolar',2)";

$insertTransaction = "INSERT into transactions (amount, currency, transactio_type, client_fk) VALUES (1000, '$', 'debit', 1)";
$insertResult = $conn->query($insertTransaction);

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
if ($conn->query($sql2) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

if ($conn->query($insertTransaction) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $insertTransaction . "<br>" . $conn->error;
}

$conn->close();
?>
