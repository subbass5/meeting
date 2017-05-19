<?php
      include '../connect/class_crud.php';

      $crud = new CRUD();

      if(isset($_GET['id']))
      {
      	$id = $_GET['id'];
      	$strTableName = "room";
      	$strColID  = "room_id";
      	$strQueryNameImgDelete = "SELECT * FROM room WHERE room_id=".$id."";
        $strDelete_equipment = "DELETE FROM equipment WHERE room_id=".$id."";
        $strDelete_meeting = "DELETE FROM meeting WHERE room_id=".$id."";;
        $resDel_equipment = $crud->ElseCondition($strDelete_equipment);
        $resDel_meeting = $crud->ElseCondition($strDelete_meeting);
            ;
            if(mysql_num_rows($resDelete)>0){
               $obj = mysql_fetch_assoc($resDelete);
               $PartsImg = $obj['path_photo'];
               $flgDelete = unlink("../uploads/".$PartsImg);
               if($flgDelete){
                  if($res = $crud->deleteData($strTableName,$strColID,$id))
                   {
                        $resDelete = $crud->ElseCondition($strQueryNameImgDelete);
                           header('location:../admin.php?Page=manageMeetingroom');
                        
                    }
                    
                   }
                
                }else{
                  if($res = $crud->deleteData($strTableName,$strColID,$id))
                   {
                     header('location:../admin.php?Page=manageMeetingroom');
                   }
                  echo 'No delete.';
                  header('location:../admin.php?Page=manageMeetingroom');
                }

                  

            }
      	
      
?>