<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "forum";
$conn = new mysqli($servername, $username, $password, $dbname);
session_start();

if (isset($_SESSION["username"]) && !empty($_SESSION["username"])) {
    echo "Du är inloggad med: <br>Användarnamn: " . $_SESSION["username"] . "<br> Namn: " . $_SESSION["name"] . "<br><br>";

    echo "<h2>Skriv nåt kul:</h2>";
    echo "<form action='see_posts.php?id=" . $_GET["id"] . "' method='post'>"
?>
    Skriv något: <input type="text" name="comment" /> <br />
    <br />
    <input type="submit" name="start_topic" value="Skicka" />
    </form>
    <form action="index.php" method="post">
        <input type="submit" name="logout" value="Logga ut">
    </form> <br>
<?php

    if (isset($_POST["start_topic"])) {
        $stmt = $conn->prepare("SELECT title FROM topics WHERE id=?");
        $stmt->bind_param("i", $id);
        $id = $_GET["id"];
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $topic = $row["title"];
            }
        }


        $stmt = $conn->prepare("INSERT INTO inlägg (topic, comment, user, name, created_at) VALUES (?, ?,?,?, now()) ");
        $stmt->bind_param("ssss", $topic, $comment, $username, $name);

        $name = $_SESSION["name"];
        $username = $_SESSION["username"];
        $comment = $_POST["comment"];
        $stmt->execute();
    }


    $sql = "SELECT * FROM inlägg WHERE topic='" . $topic . "' ORDER BY created_at DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Ämne: " . $row["topic"] . "<br> Startat av: " . $row["name"] . "(" . $row["user"] . ")" . "<br>Kommentar:" . $row["comment"] . "<br> Skapad: " . $row["created_at"] . "<hr><br>";
        }
    }
}
