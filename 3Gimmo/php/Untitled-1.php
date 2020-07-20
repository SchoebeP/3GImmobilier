<?php
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "3gimmo";

$conn = mysqli_connect($servername,$dbUsername,$dbPassword,$dbName);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("SELECT user_email FROM user WHERE user_email='$email");
$stmt->bind_param("s", $email);

$stmt->execute();

/* Connexion à une base MySQL avec l'invocation de pilote */
$dsn = 'mysql:dbname=3gimmo;host=localhost';
$user = 'root';
$password = '';

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}
$sql =  'SELECT user_email FROM user WHERE user_email= ? ';
$conn->query($sql);