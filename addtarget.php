<!DOCTYPE html>
<html lang="en">

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

	<head>
        
        <title>European Space Agency</title>

        <link href="css/style.css" rel="stylesheet" />
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
            crossorigin="anonymous"
        />

        <script src="js/targets.js"></script>

    </head>

	<body>
        <div class="container-fluid">
            <div class="row head">
                
                <ul class="nav-bar">
                    <li class="nav-items"><a href="index.php">HOME</a></li>
                    <li class="nav-items"><a href="addmission.php">ADD MISSION</a></li> 
                    <li class="nav-items"><a href="addastronaut.php">ADD ASTRONAUT</a></li>  
                    <li class="nav-items"><a href="addtarget.php">ADD TARGET</a></li>
                    <li class="nav-items"><a href="seemissions.php">SEE ALL MISSIONS</a> </li>
                    <li class="nav-items"><a href="seeastronauts.php">SEE ALL ASTRONAUTS</a></li> 
                    <li class="nav-items"><a href="seetargets.php">SEE ALL TARGETS</a></li> 
                    <li class="nav-logo"><a href="index.php"><img src="images/esa-logotype-white-text-number-symbol-word-transparent-png-2497943.png" alt=""></a></li>

                </ul>


            </div>
            <div class="row body justify-content-center">
                <div class="col-7">
                    <form method="post" action="addtarget.php" name="myform" onsubmit="return validateform()">

                    <h1 class="add-title">Add a new Target</h1>
		
                        <label>Target name</label>
                        <input type="text" name="target_name">
                        
                        <br>
                        <br>

                        <label>Date of First Mission</label>
                        <input type="date" name="first_mission" placeholder="Enter Date">

                        <br>
                        <br>
                        
                        <label>Type of Mission</label>
                        <input type="text" name="type" placeholder="Enter type of Mission">
                        
                        <br>
                        <br>

                        <label>Number of Missions</label>
                        <input type="text" name="no_mission" placeholder="Enter number of Mission">
                        
                        <br>
                        <br>

                        <input type="submit" name="submit">
                    
                    </form>
		
                </div>  
		
		<?php

            // Four sql parameters required, host, username, password and database name 
            $host = "localhost";
            $username = "root";
            // Default xampp password is nil
            $password = "";
            $database_name = "esa";

            /* Linking php script to database with sql code using mysqli_connect to open connection,
                It has to be in a specific order starting with host, username, 
                password followed by database name */
            $link = mysqli_connect($host, $username, $password, $database_name);

            // If statement to infrom whether connection is successful
            if($link === false) {
                /* If the connection is not successful, die stops the connection to prevent issues
                    and prints message below */
                die("Error: could not connect");
            }  
			
            // Code should only be read IF submit button is clicked
            // Using isset function which posts 'submit' from the html code 
            if(isset($_POST['submit'])) {
                // Create variable using $_POST[''] method for each input field using its name
				$target_name = $_POST['target_name'];
                $first_mission = $_POST['first_mission'];
                $type = $_POST['type'];
                $no_mission = $_POST['no_mission'];

                // ADDING CONTENTS INTO THE DATABSE TABLE 
                /* Variable called sql is created and sql is written in it.

                    INSERT INTO statement first, next is to type the table name,
                    specify the column names that new rows will be added to, lastly, VALUE 
                    statement, specify the values(the php variales declared above)
                */
				$sql = "INSERT INTO targets (name, first_mission, type, no_mission) VALUES ('$target_name', '$first_mission', '$type', '$no_mission')";

				// Check if sql has been inserted into $link database
                if(mysqli_query($link, $sql)) {
                    // If it is successful, print this
                    echo "Target has been added";
                    // Else print this
                } else {
                    echo "Error: problem adding Target";
                }
			}
			
            // Close connection using mysqli_close()            
            mysqli_close($link)

		?>
	
        <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"
        ></script>

        <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
        crossorigin="anonymous"
        ></script>

        <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
        crossorigin="anonymous"
        ></script>
		

	
	</body>

</html>