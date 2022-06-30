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
		
		<h1 class="add-title">See all Astronauts</h1>

        <table class="table table-hover">
            <tr>
				<th width="100px">Astronaut ID<br><hr></th>
				<th width="300px">Astronaut Name<br><hr></th>
                <th width="200px">Number of missions<br><hr></th>
			</tr>

			<?php
            /* mysqli_query() function for querying/getting information out of a database.
               Add in variable called $link to connect to database where information is going to be queried from,
               the second value after $link is a string query, next is sql code to SELECT column FROM table 
            */
			$sql = mysqli_query($link, "SELECT astronaut_id, name, no_missions FROM astronaut");
            // While loop that fetches a row when $row is equal to the $sql queried
			while ($row = $sql->fetch_assoc()) {
                /* Each time to loop is triggered, the following html <th> tags are printed onto the html code, columns are extracted from the astronauts table 
                   and printed into the <th> tags
                */
				echo "
				<tr>
					<th>{$row['astronaut_id']}</th>
					<th>{$row['name']}</th>
                    <th>{$row['no_missions']}</th>
				</tr>
				";
			}
			?>
		</table>
		
		<?php
			
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