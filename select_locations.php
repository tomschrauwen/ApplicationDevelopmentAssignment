<?php
	$servername = "localhost";
	$username = "";
	$password = "";
    $dbName = "test";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbName);

	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

    //Use a mysql query to select data from the database
	$sql = "SELECT * FROM `locations`";
	$result = mysqli_query($conn, $sql)or die("Error in Selecting " . mysqli_error($connection));;

    //create an array
    $myarray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $myarray[] = $row;
    }
    echo(json_encode($myarray));

//    $myArray = array();
//    if ($result = $mysqli->query("SELECT * FROM 'locations'")) {
//        while($row = $result->fetch_array(MYSQL_ASSOC)) {
//            $myArray[] = $row;
//        }
//        echo json_encode($myArray);
//    }

	// TODO: echo the result as JSON code
	// Hint: google it. MySQL JSON PHP
		
?>