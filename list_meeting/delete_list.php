<?php include '../connect/class_crud.php';

    $crud = new CRUD();
    $id = $_GET['idlist'];
    echo $id;
    $strTableName = "meeting";
    $strColID ="meeting_id";
    
    if($crud->deleteData($strTableName,$strColID,$id)){
    	header('location:../admin.php?Page=listMeetingroom');
    }else{
         //header('location:../admin.php?Page=listMeetingroom')
    	echo "no delete";
    } 
     

 ?>    
    
