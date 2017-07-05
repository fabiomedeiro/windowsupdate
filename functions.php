<?php
// This file contain  all functions created to manipulate data from database for this system

// This function does  connection with database.
function connect_db()
{
	//including file db.php which contain datas to access to database
	include 'db.php';
	// Create connection
    	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
    	if ($conn->connect_error) {
        	die("Connection failed: " . $conn->connect_error);
	}	 
	return $conn;
}

// This function consults database trow avalaible mac or *.  
function select_db($mac) 
{
	//Connection to database
	$conn = connect_db();
	$data = array();
	//Checking if the consulting will be to specific mac or all entry
	if ( $mac == '*'){
		$sql = "SELECT * FROM info_windows";
	}else{
		$sql = "SELECT * FROM info_windows Where mac = '$mac'";
	}
	//recieving result of consulting and sending them to array data 
   	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
		  $data[] = $row;
	  }
          } else {
                return "0 results";
	  }
	//returning information consulted 
	return $data;
}

// This function add data to  database.  
function insert_db($mac, $name, $username, $time, $status, $download)
{
	// Creating command to insert data on database
	$sql = "INSERT INTO info_windows (mac, name, username, time, status, download) values ('$mac', '$name', '$username', '$time', '$status', '$download')";
        // calling to function to excute variable sql
	check_transation($sql);	
}

// This function update database.  
function update_db($mac, $name, $username, $time, $status, $download)
{
		//consulting variable on database
		$data = select_db($mac);
		//checking if this entry exist
		if ($data[0]["mac"] == $mac){
			//checking if value  of  name  has changed
			if($data[0]["name"] != $name){
				//creating command to update name on the entry 
				$sql= "UPDATE info_windows SET name='$name' WHERE mac='$mac''";
				// calling to function to excute variable sql
				echo check_transation($sql);

			}
			//checking if value of  username  has changed
			if ($data[0]["username"] != $username){
				//creating command to update username on the entry 
				$sql= "UPDATE info_windows SET username='$username' WHERE mac='$mac'";
				// calling to function to excute variable sql
				echo check_transation($sql);
			}
			//checking if value of time  has changed
			if ($data[0]["time"] != $time){
				//creating command to update time on the entry
				$sql= "UPDATE info_windows SET time='$time' WHERE mac='$mac'";
				// calling to function to excute variable sql
				echo check_transation($sql);
	                }
			//checking if value of status  has changed
			if ($data[0]["status"] != $status){
				//creating command to update status on the entry
			        $sql= "UPDATE info_windows SET status='$status' WHERE mac='$mac'";
				// calling to function to excute variable sql
			        echo check_transation($sql);
			}
			//checking if value of download  has changed
			if ($data[0]["download"] != $download){
				//creating command to update download on the entry
                                $sql= "UPDATE info_windows SET download='$download' WHERE mac='$mac'";
				// calling to function to excute variable sql
                                echo check_transation($sql);
                        }
		}else{
		      //creating command to insert this mac on database
		      echo insert_db($mac, $name, $username, $time, $status, $download);
		}
}

// This function excutes command sql on database
function check_transation($sql)
{	
	//Calling to function connect_db to connect to database
	$conn = connect_db();
	//Executing command  sql on database
	if ($conn->query($sql) === TRUE) {
		
		return "New record created successfully";
	} else {
       		 return "Error: " . $sql . "<br>" . $conn->error;
               }
}
?>
