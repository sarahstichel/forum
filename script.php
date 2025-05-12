<?php
function connectToDb()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "inl8";
    $conn = new mysqli($servername, $username, $password, $dbname);
    return $conn;
};



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
