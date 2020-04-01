<?php
$servername = "sql10.freemysqlhosting.net";
$username = "sql10330000";
$password = "pHXDMAWX33";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>