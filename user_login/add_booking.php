<?php 
   include '../connect/class_crud.php';

   $crud = new CRUD();
        $userIds = $_POST['id'];
   		$name = $_POST['namebooking'];
   		$title = $_POST['title'];
   		$des = $_POST['description'];
   		$date_start = $_POST['datetime_start'];
   		$date_end = $_POST['datetime_end'];
  		$roomid = $_POST['roomselect'];

  		$strdataTable = "meeting(title,description,date_time_start,date_time_end,room_id,user_id)";
        $strdataValue = "('$title','$des','$date_start','$date_end','$roomid','$userIds')";
        echo $strdataValue;
                  if($res = $crud->create($strdataTable,$strdataValue))
                     {
                            header('location:index.php');
                     }
                     else
                     {
                            echo 'add Fail....';
                     }

   


 ?>