<?php
$dbhost = 'MySQL-8.0';
$dbname = 'nest';
$dbuser = 'root';
$dbpass = '';

$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if($connection->connect_error) die("Fatal error");

function createTable($name, $query)
{
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Таблица '$name' создана или уже существовала<br>";
}

function queryMysql($query)
{
    global $connection;
    $result = $connection->query($query);
    if (!$result) die("Fatal error");
    return $result;
}

function destroySession()
{
    $_SESSION=array();
    if (session_id() != "" || isset($_COOKIE[session_name()])){
        setcookie(session_name(), '', time()-2592000, '/');
    }

    session_destroy();
}

function sanitizeString($var)
{
    global $connection;
    $var = strip_tags($var);
    $var = htmlentities($var);
    return $connection->real_escape_string($var);
}


function showProfile($user)
{
    $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");

    if ($result->num_rows) {
        $row = $result->fetch_array(MYSQLI_ASSOC);

        if (file_exists("$user.jpg")) {
            echo "<img src='$user.jpg' align='left'>";
        }

        echo stripslashes($row['text']) . "<br style='clear:left;'><br>";
    } else {
        echo "<p>Здесь пока не на что смотреть</p><br>";
    }
}
