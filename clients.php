<?php

$servername = "localhost";
$username = "root"; // Change to your database username
$password = ""; // Change to your database password
$dbname = "clientsdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to create table
$sql = "CREATE TABLE IF NOT EXISTS Myclients (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "";
} else {
    echo "Error creating table: " . $conn->error;
}
// Fetch data from the table
$sql = "SELECT id, firstname, lastname, email, reg_date FROM Myclients";
$result = $conn->query($sql);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class="flex place-content-between bg-blue-500">
        <div class="text-xl m-4 h-8 w-32 ">
          E-BANK
        </div>
        <div>
            <ul class="flex flex space-x-16 text-xl m-4 text-center items-center">
                <li
                    class="bg-transparent text-white hover:bg-blue-600  transition ease-out duration-700 h-8 w-32">
                    <a href="clients.php">clients</a>
                </li>
                <li
                    class="bg-transparent text-white hover:bg-blue-600 transition ease-out duration-700 h-8 w-32">
                    <a href="account.php"> accounts</a>
                </li>
                <li
                    class="bg-transparent text-white hover:bg-blue-600  transition ease-out duration-700 h-8 w-32">
                    <a href="transaction.php">transactions</a>
                </li>
            </ul>
        </div>
    </div>
    <h1 class="text-xl m-4 h-8 w-32 ">Client List</h1>

    <?php
    if ($result->num_rows > 0) {
        echo '<table class="table-auto w-full bg-black text-white border border-white">';
        echo '<tr>
                <th class="border border-white">ID</th>
                <th class="border border-white">First Name</th>
                <th class="border border-white">Last Name</th>
                <th class="border border-white">Email</th>
                <th class="border border-white">Registration Date</th>
                <th class="border border-white">Accounts</th>
            </tr>';

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td class=\"border border-white\">" . $row["id"] . "</td>
                <td class=\"border border-white\">" . $row["firstname"] . "</td>
                <td class=\"border border-white\">" . $row["lastname"] . "</td>
                <td class=\"border border-white\">" . $row["email"] . "</td>
                <td class=\"border border-white\">" . $row["reg_date"] . "</td>
                <td class=\"border border-white\">
                <a href=\"account.php?id=" . $row["id"] . "\">View Details</a>
            </td>
            </tr>";
        }

        echo '</table>';
    } else {
        echo "0 results";
    }
    ?>
</body>

</html>