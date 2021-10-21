<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbtestnode";

$conn = mysqli_connect("$servername", "$username", "$password", "$dbname");

$result = mysqli_query($conn, "INSERT INTO datasensor (data) VALUES ('" . $_GET["data"] . "')");

if (!$result) {
    die('Invalid query: ' . mysqli_error($conn));
}
