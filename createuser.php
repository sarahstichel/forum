<?php
$servername = "localhost";
$usernameDB = "root";
$passwordDB = "";
$dbname = "forum";
$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

if (isset($_POST["username"], $_POST["password"])) {
    $username = $_POST["username"];
    $name = $_POST["name"];
    $password = $_POST["password"];
    $password_hash = password_hash($password, PASSWORD_DEFAULT);


    $stmt = $conn->prepare("INSERT INTO users(username, name, password_hash, created_at) VALUES (?,?,?, now())");
    $stmt->bind_param("sss", $username, $name, $password_hash);


    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        echo "Ny användare skapad <br>";
        echo " <button><a href='index.html'>Logga in</a></button>";
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    die("Användarnamn och lösenord krävs");
}

$stmt->close();
$conn->close();
