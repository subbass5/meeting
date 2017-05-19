<?php  include '../connect/class_crud.php';

    $crud = new CRUD();
    
    $des = $_POST['description'];
    $date_start = $_POST['datetime_strart'];
    $date_end = $_POST['datetime_stop'];

    $strdataTable = "public_relations(description,date_time_start,date_time_end)";
    $strdataValue = "('$des','$date_start','$date_end')";
                  if($res = $crud->create($strdataTable,$strdataValue))
                     {
                            header('location:../admin.php?Page=manageNews');
                     }
                     else
                     {
                            echo 'add Fail....';
                     }
?>