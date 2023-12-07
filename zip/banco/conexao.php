<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "productdb";

$conn = mysqli_connect($servername, $username, $password, $dbname);

echo "<br>";echo "<br>";echo "<br>";echo "<br>";
if(!$conn){
    echo "conexão com db falha";
} else{
    echo "conexão pica";
}

?>