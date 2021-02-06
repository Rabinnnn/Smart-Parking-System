
<!DOCTYPE html>
<html>
<head>
<style>
        
table, th, td {
    border: 1px solid black;
}
</style>
</head>

<body>
<h2>Bookings</h2>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Smart_parking";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT  Owner, Phone, License_plate, Slot, Time FROM Bookings_table";
 
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr>  <th>OWNER</th><th>PHONE</th><th>LICENSE_PLATE</th><th>SLOT</th><th>TIME</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr> <td>".$row["Owner"]."</td><td> ".$row["Phone"]."</td> <td>".$row["License_plate"]."</td><td>".$row["Slot"]."</td><td>".$row["Time"]."</td></tr>";
    	
	}
	
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>

 
<p> <a href="Book_parking_slot.php">Go back to bookings page</a>.</p>
</body>
</html>