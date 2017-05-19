<?php  session_start();  
error_reporting(E_ALL ^ E_DEPRECATED);
       include_once 'connect/class_crud.php';
	//	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<div>
		<h3><font color=red><u>ประกาศประชาสัมพันธ์ </u></font></h3>
		 <?php 	include 'daymoth_thai.php'; ?>
								 
<?php
		$date = date('Y-m-d');
		
		$crud = new CRUD();
		$aa="SELECT * FROM public_relations WHERE date_time_start <= curdate() AND curdate() <= date_time_end";	
 		$res=mysql_query($aa);
 		 while($row = mysql_fetch_array($res))
 {		
		
		?>
<ul>
		<li><?php echo $row['description'] ?><font color=gray size=2>     ( <?php echo DateThai1($row['date_time_start'] );  ?> ) </font>  <img src="img/new.gif"></li>
</ul>

 
		<?php  
 			}
 		 ?>
	</div>
	
</body>
</html>