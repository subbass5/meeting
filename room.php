<?php  session_start();  
error_reporting(E_ALL ^ E_DEPRECATED);
       include_once 'connect/class_crud.php';
	//	require_once("FILE_PATH"); or
include_once("connect/class_crud.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style type="text/css" media="screen">
  .modal-header, h4, .close {
      background-color: #5cb85c;
      color:white !important;
      text-align: center;
      font-size: 30px;
  }
  
  .modal-footer1 {
      background-color: #A1C4D8;
  }	
	</style>
</head>
<body>
	<center> <h3> รายละเอียดห้องประชุม </h3>
		<?php
		$crud = new CRUD();
 		$res=mysql_query("SELECT * FROM room");
 		 while($row = mysql_fetch_array($res))
 {		
		
		?>
 &nbsp;		<table border="0"  width="600" height="200" style=" background-color:#F3F3F3"  >
			<tr>
			<td width="300" valign="top" >
			<img src="uploads/<?php  echo $row['path_photo'] ?>" style="width: 300px; height: 200px; padding: 10px">


			</td>
			<td valign="top" >
			<br>
			
			<table class="table table-striped table-condensed"   >	
						
						<tr>
							<td width="120" > ชื่อห้องประชุม : </td>
							<td> <?php echo $row['name'] ?> </td>
						</tr>						
						<tr>
							<td> ความจุ : </td>
							<td> <?php echo $row['number']?> </td>
						</tr>
						<tr>
							<td> รายละเอียด : </td>
							<td> <?php echo $row['description']?> </td>
						</tr>
						<tr>
							<td> อุปกรณ์ : </td>
							<!-- <td>  <a data-toggle="modal" data-target="#myModal" onclick="return readEq(<?php //echo $row['room_id']?>);" > รายชื่ออุปกรณ์ </a> -->
							<!-- </td> -->
							<?php $id = $row['room_id']; 
								
								$crud = new CRUD();
						 		
							 ?>
							<td>
							<?php	$result=mysql_query("SELECT * FROM equipment WHERE room_id=$id");
							//	$num_rows = mysql_num_rows(res1);

								$num=mysql_num_rows($result); 
						        if($num==0)   {

						 			echo "ไม่มีอุปกรณ์";
						 		
 								 }else{
 								 	 while($row1 = mysql_fetch_array($result))
						 		{ ?>						
						 			<div> <?php  echo $row1['name']; ?>      <?php  echo $row1['description']; ?> </div> 			
						 	   <?php	}
 								 	}	?>	
							</td>
						</tr>
					</table>
				

				</td>
		
			</tr>
			
		</table>
 		<?php  
 			}
 		 ?>
		<br>
  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" align="center" background-color="#FFFFFF" >
        <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <span  class="glyphicon glyphicon-list-alt" aria-hidden="true">  รายชื่ออุปกรณ์ </span>
      </div>

      <div class="modal-body">
     		<div class="form-inline" id="container"> 

			 
				


		
     		</div>


      </div>

      <div class="modal-footer">
       
      <button  onclick="return removeElement()" type="reset" class="btn btn-danger" data-dismiss="modal">
        <span  class="glyphicon glyphicon-remove" aria-hidden="true">  ปิด </span>

        </button>

          
        </div>
 </form>  

     
    </div>
  </div>
</div>
 <script type="text/javascript">
 	function readEq(room_id) { 

	    var node = document.createElement('div');        
      node.innerHTML = room_id;       
       document.getElementById('container').appendChild(node);

<?php 
		//	$crud = new CRUD();
		//	$data = ("SELECT * FROM equipment WHERE room_id = room_id ")
		//$res=mysql_query("SELECT * FROM equipment WHERE room_id = $room_id ");
 
		?>

 	}	
function removeElement() {
	

 //document.getElementById('container').value= room_id ; 
	 //   var node = document.createElement('div');        
     // node.innerHTML = '';       
       document.getElementById('container').innerHTML='';

 			<?php /*

		$crud = new CRUD();
 		$res=mysql_query("SELECT * FROM equipment WHERE room_id = $room_id ");
 		 while($row = mysql_fetch_array($res))
 {		
		 
		*/?>

 	}	

 </script>	
 </center>
</body>
</html>
