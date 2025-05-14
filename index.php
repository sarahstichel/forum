<?php
function connectToDb()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "forum";
    $conn = new mysqli($servername, $username, $password, $dbname);
    return $conn;
};

function login()
{
    $conn = connectToDb();
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $username = $_POST["username"];
    $password = $_POST["password"];
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password_hash"])) {
            session_start();
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["name"] = $row["name"];
            header("Location: post.php");
        }
    }
}


function comment()
{
    $conn = connectToDb();
    $stmt = $conn->prepare("INSERT INTO guestbook (name, email, comment, time) VALUES (?, ?, ?, now())");
    $stmt->bind_param("sss", $name, $email, $comment);

    $name = $_POST["name"];
    $email = $_POST["email"];
    $comment = $_POST["comment"];
    $stmt->execute();
    $sql = "SELECT * FROM guestbook ORDER by time DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo $row["name"] . "<br>" . $row["comment"] . "<br>" . $row["time"] . "<hr>";
        }
    }
}

if (isset($_POST["login_submit"])) {
    login();
} elseif (isset($_POST["comment_submit"])) {
    comment();
}
