<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title></title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	</head>
	<body>
	  <div class="container" style="width: 100%;">
	     <?php include './connect/class_crud.php';
	           $crud = new CRUD();
	           $strQuery = 'SELECT * FROM users';
	           $res = $crud->ElseCondition($strQuery);

	               if(mysql_num_rows($res))
	                 { ?>
	           		<table class="table" style="width: 100%;">
	           	 		<tr class="success">
	           	 			<th><center>ลำดับที่</center></th>
	           	 			<th><center>ชื่อผู้ใช้</center></th>
	           	 			<th><center>รหัสผ่าน</center></th>
	           	 			<th><center>สิทธิ์การเข้าใช้งาน</center></th>
	           	 			<th><center>แก้ไข</center></th>
	           	 			<th><center>ลบ</center></th>
	           	 		</tr>

	           	 <?php 
	           	       $countRow = 1;
                      while ($objUser = mysql_fetch_assoc($res)) {
	           	  ?>
	           			 <tr>
		         			<td><center><?=$countRow ?></center></td>
		         			<td><center><?=$objUser['username'] ?></center></td>
		         			<td><center><?=$objUser['password'] ?></center></td>
		         			<td><center>
                             <?php if($objUser['status']==1)
                                    { 
                                        echo "ผู้ใช้งานทั่วไป";
                                    }else if($objUser['status']==2)
                                    {
                                      echo "ผู้ดูแลระบบ";
                                    } ?>
                    </center>
                  </td>
		         			<td><center>
		         			               <a href="#" onclick="load_data('<?=$objUser['user_id']?>')" data-toggle="modal" data-target=".bs-example-modal-table" > 
		         			    		    <button class="btn btn-info" >
		         			    				   <span class="glyphicon glyphicon-edit" style="size: 15px;">
		         			    				   </span> 
		         			    			  </button>
		         			    		    </a>
		         			</td>
		         			<td><center>
		         			       <a href="manage_user/delete_user.php?iduser=<?=$objUser['user_id']?>"
                                  class="ask-custom">
                                       <button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" style="size: 15px;"></span> </button>
                                   </a>
		         			    </center>
		         			</td>
		         	</tr>
	           

	           <?php   $countRow++;
                     }
                     echo "</table>";
                 }

	            ?>
	            <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#myModal">
		         			        <span class="glyphicon glyphicon-plus-sign" style="size: 15px;">
		         			        </span> &nbsp; เพิ่ม
		         			     </button>    

		

		
 		</div>
 		 <!-- pop up-->
  			<div class="modal fade" id="myModal" role="dialog">
  			  <div class="modal-dialog">
    
      			<!-- Modal content-->
     			 <div class="modal-content">
      			  <div class="modal-header">
        			  <button type="button" class="close" data-dismiss="modal">&times;</button>
         			<h4 class="modal-title">เพิ่มข้อมูลผู้ใช้งาน</h4>
        			</div>
        			<div class="modal-body">
        			   <form method="POST" class="form-grup" action="manage_user/add_user.php">
        			      <p>บัญชีผู้ใช้</p>
        			      <p><input type="text" name="username" class="form-control" required></p>
        			      <p>รหัสผ่าน</p>
        			      <p><input type="password" name="password" class="form-control" required></p>  
        			      <p>สิทธิ์ในการใช้งาน</p>
        			      <p>
                        <select name="permission" class="form-control">
                          <option value="1">ผู้ใช้งานระบบ</option>
                          <option value="2">ผู้ดูแลระบบ</option>
                        </select>


                    </p>
        			      
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
  				<!--start edit data-->
  					<div class="modal fade bs-example-modal-table" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h3 class="modal-title">แก้ไขข้อมูลผู้ใช้งาน</h3>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body no-padding">
                        <div class="table-responsive" style="  height:350px; ">
                            <div id="divDataview">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>ปิด</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <!--out edit data-->
    <!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
 		<script src="Hello World"></script>
 		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>  
        <script src="js/jquery.datetimepicker.full.js"></script>
        <script type="text/javascript" src="js/dtpk.js"></script>
        <script type="text/javascript">
         $(document).ready(function() {
            $('.ask-custom').jConfirmAction({question : "คูณต้องการลบข้อมูลหรือไม่", yesAnswer : "ใช่", cancelAnswer : "ยกเลิก"});
      	 });
         function load_data(idInput){
		     	var sdata = {
		     		id:idInput
		     	}
		     	$('#divDataview').load('manage_user/edit_user.php',sdata);
		     }
        	
        </script>
	</body>
</html>