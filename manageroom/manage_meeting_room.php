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
                             $strShowdata = "SELECT * FROM room";
                             $res = $crud->ElseCondition($strShowdata);

                               if(mysql_num_rows($res)>0){
                                ?>
                               	  <table class="table"">
		         								           <tr class="success" >
		         									            <th width="8.11%"><center>ลำดับ</center></th>
		         								              <th width="11.11%"><center>ชื่อห้อง</center></th>
		         									            <th width="11.11%"><center>รายละเอียด</center></th>
		         									            <th width="11.11%"><center>ชื่อรูปภาพ</center></th>
		         									            <th width="11.11%"><center>จำนวน(คน)</center></th>
                                          <th width="15.11%"><center>จำนวนอุปกรณ์</center></th>
                                          
                                          <th width="11.11%"><center>เพิ่มอุปกรณ์</center></th>
		         									            <th width="11.11%"><center>แก้ไข</center></th>
		         									            <th width="11.11%"><center>ลบ</center></th>
		         								           </tr>
                           
                            <?php
                            
                                 $number_row = 1;
                               	    while($obj = mysql_fetch_assoc($res)){

                               	    	?>
                               	    	<tr>
		         						    <td><center><?=$number_row?></center></td>
		         						    
		         						    <td><center><?=$obj['name'] ?></center></td>
		         								 <td><center><?=$obj['description'] ?></center></td>
		         								 <td width="10%"><center><?=$obj['path_photo'] ?></center></td>
		         								 <td><center><?=$obj['number'] ?></center></td>
                             <td>
                                 <center>
                                         <?php
                                              $str = "SELECT * FROM equipment WHERE room_id = ".$obj['room_id'];
                                             //echo $str;
                                                $resamont = $crud->ElseCondition($str);
                                                $num_rows = mysql_num_rows($resamont);
                                                echo $num_rows;
                                         ?>
                                           
                                 </center>
                            </td>
                             <td align="center">
                          
                                     <a href="#" onclick="load_data_add('<?=$obj['room_id']?>')" data-toggle="modal" data-target=".bs-example-modal-table2" > 
                                         <button class="btn btn-success" >
                                           <span class="glyphicon glyphicon-plus" style="size: 15px;">
                                           </span> 
                                         </button>
                                    </a>
                             </td>
                             
		         								 <td><center>
				                                             
		         			    					    <a href="#" onclick="load_data_edit('<?=$obj['room_id']?>')" data-toggle="modal" data-target=".bs-example-modal-table" > 
		         			    					         <button class="btn btn-info" >
		         			    						         <span class="glyphicon glyphicon-edit" style="size: 15px;">
		         			    						         </span> 
		         			    					         </button>
		         			    					    </a>
		         			    			        </center>
		         							     </td>
		         								<td><center>
                                   <a href="manageroom/delete_room.php?id=<?=$obj['room_id']?>"
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
                                   echo '<button type="submit" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                                            <span class="glyphicon glyphicon-plus-sign" style="size: 15px;">
                                            </span> &nbsp; เพิ่ม
                                         </button>  ';
                               }else{
                                echo "<h3 class='text-center' style='color:red;'>ไม่พบข้อมูลห้องประชุม</h3>";
                                echo '<button type="submit" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                                            <span class="glyphicon glyphicon-plus-sign" style="size: 15px;">
                                            </span> &nbsp; เพิ่ม
                                         </button>  ';


                               }
		         	?>

		     </div>
 		</div>
 		     <!-- pop up-->
  			<div class="modal fade" id="myModal" role="dialog">
  			  <div class="modal-dialog">
    
      			<!-- Modal content-->
     			 <div class="modal-content">
      			  <div class="modal-header">
        			  <button type="button" class="close" data-dismiss="modal">&times;</button>
         			<h4 class="modal-title">เพิ่มข้อมูลห้องประชุม</h4>
        			</div>
        			<div class="modal-body">
        			   <form action="manageroom/add_room.php"  method="POST" class="form-grup"  enctype="multipart/form-data">
        			      <p>ชื่อห้องประชุม</p>
        			      <p><input type="text" name="namemeetingroom" class="form-control" required></p> 
        			      <p>รายละเอียด</p>
        			      <p><input type="text" name="descriptions" class="form-control" required></p> 
        			      <p>จำนวนคนสูงสุด</p>
        			      <p><input type="number" name="number_peple" min="1" max="999" maxlength="4" class="form-control" required></p> 
        			      <p>แทรกรูปภาพ</p>
        			      <p><input type="file" name="partpicture" /></p>
        			</div>
        			<div class="modal-footer">
         				 <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
         				 <input type="submit" name="submitAdd" class="btn btn-success" value="ตกลง">
        			</div>
        			</form>
      				</div>
      
    			</div>
  				</div>
  				<!--out pop up-->	
      <!--edit room-->    
  		<div class="modal fade bs-example-modal-table" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h3 class="modal-title">แก้ไขข้อมูลห้อง</h3>
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
    <!--out edit room-->
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
        <script type="text/javascript" src="js/jconfirmaction.jquery.js"></script>
       <!--link rel="stylesheet" href="../css/jquery.datetimepicker.css"-->
       <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
       
		<script type="text/javascript">
     $(document).ready(function() {
        $('.ask-custom').jConfirmAction({question : "คูณต้องการลบข้อมูลหรือไม่", yesAnswer : "ใช่", cancelAnswer : "ยกเลิก"});
      });

		     function load_data_edit(idInput){
		     	var sdata = {
		     		id:idInput
		     	}
		     	$('#divDataview1').load('manageroom/edit_room.php',sdata);
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