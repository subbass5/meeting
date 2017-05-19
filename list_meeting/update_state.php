<?php 
include '../connect/class_crud.php';
        $id = $_POST['idmeeting'];
        $stateIn = $_POST['state'];
        $strQuery = "UPDATE meeting SET";
        $strQuery .= " state='" . $stateIn . "'";
        $strQuery .= " WHERE meeting_id =" . $id . "";
        
        $crud = new CRUD();
        
        if($res =$crud->ElseCondition($strQuery)){
                    header('location:../admin.php?Page=manageMeeting');
                }else{
                	echo "No save data + $strQuery";
                }

?>
