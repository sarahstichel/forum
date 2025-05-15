 <form action="index.php" method="post">
     Username:<br />
     <input type="text" name="username" />
     <br />
     Password:<br />
     <input type="password" name="password" />
     <br />
     <input type="submit" name="login_submit" value="Submit" />
 </form>
 <button><a href="createuser.html">Skapa ny användare</a></button>

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

    if (isset($_POST["login_submit"])) {
        login();
    }
    if (isset($_POST["logout"])) {
        session_unset();
        session_destroy();
    }
