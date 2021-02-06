<?php
// Include config file
require_once "Config.php";
 
// Define variables and initialize with empty values
$Owner = $Phone = $License_plate = $Slot = "";
$Owner_err = $Phone_err = $License_plate_err = $Slot_err="";

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate Owner
    if(empty(trim($_POST["Owner"]))){
        $Owner_err = "Please enter your name.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM Bookings_table WHERE Owner = :Owner";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":Owner", $param_uname, PDO::PARAM_STR);
            
            // Set parameters
            $param_Owner = trim($_POST["Owner"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $Owner_err = "Please enter the name you signed up with.";
                } else{
                    $Owner = trim($_POST["Owner"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    



    // Validate Phone number
    if(empty(trim($_POST["Phone"]))){
        $Phone_err = "Please enter your phone number.";     
    } elseif(strlen(trim($_POST["Phone"]))==!10){
        $Phone_err = "Phone must have 10 characters.";
    } else{
        $Phone = trim($_POST["Phone"]);
    }
     
	//Validate License_plate
    if(empty(trim($_POST["License_plate"]))){
        $License_plate_err = "Please enter your vehicle's License_plate Number.";     
    } else{
        $License_plate = trim($_POST["License_plate"]);
       
    }
//Validate Slot
    if(empty(trim($_POST["Slot"]))){
        $Slot_err = "Please enter a free slot."; 
    	
    } else{
        $Slot = trim($_POST["Slot"]);
	
       
    }
    
    // Check input errors before inserting in database
    if(empty($Owner_err) && empty($Phone_err) && empty($License_plate_err) && empty($Slot_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO Bookings_table (Owner, Phone, License_plate, Slot ) VALUES (:Owner, :Phone, :License_plate, :Slot)";
         
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":Owner", $param_Owner, PDO::PARAM_STR);
            $stmt->bindParam(":Phone", $param_Phone, PDO::PARAM_STR);
	    $stmt->bindParam(":License_plate", $param_License_plate, PDO::PARAM_STR);
	    $stmt->bindParam(":Slot", $param_Slot, PDO::PARAM_STR); 
            // Set parameters
            $param_Owner = $Owner;
            $param_Phone = $Phone; 
	    $param_License_plate = $License_plate;
	    $param_Slot = $Slot;

            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Stay on this page
                header("location: Book_parking_slot.php");
		
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Close connection
    unset($pdo);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book parking slot</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
	.red-icon {
		color:#ff0000;
	}
	.green-icon {
		color:#009933;
	}
	.table-responsive
	{
		width:50%;
	}
	

	
    </style>
</head>
<body>  



    <div class="wrapper">
        <h2>Book parking slot</h2>
        <p>Please fill this form to book a parking slot.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" target="votar">
            <div class="form-group <?php echo (!empty($Owner_err)) ? 'has-error' : ''; ?>">
                <label>Owner</label>
                <input type="text" name="Owner" class="form-control" value="<?php echo $Owner; ?>">
                <span class="help-block"><?php echo $Owner_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($Phone_err)) ? 'has-error' : ''; ?>">
                <label>Phone</label>
                <input type="text" name="Phone" class="form-control" maxlength="10" value="<?php echo $Phone; ?>">
                <span class="help-block"><?php echo $Phone_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($License_plate_err)) ? 'has-error' : ''; ?>">
                <label>License Plate</label>
                <input type="text" name="License_plate" class="form-control" value="<?php echo $License_plate; ?>">
                <span class="help-block"><?php echo $License_plate_err; ?></span>
            </div>
		 <div class="form-group <?php echo (!empty($Slot_err)) ? 'has-error' : ''; ?>">
                <label>Slot</label>
                <input type="text" name="Slot" class="form-control" value="<?php echo $Slot; ?>">
                <span class="help-block"><?php echo $Slot_err; ?></span>
            </div>

	    <div class="form-group">
                <input type="button"  style="background-color:Green;" class="btn btn-primary" value="Slot 1" onclick= style="background-color:Red;" ondblclick= style="background-color:Green;" >
		 <input type="button" style="background-color:Green;" class="btn btn-primary" value="Slot 2" onclick= style="background-color:Red;" ondblclick= style="background-color:Green;" >
		<input type="button" style="background-color:Green;" class="btn btn-primary" value="Slot 3" onclick= style="background-color:Red;" ondblclick= style="background-color:Green;">
		<input type="button" style="background-color:Green;" class="btn btn-primary" value="Slot 4" onclick= style="background-color:Red;" ondblclick= style="background-color:Green;"></br></br>
		<input type="button" style="background-color:Green;" class="btn btn-primary" value="Slot 5" onclick= style="background-color:Red;" ondblclick= style="background-color:Green;"> 
		<input type="button" style="background-color:Green;" class="btn btn-primary" value="Slot 6" onclick= style="background-color:Red;" ondblclick= style="background-color:Green;">
		<input type="button" style="background-color:Green;" class="btn btn-primary" value="Slot 7" onclick= style="background-color:Red;" ondblclick= style="background-color:Green;">
		<input type="button" style="background-color:Green;" class="btn btn-primary" value="Slot 8" onclick= style="background-color:Red;" ondblclick= style="background-color:Green;"></br></br>
		<input type="button" style="background-color:Green;" class="btn btn-primary" value="Slot 9" onclick= style="background-color:Red;" ondblclick= style="background-color:Green;">
		<input type="button" style="background-color:Green;" class="btn btn-primary" value="Slot 10" onclick= style="background-color:Red;" ondblclick= style="background-color:Green;">



		
                

            </div>

		<p><b> Green = free</b></p>
		<p><b>Red = occupied</b></p></br>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit" onclick="alert('Successfully Done!')">
                <input type="reset" class="btn btn-default" value="Reset">
		
            </div>	



	<p> <a href="View_bookings.php">View bookings</a>.</p>
            
	  <iframe name="votar" style="display:none;"></iframe>	
        </form>

    </div>   

</body>
</html>