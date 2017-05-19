<?php  session_start();  
       include_once 'connect/class_crud.php';
?>
<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>Login</title>
			<!-- Bootstrap CSS -->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		</head>
		<body>
			
			<?php  
                  $strStatus1 = "กรุณากรอกข้อมูลให้ครบถ้วน";
	     		  $strStatus2 = "รหัสผ่าน หรือ ชื่อผู้ใช้ไม่ถูกต้อง";
	     		if(isset($_POST['submit']))
	     		{
                    $crud = new CRUD();
	     			$username = @$_POST['username'];
	     			$password = @$_POST['password'];
	     			$password = base64_encode($password);
                    $condition = "SELECT * FROM users WHERE username='".$username."' AND password='".$password."';";
	     			
	     			$res = $crud->ElseCondition($condition);
	     			if(@mysql_num_rows($res) > 0){
	     				while ($row = mysql_fetch_assoc($res)) {
	     					$_SESSION['userid'] = $row["username"]; 
	     					$_SESSION['idlogin'] = $row["user_id"]; 
	     					
	     						   if($username=='admin')
	     						    {
	     						   	 header('location:admin.php');

	     					        }else{
	     					         header('location:user_login/index.php');
	     					        }
	     					}

	     	     	}else if($username==''|| $password==''){
	     	     		
	     				header('location:index.php?page=login&status=1');

	     	     	}else{

	     				header('location:index.php?page=login&status=2');
	     			}
	    	     }else{
	     	          ?>

	                     <div class="login">
	                       <form method="POST">
	                          <br><br><h3 class="text-center">ล็อกอินเข้าสู่ระบบจองห้องประชุม</h3>
		         		      <table align="center" border="0">
		           			     <tr valign="TOP">
		           	  				 <!--Picture-->
		           	     				  <td width="100">
		           	       					<div style="width: 200px; height: 200px; background-color: #FCFCFC;">
		           	       					 <br><br><center><img src="img/user-icon.png" style="width: 100px; height: 100px;"></center>
		           	       					</div>
		           	       				  </td>
		           	    		     <!--form login-->
		           	     				  <td width="300">
		           	     				  <br>
	                         				 <table>
	                         				         <tr>
	                          	    				  <td>
	                          	    				      <br>
	                          	    				  </td>
	                          	    				  </tr>
	                          						<tr valign="rigth" height="15">
	                          	    				  <td > 
	                          	    				      <label>
	                          	    				          ชื่อผู้ใช้ &nbsp;  
	                          	    				       </label>
	                          	    				  </td>
	                          	    				  
	                          	    				  <td valign="rigth">
	                          	        				 <input type="text" name="username" id="username" class="form-control" autofocus="autofocus">
	                          	        				 
	                          	    				  </td>

	                          						</tr>
	                          						<tr>
	                          	    				  <td>
	                          	    				      <br>
	                          	    				  </td>
	                          	    				  </tr>
	                          				        <tr>
	                          	    				  <td>
	                          	    				      <label>
	                          	    				          รหัสผ่าน &nbsp;   
	                          	    				      </label>
	                          	    				  </td>
	                          	    				  <td>
	                          	        				 <input type="password" name="password" id="password" class="form-control">
	                          	    				  </td>
	                          						</tr>
	                          					    <tr>
	                          	    				  <td>
	                          	        				   
	                          	    				  </td>
	                          						</tr>
	                         				 </table>
	                         				 <br>
	                         				 <center>
	                         				       <input type="submit" name="submit" class="btn btn-success"   value="ลงชื่อเข้าใช้">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" class="btn btn-danger"   value="เครียค่า">

	                         				 </center>
                                             <center>
                                                  <span style="color: red;">
                                                      <br>
                                                       <?php  
                                                         $chk = @$_GET['status'];
                                                       if($chk==1){
                                                          echo $strStatus1;
                                                       }else if($chk==2){
														  echo $strStatus2;
                                                       }else{
                                                       	echo "";
                                                       }
                                                       ?>
                                                  </span>
                                             </center>
		           	       				  </td>
		           	   		     </tr>
		           			  </table>
		         			</form>
	           			  </div>

	     	           <?php

	                 }
	                   ?>
		
			<!-- jQuery -->
			<script src="//code.jquery.com/jquery.js"></script>
			<!-- Bootstrap JavaScript -->
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
			<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	 		<script src="Hello World"></script>
		</body>
	</html>	


