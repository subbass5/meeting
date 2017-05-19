<?php 
  // $id =$_POST['numberCount'];
  include '../../connect/class_crud.php';
  $crud  = new CRUD();
  $number =$_POST['numberCount'];
  $roomid = $_POST['roomid'];
  $state = $_POST['chk'];
  $strdataTable = "equipment(name,description,amount,room_id)";
	  for($i=1;$i<=$number;$i++)
	  {
	  	$data_equipment[$i-1]   =  $_POST['equipment'.$i];
	  	$data_description[$i-1] =  $_POST['des'.$i];
        $data_number[$i-1]      =  $_POST['numberEquipment'.$i];
        $strdataValue = "('".$data_equipment[$i-1]."','".$data_description[$i-1]."','".$data_number[$i-1]."','$roomid')";

        $str = "INSERT INTO ".$strdataTable." VALUES ".$strdataValue;
        //echo $strdataTable."  :  ".$strdataValue."<br> $str";
         if($res = $crud->create($strdataTable,$strdataValue)){

         }else{
         	echo "No save data";
         }
	  }
    if($state==1){
      header('location:../../admin.php?Page=manageEquipment');
    }else{
      header('location:../../admin.php?Page=manageEquipment');
    }
	  

	 

?>