
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Title Page</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	</head>
	<body>
	<div class="containr" style="width: 100%;">
		    <table class="table">
	           	 <tr class="success">
	           	 	<th><center>ลำดับที่</center></th>
	           	 	<th><center>เนื้อหาข่าว</center></th>
	           	 	<th><center>เวลาเริ่มต้น</center></th>
	           	 	<th><center>เวลาเริ่มสิ้นสุด</center></th>
	           	 	<th><center>แก้ไข</center></th>
	           	 	<th><center>ลบ</center></th>
	           	 </tr>
	           	 <tr>
		         			<td><center>1</center></td>
		         			<td><center>ข่าวสารอยากประกาศ</center></td>
		         			<td><center>2017-05-04 08:30:44</center></td>
		         			<td><center>2017-05-25 08:30:44</center></td>
		         			<td><center>
		         			    <form method="POST" action="#EDIT">
	
		         			     <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-edit" style="size: 15px;"></span> </button>
		         			    </form></center>
		         			</td>
		         			<td><center>
		         			    <form method="POST" action="#DELETE">
		 
		         			     <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash" style="size: 15px;"></span> </button>
		         			    </form></center>
		         			</td>
		         	</tr>
	           </table>
	            <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#myModal">
		         			        <span class="glyphicon glyphicon-plus-sign" style="size: 15px;">
		         			        </span> &nbsp; เพิ่ม
		         			     </button>    




		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
 		<script src="Hello World"></script>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>  
        <script src="js/jquery.datetimepicker.full.js"></script>
        <script type="text/javascript" src="js/dtpk.js"></script>
 		</div>
 		     <!-- pop up-->
  			<div class="modal fade" id="myModal" role="dialog">
  			  <div class="modal-dialog">
    
      			<!-- Modal content-->
     			 <div class="modal-content">
      			  <div class="modal-header">
        			  <button type="button" class="close" data-dismiss="modal">&times;</button>
         			<h4 class="modal-title">เพิ่มข้อมูลการจอง</h4>
        			</div>
        			<div class="modal-body">
        			   <form method="POST" class="form-grup">
        			      <p>เนื้อหาข่าว</p>
        			      <p>​
        			      <input type="txtarea" name="description" class="form-control" rows="10" cols="70"></p> 
        			      <p>วัน,เวลา เริ่มต้น </p>
        			      <p><input type="text" name="datetime_strart" id="testdate5" class="form-control"></p> 
        			      <p>วัน,เวลา สิ้นสุด</p>
        			      <p><input type="text" name="datetime_stop" id="testdate6" class="form-control"/></p> 
        			      

        			</div>
        			<div class="modal-footer">
         				 <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
         				 <input type="submit" name="submit" class="btn btn-success" value="ตกลง">
        			</div>
        			</form>
      				</div>
      
    			</div>
  				</div>
  				<!--out pop up-->
  				

	</body>
</html>