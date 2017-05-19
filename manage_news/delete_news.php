<?php include '../connect/class_crud.php';

    $crud = new CRUD();
    $id = $_GET['idnews'];
    echo $id;
    $strTableName = "public_relations";
    $strColID ="public_relations_id";
    
    if($crud->deleteData($strTableName,$strColID,$id)){
    	header('location:../admin.php?Page=manageNews');
    }else{
         header('location:../admin.php?Page=listMeetingroom');
    	echo "no delete";
    } 
     

 ?>    
    
