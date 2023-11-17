<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clientsdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "CREATE TABLE IF NOT EXISTS transactions (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    amount INT NOT NULL,
    currency varchar(10) NOT NULL,
    transactio_type VARCHAR(50),
    transaction_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    client_fk INT
)";


// Fetch client data
if (isset($_GET['id'])) {
    $clientID = $_GET['id'];

    $sql = "SELECT id, firstname, lastname, email FROM myclients WHERE id = $clientID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $clientData = $result->fetch_assoc();
    } else {
        echo "Client not found";
        // exit();
    }

    // Fetch transactions data for the client (Assuming you have a 'transactions' table)
    $sqlTransactions = "SELECT id, amount, currency, transactio_type FROM transactions WHERE client_fk = $clientID;";
    $resultTransactions = $conn->query($sqlTransactions);
} else {
    echo "Client ID not provided";
    // exit();
}

// $conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $clientData['firstname'] . ' ' . $clientData['lastname']; ?>'s Transactions</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class="flex place-content-between bg-blue-500">
        <div class="text-xl m-4 h-8 w-32">
            E-BANK
        </div>
        <div>
            <ul class="flex flex space-x-16 text-xl m-4 text-center items-center">
                <li class="bg-transparent text-white hover:bg-blue-600 transition ease-out duration-700 h-8 w-32">
                    <a href="clients.php">clients</a>
                </li>
                <li class="bg-transparent text-white hover-bg-blue-600 transition ease-out duration-700 h-8 w-32">
                    <a href="account.php"> accounts</a>
                </li>
                <li class="bg-transparent text-white hover-bg-blue-600 transition ease-out duration-700 h-8 w-32">
                    <a href="transaction.php">transactions</a>
                </li>
            </ul>
        </div>
    </div>

    <h1 class="text-xl m-4"><?php echo $clientData['firstname'] . ' ' . $clientData['lastname']; ?>'s Transactions</h1>

    <p>Email: <?php echo $clientData['email']; ?></p>

    <?php
    if ($resultTransactions->num_rows > 0) {
        echo "<table class='table-auto w-full bg-black text-white border border-white'>";
        echo "<tr>
                <th class='border border-white'>ID</th>
                <th class='border border-white'>Amount</th>
                <th class='border border-white'>Currency</th>                
                <th class='border border-white'>Type</th>
            </tr>";

        // Output data of each row
        while ($row = $resultTransactions->fetch_assoc()) {
            echo "<tr>
                    <td class='border border-white'>" . $row["id"] . "</td>
                    <td class='border border-white'>" . $row["amount"] . "</td>
                    <td class='border border-white'>" . $row["currency"] . "</td>
                    <td class='border border-white'>" . $row["type"] . "</td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "<p>This client has no transactions.</p>";
    }
    ?>
</body>

</html>
