<?php include '../connect/class_crud.php';

    $crud = new CRUD();
    $id = $_GET['idequipment'];
    echo $id;
    $strTableName = "equipment";
    $strColID ="equipment_id";
    
    if($crud->deleteData($strTableName,$strColID,$id)){
    	header('location:../admin.php?Page=manageEquipment');
    }else{
         header('location:../admin.php?Page=listMeetingroom');
    	echo "no delete";
    } 
     

 ?>    
    
