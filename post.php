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
    <button><a href="index.php">Logga ut</a></button>
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
        echo "Ämne: " . $row["title"] . "<br> Startat av: " . $row["name"] . "<br> Skapad: " . $row["created_at"] . "<hr>";
    }
}

//     $sql = "SELECT * FROM guestbook ORDER by time DESC";
//     $result = $conn->query($sql);
//     if ($result->num_rows > 0) {
//         while ($row = $result->fetch_assoc()) {
//             echo $row["name"] . "<br>" . $row["comment"] . "<br>" . $row["time"] . "<hr>";
//         }
//     }
// } else {
//     echo "Du är inte inloggad.";
// }
