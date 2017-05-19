<?php  include '../connect/class_crud.php'; 
        $crud = new CRUD();

			$user = $_POST['username'];
			$pass = $_POST['password'];
			$per = $_POST['permission'];
            $passwordSave = base64_encode($pass);
			      $strdataTable = "users(username,password,status)";
             $strdataValue = "('$user','$passwordSave','$per')";
                  if($res = $crud->create($strdataTable,$strdataValue)){
                  	header('location:../admin.php?Page=manageUser');
                  }else{
                  	echo "NO";
                   header('location:../admin.php?Page=manageUser');
                  }
 ?>