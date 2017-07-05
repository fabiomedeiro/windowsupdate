
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  	<head>
		<title>Windows Updates JMedia</title>
		<style>
			table, th, td  { border: 1px solid black; text-align: center;}
			table {width:100%;}
			th, td { width:16%;}
			h1 {text-align: center;}
		</style>
  	</head>
	<body>
		<h1>Status Windows Updates of Machines</h1>
		<table>
			<tr >
				<th>MAC</th>
				<th>Machine Name</th>
				<th>User</th>
				<th>Last Update</th>
				<th>Status</th>
				<th>Download</th
			</tr>
			<?php
				include 'functions.php';
				$result = select_db('*');
				$n = count($result);
				for($x = 0; $x < $n; $x++){ ?>
					<tr>
						<td><?php echo $result[$x]["mac"];?></td>
						<td><?php echo $result[$x]["name"];?></td>
						<td><?php echo $result[$x]["username"];?></td>
						<td><?php echo $result[$x]["time"];?></td>
						<td><?php echo $result[$x]["status"];?></td>
						<td><?php echo $result[$x]["download"];?></td>
					</tr>
					
			<?php	}
			?>
		</table>
  	</body>
</html>

