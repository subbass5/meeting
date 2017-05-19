<?php include '../connect/class_crud.php';
	  $id = $_POST['iduser'];
	  $user = $_POST['username'];
	  $pass = $_POST['password'];
	  $status = $_POST['status'];
	  $pass = base64_encode($pass);
	     $strdataTable = "users(username,password,status)";
         $strdataValue= "('$user','$pass','$status')";

                $strQuery = "UPDATE users SET";
                $strQuery .= " user_id= ".$id."";
                $strQuery .= ",username= '".$user."'";
                $strQuery .= ",password='".$pass."'";
                $strQuery .= ",status='".$status."'";
                $strQuery .= " WHERE user_id=".$id."";

               $crud = new CRUD();
                if($res =$crud->ElseCondition($strQuery)){
               header('location:../admin.php?Page=manageUser');
                }else{
                	echo "No save data";
                }
                
 ?>