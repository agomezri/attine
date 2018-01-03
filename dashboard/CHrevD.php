
<?php 
	// 1. Create a database connection
	$connection = mysqli_connect("127.0.0.1","root","C1inil@b");  //, false,128
	
	// 2. stop everything if the connection is not working
	if (!$connection) {
		die("Database connection failed: " .mysql_error());
		}

	// 3. Select a database to use
	$db_select = mysqli_select_db($connection, "attine");
	if (!$db_select) {
		die("Database selection failed: " .mysql_error());
		}
	
	//4. Perform database query - select ring number and average torque cutting wheel
	
		$result = mysqli_query($connection, "SELECT NO_RING, W13010096 FROM allev");
        if (!$result) {die("Database query failed: " .mysql_error());}

        //5. use returned data (http://stackoverflow.com/questions/14194032/load-json-data-to-highchart)

        $data= array();
        while ($row = mysqli_fetch_array($result)) {
                $ring = $row['NO_RING']*1;
                $rev = $row['W13010096']*1; //Face pressure sensor 4 (top)
                
                $data[] = array($ring, $rev);

                }
                echo json_encode($data);

        //4. Close connection

        mysqli_close($connection);

?>
