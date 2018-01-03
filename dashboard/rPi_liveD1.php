
<?php 
	// 1. Create a database connection
	$connection = mysqli_connect("10.0.0.13","binni","C1inil@b");  //, false,128
	
	// 2. stop everything if the connection is not working
	if (!$connection) {
		die("Database connection failed: " .mysql_error());
		}

	// 3. Select a database to use
	$db_select = mysqli_select_db($connection, "TempSQL");
	if (!$db_select) {
		die("Database selection failed: " .mysql_error());
		}
	
	//4. Perform database query - select ring number and average torque cutting wheel
	
	$result = mysqli_query($connection, "SELECT timeStamp, Temp1 FROM Temperature order by timeStamp desc limit 50");
        if (!$result) {
                die("Database query failed: " .mysql_error());
                }

        //5. use returned data (http://stackoverflow.com/questions/14194032/load-json-data-to-highchart)


        $data= array();
        
        while ($row = mysqli_fetch_array($result)) {
                $time = ($row['timeStamp']-14397.1)*1000;
                $temp1 = $row['Temp1']*1; //temperature in Celsius
                
                $data[] = array($time, $temp1);
				
                }
                echo json_encode($data);
        
                

        //4. Close connection

        mysqli_close($connection);

?>
