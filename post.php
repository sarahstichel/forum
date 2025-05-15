<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "forum";
$conn = new mysqli($servername, $username, $password, $dbname);
session_start();


if (isset($_SESSION["username"]) && !empty($_SESSION["username"])) {
    echo "Du är inloggad med: <br>Användarnamn: " . $_SESSION["username"] . "<br> Namn: " . $_SESSION["name"] . "<br><br>";
?>
    <form action="index.php" method="post">
        <input type="submit" name="logout" value="Logga ut">
    </form>
    <br>
    <h2>Starta en ny diskussion:</h2>
    <form action="post.php" method="post">
        Disussionsämne: <input type="text" name="topic_title" /> <br />
        <br />
        <input type="submit" name="start_topic" value="Skicka" />
    </form>
<?php



    if (isset($_POST["start_topic"]) && isset($_SESSION["username"])) {
        $stmt = $conn->prepare("INSERT INTO topics (title, username, name, created_at) VALUES (?,?,?, now())");
        $stmt->bind_param("sss", $title, $username, $name);

        $name = $_SESSION["name"];
        $username = $_SESSION["username"];
        $title = $_POST["topic_title"];
        $stmt->execute();
    }
}

$sql = "SELECT * FROM topics ORDER BY created_at DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Ämne: " . $row["title"] . "<br> Startat av: " . $row["name"] . "(" . $row["username"] . ")" . "<br> Skapad: " . $row["created_at"] . "<br>";
        echo "<button><a href='see_posts.php?id=" . $row["id"] . "'>Se alla posts</a></button>" . "<hr><br>";
    }
} else {
    echo "Du är inte inloggad.";
}
