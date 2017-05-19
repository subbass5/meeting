<?php   
     session_start();
     if(!$_SESSION['userid'] =="admin"){
     	header('location:../logout.php');
     }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>User</title>
		<!-- Bootstrap CSS -->
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link rel="stylesheet" href="../css/jquery.datetimepicker.css">
		<link rel="stylesheet" href="../css/scroll.css">
		
	</head>
	<body style="background-color: #eeeeee; ">
	          
	   			<div class="container">
				<table style="background-color: #EEEEEE;">
					<tr>
						<td>
						      <img src="../img/header.png" style="width: 100%; height: 300px;">
						</td>
					</tr>
					<tr VALIGN="TOP">
						<td><center>
							<table style="width: 100%;">
								<tr VALIGN="TOP">
									<td width="200">
									   <!--menu ต่างๆ-->
									   <br>
									    <h4>
									          <span class="glyphicon glyphicon-user"></span>
									              &nbsp;&nbsp;<?=$_SESSION['userid'] ?>
									    </h4><br>
									     <table  width="200">
									     	<tr>
									     	   
									     	   <!--menu 1-->
									     		<td>
									     				<table class="table">
									     					<tr class="info" VALIGN=TOP>
									     					   <th><a href="index.php">เมนูหลัก</a></th>
									     					</tr>
									     					<tr>
									     						<td>
									     						<a href="?Page=booking" style="color: #666666;">จองห้องประชุม
									     						</a>
									     						</td>
									     					</tr>
									     					
									     				</table>	
									     				<br><br>
									     		</td>
									     	</tr>
									     	<tr>
									     	    <!--menu logout-->
									     		<td>
									     		    <center>
									     				<a href="logout.php">
									     				    <button type="button" class="btn btn-danger">
									     				        <span class="glyphicon glyphicon-log-out">
									     				        </span>
									     				        &nbsp;Logout
									     				    </button>
									     				</a>
									     			</center><br>
									     		</td>
									     	</tr>
									     </table>
									</td>
									<td >
									  <!--content show -->
									  <div class="demo">
									    <div class="scroll">
											  <?php   
											  	$file = @$_GET['Page'];
		                                        if($file=='' || $file=='index'){
		                                        	
		                                        	 include 'calendar2.php';
		                                        	 ?>
		                                        	   <script>
		                                        	    $(document).ready(function() {
												          	toastr.success("ยินดีต้อนรับ")
												          });
							       
		                                              </script>
		                                        	  

		                                        	 <?php

		                                            
		                                        }else if($file=='booking'){
		                                        	include '../connect/class_crud.php';

		                                        	$crud = new CRUD();
                                                    echo "<h2 class='text-center'> รายการประชุม</h2><br>";
                                                    ?>
                                                      <div class="booking">
                                                         <form method="POST" action="add_booking.php">
                                                           <table width="350" align="center">
                                                           <tr>
                                                           	   	<th width="1%" ><br>
                                                           	   	                <center>
				                                                           	   	        <label>
				                                                           	   	    	  ชื่อผู้จอง
				                                                           	   	        </label>
                                                           	   	                </center>
                                                           	   	</th>
                                                           	   	<th width="3%"><br>
                                                           	   	 <?php   
                                                                         $str = "SELECT * FROM users WHERE user_id= ".$_SESSION['idlogin'];
                                                                         $ress = mysql_query($str);
                                                                         $obj = mysql_fetch_assoc($ress);

                                                           	   	 ?>
                                                           	   	    <input type="hidden" name="id" value="<?=$obj['user_id']?>">
                                                           	   	    <input type="text" class="form-control"  name="namebooking" value="<?=$obj['name']?>">
                                                           	   	    
                                                           	   	</th>

                                                           	   </tr>
                                                           	   <tr>
                                                           	   	<th width="1%" ><br>
                                                           	   	                <center>
				                                                           	   	        <label>
				                                                           	   	    	  ห้วข้อการประชุม
				                                                           	   	        </label>
                                                           	   	                </center>
                                                           	   	</th>
                                                           	   	<th width="3%"><br>
                                                           	   	    <input type="text" class="form-control"  name="title"  required>
                                                           	   	    
                                                           	   	</th>

                                                           	   </tr>
                                                           	   <tr>
                                                           	   	<th width="1%" ><br>
                                                           	   	                <center>
				                                                           	   	        <label>
				                                                           	   	    	  คำธิบาย
				                                                           	   	        </label>
                                                           	   	                </center>
                                                           	   	</th>
                                                           	   	<th width="3%"><br>
                                                           	   	    <input type="text" class="form-control"  name="description"  required>
                                                           	   	    
                                                           	   	</th>

                                                           	   </tr>
                                                           	   <tr>
                                                           	   	<th width="1%" ><br><center>
				                                                           	   	        <label>
				                                                           	   	    	   ห้อง
				                                                           	   	        </label>
                                                           	   	                </center>
                                                           	   	</th>
                                                           	   	<th width="3%"><br>
                                                           	   	    
                                                           	   	    <select name="roomselect" class="form-control">
                                                           	   	        <?php
                                                                            $strQ = "SELECT * FROM room";
                                                                            $res = $crud->ElseCondition($strQ);
                                                                              if(mysql_num_rows($res))
                                                                              {
                                                                              	 while ($obj = mysql_fetch_assoc($res)) 
                                                                              	 {

                                                                              	 	echo "<option value=".$obj['room_id'].">".$obj['name']."</option>";
                                                                              	 }

                                                                              }
                                                           	   	        ?>
                                                           	   	    </select>
                                                           	   	    
                                                           	   	</th>

                                                           	   </tr>
                                                           	   <tr>
                                                           	   	<th width="1%" ><br>
                                                           	   	                <center>
				                                                           	   	        <label>
				                                                           	   	    	  เวลาเริ่มต้น
				                                                           	   	        </label>
                                                           	   	                </center>
                                                           	   	</th>
                                                           	   	<th width="3%"><br>
                                                           	   	    <input type="text" class="form-control"  name="datetime_start" id="testdate5" required>
                                                           	   	    
                                                           	   	</th>

                                                           	   </tr>
                                                           	   <tr>
                                                           	   	<th width="1%" ><br>
                                                           	   	                <center>
				                                                           	   	        <label>
				                                                           	   	    	  เวลาเริ่มสิ้นสุด
				                                                           	   	        </label>
                                                           	   	                </center>
                                                           	   	</th>
                                                           	   	<th width="3%"><br>
                                                           	   	    <input type="text" class="form-control"  name="datetime_end" id="testdate6" required>
                                                           	   	    
                                                           	   	</th>

                                                           	   </tr>
                                                           </table>
                                                           <br><br>
                                                           <center>
                                                           			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" class="btn btn-success" name="submit" value="ยืนยัน"> 
                                                          			 <input type="reset" class="btn btn-info" value="ล้างข้อมูล" > 
                                                           </center>
                                                           </form>

                                                       </div>
                                                       <br><br>
                                                       <center>
                                                        <span class="glyphicon glyphicon-pushpin" style="color:red;">
                                                        	กรุณาป้อนข้อมูลจริง
                                                        </span>
                                                        </center>

                                                    <?php
		                                        	
		                                        }
									 			 ?>
		                                        
									        <br>
									      </div>
									 </div>
									</td>
								</tr>
							  </table>
							</center>
						</td>
					</tr>
				</table>

			</div>
<?php include '../footer.php';?>
       
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" type="text/javascript"></script>
 		<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"></script>
 		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>  
        <script src="../js/jquery.datetimepicker.full.js"></script>
        <script type="text/javascript" src="../js/dtpk.js"></script>
      

       
	</body>
</html>