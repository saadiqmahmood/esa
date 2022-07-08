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
                // Function called validateform() created
                var astronaut_name=document.myform.astronaut_name.value;

                if (astronaut_name==null || astronaut_name==""){
                    alert("Please enter Astronaut Name");
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
                    <li class="view-title-main"><a href="addastronaut.php">Add Astronaut</a></li>
                    <li class="view-title"><a href="addtarget.php">Add Target</a></li>
                    <li class="view-title"><a href="addmission.php">Add Mission</a></li>
                </ul>
            </div> 


            <div class="row body justify-content-left">
                <div class="col-7">
                    <form method="post" action="addastronaut.php" name="myform" onsubmit="return validateform()">

                        <label>Astronaut name</label><br>
                        <input type="text" name="astronaut_name" placeholder="Enter Astronaut name">

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
                        $astronaut_name = $_POST['astronaut_name'];

                        // ADDING CONTENTS INTO THE DATABASE TABLE 
                        /* Variable called sql is created and sql is written in it.

                           INSERT INTO statement first, next is to type the table name,
                           specify the column names that new rows will be added to, lastly, VALUE 
                           statement, specify the values(the php variales declared above)
                        */
                        $sql = "INSERT INTO astronaut (name) VALUES ('$astronaut_name')";              
                        
                        // Check if sql has been inserted into $link database
                        if(mysqli_multi_query($link, $sql)) {
                            // If it is successful, print this
                            echo "Astronaut has been added";
                            // Else print this
                        } else {
                            echo "Error: problem adding astronaut";
                        }
                    }
                    
                    // Close connection using mysqli_close()
                    mysqli_close($link)

                
                ?>    
            </div>

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