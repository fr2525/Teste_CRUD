<?php 

//private $db_host = 'localhost'; // servidor
//private $db_user = 'root'; // usuario do banco
//private $db_pass = ''; // senha do usuario do banco
//private $db_name = 'crud'; // nome do banco

//private $con = false;
    // Create connection
//    $con = new mysqli("localhost", "root", "");

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

/*

$con=mysql_connect("localhost" , "root" , "" ); 

// if ($con) { die ("Não foi possível conectar ao servidor de banco de dados ! "); }

$db = mysql_select_db("db_financeiro", $con);
if (!$db) 
{
    if (( $err = mysql_errno ()) == 1049 ) 
    {
         die (" Banco de dados não existe! "); 
    }
    else 
    {
        die (" Banco de dados existe, mas há um outro erro"  ); 
    }
}    
else {
    echo" existe banco de dados " ; 
}
  */
  
  
?>