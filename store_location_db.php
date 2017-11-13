<?php

	// Database credentials may differ on your machine
	$servername = "localhost";
	$username = "";
	$password = "";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, "locations");

	// Check connection
	if (!$conn) {
    	die("Connection failed: " . mysqli_connect_error());
	}

	echo "Connected successfully";

	// Get parameters from URL
	$lat = $_GET["lat"];
	$lon = $_GET["lon"];

	// Use these parameters and the current SERVER timestamp to 
	// store the data in the locations table
	$sql = "INSERT INTO locations (lat, lon, time) VALUES ('$lat', '$lon', CURRENT_TIMESTAMP)";

	// Execute the query
	if (mysqli_query($conn, $sql)) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	
?>