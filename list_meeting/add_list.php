<?php  include '../connect/class_crud.php';

    $crud = new CRUD();
    $userIds = $_POST['userid'];
    $title = $_POST['title'];
    $des = $_POST['description'];
    $date_start = $_POST['datetime_strart'];
    $date_end = $_POST['datetime_end'];
    $idroom = $_POST['roomid'];
    // $strCheck = "SELECT * FROM meeting WHERE room_id=$idroom AND date_time_start BETWEEN $date_start AND  $date_end";
    // echo $strCheck;
    $strCheck = "SELECT * FROM meeting WHERE room_id=$idroom and ( ( date_time_start between '$date_start' and '$date_end')  or (date_time_end between '$date_start' and '$date_end' ))";
    $res1 = mysql_query($strCheck);                         
    $num=mysql_num_rows($res1);
            if($num == 0){
                   $strdataTable = "meeting(title,description,date_time_start,date_time_end,room_id,user_id)";
                   $strdataValue = "('$title','$des','$date_start','$date_end','$idroom','$userIds')";
                  if($res = $crud->create($strdataTable,$strdataValue))
                     {
                            header('location:../admin.php?Page=listMeetingroom');
                     }
                     else
                     {
                            echo 'add Fail....';
                     } 
                 }else{
                    header('location:../admin.php?Page=listMeetingroom&state=1');
                 }

   
?>