
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

        
        $data1= array();
        $data1['name'] = 'Temperature1';

        while ($row1 = mysqli_fetch_array($result)) {
                $time = ($row1['timeStamp']-14397.1)*1000;
                $temp1 = $row1['Temp1']*1; //temperature in Celsius
                
                $data1['data'][] = array($time, $temp1);
                }
 
 	$result2 = mysqli_query($connection, "SELECT timeStamp, Temp2 FROM Temperature order by timeStamp desc limit 50");
        if (!$result2) {
                die("Database query failed: " .mysql_error());
                }
                
        $data2= array();
        $data2['name'] = 'Temperature2';

        while ($row2 = mysqli_fetch_array($result2)) {
                $time = ($row2['timeStamp']-14397.1)*1000;
                $temp2 = $row2['Temp2']*1; //temperature in Celsius
                
                $data2['data'][] = array($time, $temp2);
                }
                
		$final = array();
		array_push($final,$data1);
		array_push($final,$data2);
		echo json_encode($final);

                

        //4. Close connection

        mysqli_close($connection);