<?php

	$db = mysqli_connect("localhost", "root", "", "library_app");

	if ($db) {
		//echo "Database Connected Successfully!!";
	}
	else {
		echo "Database Connection Error!!";
	}

?>