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

// Check if the accounts table exists
$tableCheckSql = "SHOW TABLES LIKE 'accounts'";
$tableCheckResult = $conn->query($tableCheckSql);

if ($tableCheckResult === false) {
    // Handle the query error
    echo "Error checking table existence: " . $conn->error;
    exit();
}

if ($tableCheckResult->num_rows === 0) {
    // Create accounts table if it doesn't exist
    $createTableSql = "CREATE TABLE accounts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        rib VARCHAR(16) UNIQUE NOT NULL,
        balance DECIMAL(10,2) DEFAULT 0.0,
        currency VARCHAR(10),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        client_id INT(6) UNSIGNED NOT NULL,
        FOREIGN KEY (client_id) REFERENCES myclients(id)
    )";

    echo "Creating table query: " . $createTableSql; // Debugging line

    if ($conn->query($createTableSql) === TRUE) {
        echo "Accounts table created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
        exit();
    }
}

// Fetch client data
if (isset($_GET['id'])) {
    $clientID = $_GET['id'];

    $sql = "SELECT id, firstname, lastname, email FROM myclients WHERE id = $clientID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $clientData = $result->fetch_assoc();
    } else {
        echo "Client not found";
        exit();
    }

    // Fetch accounts data for the client
    $sqlAccounts = "SELECT id, balance, currency FROM accounts WHERE client_id = $clientID";
    $resultAccounts = $conn->query($sqlAccounts);
} else {
    echo "Client ID not provided";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $clientData['firstname'] . ' ' . $clientData['lastname']; ?>'s Accounts</title>
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
                <li class="bg-transparent text-white hover:bg-blue-600 transition ease-out duration-700 h-8 w-32">
                    <a href="account.php"> accounts</a>
                </li>
                <li class="bg-transparent text-white hover:bg-blue-600 transition ease-out duration-700 h-8 w-32">
                    <a href="transaction.php">transactions</a>
                </li>
            </ul>
        </div>
    </div>

    <h1 class="text-xl m-4"><?php echo $clientData['firstname'] . ' ' . $clientData['lastname']; ?>'s Accounts</h1>

    <p>Email: <?php echo $clientData['email']; ?></p>

    <?php
    if ($resultAccounts->num_rows > 0) {
        echo "<table class='table-auto w-full bg-black text-white border border-white'>";
        echo "<tr>
                <th class='border border-white'>ID</th>
                <th class='border border-white'>Balance</th>
                <th class='border border-white'>Currency</th>                
                <th class='border border-white'>transaction</th>
                
            </tr>";

        // Output data of each row
        while ($row = $resultAccounts->fetch_assoc()) {
            echo "<tr>
                    <td class='border border-white'>" . $row["id"] . "</td>
                    <td class='border border-white'>" . $row["balance"] . "</td>
                    <td class='border border-white'>" . $row["currency"] . "</td>
                    <td class=\"border border-white\">
                    <a href=\"transaction.php?id=" . $row["id"] . "\">View Details</a>
                </td>
                </tr>";
            }

        echo "</table>";
    } else {
        echo "<p>This client has no accounts.</p>";
    }
    ?>
</body>

</html>
