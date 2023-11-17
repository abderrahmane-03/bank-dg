<?php
if (isset($_POST['valider'])) {
    if (!empty($_POST['admin']) && !empty($_POST['password'])) {
        if ($_POST['admin'] == "admin@" && $_POST['password'] == "1234") {
            header("Location: clients.php");
            exit(); // Ensure no further code is executed after redirection
        } else {
            echo "Verify informations";
        }
    } else {
        echo "Veuillez compléter tous les champs...";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Administrateur</title>
</head>

<body>
    <div class="min-h-screen flex items-center justify-center">
        <form class="w-96 px-8 pt-4 pb-2 mb-2 bg-white rounded justify-center" method="post" action="">
            <h1 class="m-5 pt-4 text-2xl text-center">Hello admin</h1>

            <label class="block mb-2 text-sm font-bold text-gray-700" for="username">
                Username:
            </label>
            <input
                class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                type="text" name="admin"> <br>

            <label class="block mb-2 text-sm font-bold text-gray-700" for="username">
                Password:
            </label>
            <input
                class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border border-red-500 rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                type="password" name="password"> <br>

            <button
                class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                type="submit" name="valider" value="valider">Login</button>
        </form>
    </div>
</body>

</html>
