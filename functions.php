<?php
function connect_db()
{
	include 'db.conf';
	// Create connection
    	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
    	if ($conn->connect_error) {
        	die("Connection failed: " . $conn->connect_error);
	}	 
	return $conn;
}

function select_db($mac) 
{
	$conn = connect_db();
	$data = array();
	if ( $mac == '*'){
		$sql = "SELECT * FROM info_windows";
	}else{
		$sql = "SELECT * FROM info_windows Where mac = '$mac'";
	}
   	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
		  $data[] = $row;
	  }
          } else {
                return "0 results";
	  } 
	return $data;
}

function insert_db($mac, $name, $username, $time, $status, $download)
{
	$sql = "INSERT INTO info_windows (mac, name, username, time, status, download) values ('$mac', '$name', '$username', '$time', '$status', '$download')";
        check_transation($sql);	
}

function update_db($mac, $name, $username, $time, $status, $download)
{
		$data = select_db($mac);
		if ($data[0]["mac"] == $mac){
			if($data[0]["name"] != $name){
				$sql= "UPDATE info_windows SET name='$name' WHERE mac='$mac''";
				echo check_transation($sql);

			}
			if ($data[0]["username"] != $username){
				$sql= "UPDATE info_windows SET username='$username' WHERE mac='$mac'";
				echo check_transation($sql);
			}
			if ($data[0]["time"] != $time){
				$sql= "UPDATE info_windows SET time='$time' WHERE mac='$mac'";
				echo check_transation($sql);
	                }
			if ($data[0]["status"] != $status){
			        $sql= "UPDATE info_windows SET status='$status' WHERE mac='$mac'";
			        echo check_transation($sql);
			}
			if ($data[0]["download"] != $download){
                                $sql= "UPDATE info_windows SET download='$download' WHERE mac='$mac'";
                                echo check_transation($sql);
                        }
		}else{
		      echo insert_db($mac, $name, $username, $time, $status, $download);
		}
}

function check_transation($sql)
{
	$conn = connect_db();
	if ($conn->query($sql) === TRUE) {
		return "New record created successfully";
	} else {
       		 return "Error: " . $sql . "<br>" . $conn->error;
               }
}
?>
