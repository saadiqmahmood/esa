<!DOCTYPE html>
<html lang="en">
    <!-- META TAGS REQUIRED TO USE BOOTSTRAP FROM https://getbootstrap.com/docs/5.2/getting-started/introduction/ -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

	<head>
        
        <title>European Space Agency</title>
        <!-- LINK TO LOCAL CSS FILE with php echo time function to speed up css loading-->
        <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet" />
        <!-- BOOTSTRAP CSS GOTTEN FROM https://getbootstrap.com/docs/5.1/getting-started/download/ -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
            crossorigin="anonymous"
        />
        <!-- JAVASCRIPT FORM VALIDATION -->
        <script>
            // Function called validateform() created
            function validateform() 
            {
                // Variables created for each field
                var name=document.myform.name.value;
                var destination=document.myform.destination.value;
                var launch_date=document.myform.launch_date.value;
                var mission_type=document.myform.mission_type.value;
                var crew_size=document.myform.crew_size.value;


                // IF statement denoting If variable is equal to null or empty, Alert on window "Please enter the value of the variable"
                if (name==null || name==""){
                    alert("Please enter Mission Name");
                    return false;
                } else if (destination==null || destination==""){
                    alert("Please enter Mission Destination");
                    return false;
                } else if (launch_date==null || launch_date==""){
                    alert("Please enter Launch Date");
                    return false;
                } else if (mission_type==null || mission_type==""){
                    alert("Please enter Mission Type");
                    return false;
                } else if (crew_size==null || crew_size==""){
                    alert("Please enter Crew Size");
                    return false;
                } 
            }
            
        </script>
        <!-- JAVASCRIPT METHOD FOR PREVENTING FORM RE-SUBMISSION WHEN PAGE IS REFRESHED -->
        <script>
            // window.history.replaceState() is a javascript method that replaces current history with state object, title and URL set inside the parameters 
        if ( window.history.replaceState ) {
            // State and title set to null since nothing needs to be changed, the url is optional, when it is empty, it takes the current url of that page
            window.history.replaceState( null, null, '' );
            }
        </script>

    </head>


	<body>
        <div class="container-fluid">
            <div class="row head">
                
                <ul class="nav-bar">
                    <li class="nav-items"><a href="index.php">HOME</a></li>
                    <li class="nav-items-main"><a href="addastronaut.php">ADD TO DATABASE</a></li>  
                    <li class="nav-items"><a href="seemissions.php">DATABASE VIEW</a> </li>
                    <li class="nav-logo"><a href="index.php"><img src="images/esa-logotype-white-text-number-symbol-word-transparent-png-2497943.png" alt=""></a></li>
                </ul>


            </div>

            <div class="row view">
                <ul class="view-list">
                    <li class="view-title"><a href="addastronaut.php">Add Astronaut</a></li>
                    <li class="view-title"><a href="addtarget.php">Add Target</a></li>
                    <li class="view-title-main"><a href="addmission.php">Add Mission</a></li>
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
            <div class="row body justify-content-left">
                <div class="col-7">
                    <form method="post" action="addmission.php" name="myform" onsubmit="return validateform()">
                        <label>Select Astronaut 1:</label>
                        <select class="required" name="astronaut_id">
                            <option hidden disabled selected value>Astronauts</option>
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
                            
                        <label>Select Astronaut 2:</label>
                        <select name="astronaut_id2">
                            <option hidden disabled selected value>Astronauts</option>
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
                            <option hidden disabled selected value>Targets</option>
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
                $target_id = $_POST['target_id'];
                $astronaut_id = $_POST['astronaut_id'];
                $astronaut_id2 = $_POST['astronaut_id2'];


                // ADDING CONTENTS INTO THE DATABSE TABLE 
                /* Variable called sql is created and sql is written in it.

                    INSERT INTO statement first, next is to type the table name,
                    specify the column names that new rows will be added to, lastly, VALUE 
                    statement, specify the values(the php variales declared above)
                */
				$sql = "INSERT INTO missions (name, destination, launch_date, mission_type, crew_size, target_id) VALUES ('$name', '$destination', '$launch_date', '$mission_type', '$crew_size', '$target_id')";

				// Check if sql has been inserted into $link database
                if(mysqli_query($link, $sql)) {
                    // If it is successful, print this
                    echo "Mission has been added";
                    // Else print this
                } else {
                    echo "Error: problem adding Mission";
                }
                
                // Code for incrementing number of astronaut missions in database by Updating 

                // Query no_missions column form astronaut table using mysqli_query() function
                $sql2 = mysqli_query($link, "SELECT no_missions FROM astronaut");
                // Fetching a row when the row is equal to the sql queried
                $row2 = $sql2 -> fetch_assoc();
                // Declare variable for number of missions
                $miss_no = $row2["no_missions"];
                // Declare variable to increment the number of astronaut mission
                $incr = $miss_no + 1;
                                                                                                 
				$sql3 = // UPDATE statement to update table
                        "UPDATE astronaut
                        -- SET statement to set which column to update, followed by the $incr variable to increment
                         SET astronaut.no_missions=('$incr')
                        --  WHERE(statement) astronaut_id is equal to the one in the database table 
                         WHERE astronaut.astronaut_id='$astronaut_id'
                         ";

				// Check if sql has been inserted into $link database
                if(mysqli_query($link, $sql3)) {
                    // If it is successful, print this
                    echo "Astronaut has been updated with mission";
                    // Else print this
                } else {
                    echo "Error: problem adding Astronaut Mission";
                }
                
                // Replica of code above but for Second inputed astronaut
                $sql6 = mysqli_query($link, "SELECT no_missions FROM astronaut");
                // Fetching a row when the row is equal to the sql queried
                $row6 = $sql6 -> fetch_assoc();
                // Declare variable for number of missions
                $miss_no3 = $row6['no_missions'];
                // Declare variable to increment the number of astronaut mission
                $incr2 = $miss_no3 + 1;

				$sql7 = // UPDATE statement to update table
                        "UPDATE astronaut
                         SET astronaut.no_missions=('$incr2')

                        --                   One major change done
                         WHERE astronaut.astronaut_id='$astronaut_id2'
                         ";

                if(mysqli_query($link, $sql7)) {
                    echo "Astronaut has been updated with mission";
                } else {
                    echo "Error: problem adding Astronaut Mission";
                }


                 // Code for incrementing number of Targets in database by Updating 

                // Query no_mission column form target table using mysqli_query() function
                $sql4 = mysqli_query($link, "SELECT no_mission FROM targets");
                // Fetching a row when the row is equal to the sql queried
                $row4 = $sql4 -> fetch_assoc();
                // Declare variable for number of missions
                $miss_no2 = $row4["no_mission"];
                // Declare variable to increment the number of Targets
                $incr = $miss_no2 + 1;
                                                                                                
				$sql5 = // UPDATE statement to update table
                        "UPDATE targets
                        -- SET statement to set which column to update, followed by the $incr variable to increment
                         SET targets.no_mission=('$incr')
                        --  WHERE(statement) target_id is equal to the one in the database table 
                         WHERE target_id='$target_id'
                         ";

				// Check if sql has been inserted into $link database
                if(mysqli_query($link, $sql5)) {
                    // If it is successful, print this
                    echo "Target has been updated with mission";
                    // Else print this
                } else {
                    echo "Error: problem adding Target Mission";
                }


			}

            // Close connection using mysqli_close()
            mysqli_close($link)
		
		?>
	
    <!-- OTHER THINGDS REQUIRED FOR USING BOOTSTRAP FROM https://getbootstrap.com/docs/5.1/getting-started/download/ -->
    <!-- jQuery -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
    <!-- Popper.js -->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
      integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
      crossorigin="anonymous"
    ></script>
    <!-- Bootstrap JS -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
      integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
      crossorigin="anonymous"
    ></script>
		

	
	</body>

</html>