<!DOCTYPE html>
<html ng-app="shanidkvApp">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title></title>
		 <!-- Bootstrap CSS -->
     <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="css/jquery.datetimepicker.css">

    

	</head>
	<body>
  <?php 
          include 'connect/class_crud.php';

    ?>
	   <div class="container" style="width: 100%;">
		   
		     <div class="tabale_data">

		         	<?php 
                             // ส่วนของแสดงข้อมูลรายละเอียดของห้องประชุมทั้งหมด   
                             $crud = new CRUD();
                             $strShowdata = "SELECT * FROM equipment";
                             $res = $crud->ElseCondition($strShowdata);

                               if(mysql_num_rows($res)>0){
                                ?>
                               	  <table class="table" style="width: 100%;">
		         								           <tr class="success" >
		         									            <th ><center>ลำดับ</center></th>
		         								              <th><center>ชื่ออุปกรณ์</center></th>
		         									            <th><center>รายละเอียด</center></th>
                                          <th><center>จำนวน</center></th>
		         									            <th><center>ห้อง</center></th>
		         									            <th><center>แก้ไข</center></th>
		         									            <th><center>ลบ</center></th>
		         								           </tr>
                           
                            <?php
                            
                                 $number_row = 1;
                               	    while($obj = mysql_fetch_assoc($res)){

                               	    	?>
                               	    	<tr>
            		         						    <td><center><?=$number_row?></center></td>
            		         						    
            		         						    <td><center><?=$obj['name'] ?></center></td>
            		         								<td><center><?=$obj['description'] ?></center></td>
                                        <td><center><?=$obj['amount'] ?> ชิ้น</center></td>
            		         								<td>
                                             <center>
                                             <?php
                                                $strQuery =  "SELECT * FROM room WHERE room_id= ".$obj['room_id'];
                                                $ress = $crud->ElseCondition($strQuery);
                                                $objs = mysql_fetch_assoc($ress);
                                                  echo $objs['name'];

                                              ?>
                                            </center>
                                        </td>
                            
                             
		         								 <td><center>
				                                             
		         			    					    <a href="#" onclick="load_data_edit('<?=$obj['equipment_id']?>')" data-toggle="modal" data-target=".bs-example-modal-table" > 
		         			    					         <button class="btn btn-info" >
		         			    						         <span class="glyphicon glyphicon-edit" style="size: 15px;">
		         			    						         </span> 
		         			    					         </button>
		         			    					    </a>
		         			    			        </center>
		         							     </td>
		         								<td><center>
                                       <a href="manage_equipment/delete_equipment.php?idequipment=<?=$obj['equipment_id']?>"
                                  class="ask-custom">
                                       <button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" style="size: 15px;"></span> </button>
                                   </a>

		         			   						  
		         			    					</center>
		         								</td>
		         			                    
		         	                         </tr>
                               	    	<?php
                               	    	$number_row++;
                               	    }
                                   echo "</table>";
                                   ?>
                                  <a href="#" onclick="load_data_add('<?=$obj['room_id']?>')" data-toggle="modal" data-target=".bs-example-modal-table2" > 
                                         <button class="btn btn-success" >
                                           <span class="glyphicon glyphicon-plus" style="size: 15px;">
                                           </span> เพิ่ม
                                         </button>
                                    </a>

                                    <?php
                               }else{
                                echo "<h3 class='text-center' style='color:red;'>ไม่พบข้อมูลอุปกรณ์</h3> ";
                                // <a href='#' onclick='load_data_add()' data-toggle='modal' data-target='.bs-example-modal-table2' > 
                                //          <button class='btn btn-success' >
                                //            <span class='glyphicon glyphicon-plus' style='size: 15px;'>
                                //            </span> เพิ่ม
                                //          </button>
                                //     </a>
                              


                               }
		         	?>

		     </div>
 		</div>
	
      <!--edit equiement-->    
  		<div class="modal fade bs-example-modal-table" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h3 class="modal-title">แก้ไขอุปกรณ์</h3>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body no-padding">
                        <div class="table-responsive" style="  height:350px; ">
                            <div id="divDataview1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>ปิด</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!--out edit equiement-->
    <!--add equiement-->
    <div class="modal fade bs-example-modal-table2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="pull-left">
                           
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body no-padding">
                        <div class="table-responsive" style="  height:450px; ">
                            <div id="divDataview2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>ปิด</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <!--out add equiement-->
    


               
      <!-- jQuery -->
    <script src="//code.jquery.com/jquery.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.3.2.js"></script>
  
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>  
        <script src="js/jquery.datetimepicker.full.js"></script>
        <script type="text/javascript" src="js/dtpk.js"></script>
        <script type="text/javascript" src="js/addfields.js"></script>
		<script type="text/javascript">
     $(document).ready(function() {
        $('.ask-custom').jConfirmAction({question : "คูณต้องการลบข้อมูลหรือไม่", yesAnswer : "ใช่", cancelAnswer : "ยกเลิก"});
      });

		     function load_data_edit(idInput){
		     	var sdata = {
		     		id:idInput
		     	}
		     	$('#divDataview1').load('manage_equipment/edit_equipment.php',sdata);
		     }

         function load_data_add(idInput){
          var sdata = {
            id:idInput
          }
          $('#divDataview2').load('manageroom/manage_equipment/manage_equipment.php',sdata);
         }

		</script>
</body>
</html>