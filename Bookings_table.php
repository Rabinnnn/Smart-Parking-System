<?php
$servername="localhost";
$username="root";
$password="";
$dbname="Smart_parking";

try{
	//create connection to servername
	$conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
	//set errormode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	//create table
	$sql="CREATE TABLE Bookings_table(
		
    		id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
   		Owner VARCHAR(50) NOT NULL UNIQUE,
		Phone INT(10) NOT NULL,
   		License_plate VARCHAR(255) NOT NULL,
		Slot INT(10),
    		Time DATETIME DEFAULT CURRENT_TIMESTAMP
);
		
	)";

	//use exec()to execute
	$conn->exec($sql);
	echo "Table created successfully!";
}
catch(PDOException $e)
{echo $sql."<br>".$e->getMessage();}
//end connection
$conn=null;
?>