<?php
$servername = "localhost";
$username = "";
$password = "";
$dbName = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$lat = $_GET["lat"];
$lon = $_GET["lon"];
$locationString = "lat:" . $lat . ", lon:" . $lon . date("Y-m-d H:i:s")."\n";
file_put_contents("test.txt", $locationString, FILE_APPEND);

echo "<p>lattitude=$lat</p>";
echo "<p>longitude=$lon</p>";
//echo file_get_contents("test.txt");


$sql = "INSERT INTO locations (lat, lon) VALUES ('$lat', '$lon')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>