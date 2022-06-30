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
        
        <script src="js/missions.js"></script>

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
                ?>
            <div class="row body justify-content-center">
                <div class="col-7">
                    <form method="post" action="addmission.php" name="myform" onsubmit="return validateform()">

                        <h1 class="add-title">Add a new Mission</h1>

                        <label>Select Astronaut:</label>
                        <select name="astronaut_id">
                            <?php
                            /* mysqli_query() function for querying/getting information out of a database.
                               Add in variable called $link to connect to database where information is going to be queried from,
                               the second value after $link is a string query, next is sql code to SELECT column FROM table  
                            */
                            $sql = mysqli_query($link, "SELECT astronaut_id, name FROM astronaut");

                            // While loop that fetches a row when $row is equal to the $sql queried
                            while ($row = $sql->fetch_assoc()){
                                /* Each time to loop is triggered, a html option tag is printed onto the html code, astronaut_id 
                                   and name are both extracted from the database table and printed into the option tag 
                                */
                                echo "<option value='{$row['astronaut_id']}'>{$row['name']}</option>";
                            }
                            ?>
                        </select>

                        <br>
                        <br>

                        <label>Select Target:</label>
                        <select name="target_id">
                            <?php
                            /* mysqli_query() function for querying/getting information out of a database.
                               Add in variable called $link to connect to database where information is going to be queried from,
                               the second value after $link is a string query, next is sql code to
                               SELECT column FROM table                 
                            */
                            $sql = mysqli_query($link, "SELECT target_id, name FROM targets");

                            // While loop that fetches a row when $row is equal to the $sql queried
                            while ($row = $sql->fetch_assoc()){
                                /* Each time to loop is triggered, a html option tag is printed onto the html code, astronaut_id 
                                   and name are both extracted from the database table and printed into the option tag 
                                */
                                echo "<option value='{$row['target_id']}'>{$row['name']}</option>";
                            }
                            ?>
                        </select>

                        <br>
                        
                        <p style="padding-left: 10px;">No Astronauts and/or Targets? Click <a href="addastronaut.php">HERE</a> to add Astronaut or <a href="addtarget.php">HERE</a> to add Target.</p>

                        <label>Mission Name</label>
                        <input type="text" name="name" placeholder="Enter Mission name">
                        
                        <br>
                        <br>

                        <label>Mission Destination</label>
                        <input type="text" name="destination" placeholder="Enter Destination">

                        <br>
                        <br>
                        
                        <label>Launch Date</label>
                        <input type="date" name="launch_date">
                        
                        <br>
                        <br>

                        <label>Mission Type</label>
                        <input type="text" name="mission_type" placeholder="Enter Mission Type">
                        
                        <br>
                        <br>

                        <label>Crew Size</label>
                        <input type="number" name="crew_size" placeholder="Enter Crew Size">
                        
                        <br>
                        <br>

                        <input type="submit" name="submit">
                    
                            
                    </form>
                </div>
            </div>
		
		<?php
			
            // Code should only be read IF submit button is clicked
            // Using isset function which posts 'submit' from the html code 
            if(isset($_POST['submit'])) {
                // Create variable using $_POST[''] method for each input field using its name
				$name = $_POST['name'];
                $destination = $_POST['destination'];
                $launch_date = $_POST['launch_date'];
                $mission_type = $_POST['mission_type'];
                $crew_size = $_POST['crew_size'];
                $astronaut_id = $_POST['astronaut_id'];
                $target_id = $_POST['target_id'];

                // ADDING CONTENTS INTO THE DATABSE TABLE 
                /* Variable called sql is created and sql is written in it.

                    INSERT INTO statement first, next is to type the table name,
                    specify the column names that new rows will be added to, lastly, VALUE 
                    statement, specify the values(the php variales declared above)
                */
				$sql = "INSERT INTO missions (name, destination, launch_date, mission_type, crew_size, astronaut_id, target_id) VALUES ('$name', '$destination', '$launch_date', '$mission_type', '$crew_size', '$astronaut_id', '$target_id')";

				// Check if sql has been inserted into $link database
                if(mysqli_query($link, $sql)) {
                    // If it is successful, print this
                    echo "Mission has been added";
                    // Else print this
                } else {
                    echo "Error: problem adding Mission";
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