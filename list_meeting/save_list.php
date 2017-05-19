<?php  include '../connect/class_crud.php';

        $id = $_POST['idmeeting'];
        $title = $_POST['title'];
        $des = $_POST['description'];
        $timestart = $_POST['timestart'];
        $timeend = $_POST['timeend'];
        $state = $_POST['state'];
        $roomid = $_POST['roomid'];

      

                $strQuery = "UPDATE meeting SET";
                $strQuery .= " meeting_id= ".$id."";
                $strQuery .= ",title= '".$title."'";
                $strQuery .= ",description='".$des."'";
                $strQuery .= ",date_time_start='".$timestart."'";
                $strQuery .= ",date_time_end='".$timeend."'";
                $strQuery .= ",state='".$state."'";
                $strQuery .= ",room_id='".$roomid."'";
                $strQuery .= " WHERE meeting_id =".$id."";

               $crud = new CRUD();
                if($res =$crud->ElseCondition($strQuery)){
                    header('location:../admin.php?Page=listMeetingroom');
                }else{
                	echo "No save data";
                }
                



?>

