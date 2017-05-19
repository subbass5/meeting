<?php include '../connect/class_crud.php';

    $crud = new CRUD();
    $id = $_GET['iduser'];
    //echo $id;
    $strTableName = "users";
    $strColID ="user_id";
    
    if($crud->deleteData($strTableName,$strColID,$id)){
    	header('location:../admin.php?Page=manageUser');
    }else{
         header('location:../admin.php?Page=listMeetingroom');
    	echo "no delete";
    } 
 ?>    
