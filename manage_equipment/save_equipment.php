<?php  include '../connect/class_crud.php';

        $id = $_POST['equipmentid'];
        $name = $_POST['name'];
        $des = $_POST['description'];
        $amount = $_POST['amount'];
        $roomid = $_POST['roomid'];
                $strQuery = "UPDATE equipment SET";
                $strQuery .= " name= '".$name."'";
                $strQuery .= ",description='".$des."'";
                $strQuery .= ",room_id='".$amount."'";
                $strQuery .= ",room_id='".$roomid."'";
                $strQuery .= " WHERE equipment_id =".$id."";
           echo $strQuery;
               $crud = new CRUD();
                if($res =$crud->ElseCondition($strQuery)){
                   header('location:../admin.php?Page=manageEquipment');
                }else{
                	echo "No save data";
                }
                



?>

