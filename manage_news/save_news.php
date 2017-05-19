<?php  include '../connect/class_crud.php';

        $id = $_POST['idnews'];
        $des = $_POST['description'];
        $timestart = $_POST['timestart'];
        $timeend = $_POST['timeend'];

        $strdataTable = "public_relations(description,date_time_start,date_time_end)";
        $strdataValue= "('$des','$timestart','$timeend')";

                $strQuery = "UPDATE public_relations SET";
                $strQuery .= " public_relations_id = ".$id."";
                $strQuery .= ",description='".$des."'";
                $strQuery .= ",date_time_start='".$timestart."'";
                $strQuery .= ",date_time_end='".$timeend."'";
                $strQuery .= " WHERE public_relations_id =".$id."";

               $crud = new CRUD();
                if($res =$crud->ElseCondition($strQuery)){
               header('location:../admin.php?Page=manageNews');
                }else{
                	echo "No save data";
                }
                



?>

