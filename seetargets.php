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

    </head>

	<body>
        <div class="container-fluid">
            <div class="row head">
                
                <ul class="nav-bar">
                    <li class="nav-items"><a href="index.php">HOME</a></li>
                    <li class="nav-items"><a href="addastronaut.php">ADD TO DATABASE</a></li>  
                    <li class="nav-items-main"><a href="seemissions.php">DATABASE VIEW</a> </li> 
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
		
		<div class="row view">
            <ul class="view-list">
                <li class="view-title"><a href="seeastronauts.php">Astronaut</a></li>
                <li class="view-title"><a href="seemissions.php">Missions</a></li>
                <li class="view-title-main"><a href="seetargets.php">Targets</a></li>
            </ul>
        </div>


        <div>
            <table class="table table-hover">
                <tr>
                    <th width="100px">Target ID<br><hr></th>
                    <th width="200px">Target Name<br><hr></th>
                    <th width="250px">Target First Mission<br><hr></th>
                    <th width="200px">Target Type<br><hr></th>
                    <th width="300px">Target Number of Missions<br><hr></th>
                </tr>

                <?php
                /* mysqli_query() function for querying/getting information out of a database.
                Add in variable called $link to connect to database where information is going to be queried from,
                the second value after $link is a string query, next is sql code to SELECT column FROM table 
                */                           // SELECT statement followed by names of columns to be queried  COUNT statement to count every target_id in missions table and present the result in no_mission column 
                $sql = mysqli_query($link, " SELECT targets.target_id, targets.name, targets.first_mission, targets.type, COUNT(missions.target_id) AS no_mission
                                            -- Specify the two tables
                                            -- From the table targets    
                                            FROM targets 
                                            -- JOIN keyword indicates that the two tables will be joined
                                            LEFT JOIN missions 
                                            -- Specify how to connect the tables with the ON statement, the condition is to connect the two rows only if they have the same ID
                                            ON targets.target_id = missions.target_id 
                                            -- GROUP BY statement to group each row of number of missions by an targets_id
                                            GROUP BY targets.target_id 

                                            -- Learnt from https://www.youtube.com/watch?v=9yeOJ0ZMUYw SQL Joins Explained |¦| Joins in SQL |¦| SQL Tutorial by Socratica
                                            ;");
                                        
                
                // While loop that fetches a row when $row is equal to the $sql queried
                while ($row = $sql->fetch_assoc()) {
                    /* Each time to loop is triggered, the following html <th> tags are printed onto the html code, columns are extracted from the targets table 
                    and printed into the <th> tags
                    */
                    echo "
                    <tr>
                        <th>{$row['target_id']}</th>
                        <th>{$row['name']}</th>
                        <th>{$row['first_mission']}</th>
                        <th>{$row['type']}</th>
                        <th>{$row['no_mission']}</th>
                    </tr>
                    ";
                }
                ?>
            </table>
        </div>


		<?php
			
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