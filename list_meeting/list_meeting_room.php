<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title></title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    
	</head>
	<body>
	 <div class="container" style="width: 100%;">
		   
		     <div class="tabale_data">

	     <?php   include './connect/class_crud.php';
               include 'daymoth_thai.php';  
	               $crud = new CRUD();
                 $strCheckUserid = "SELECT * FROM users WHERE username='".$_SESSION['userid']."' ";
                // echo $strCheckUserid;
                 $resID = $crud->ElseCondition($strCheckUserid);
                 $userObj = mysql_fetch_assoc($resID);
                 $user = $userObj['user_id'];

                 $strQuery = "SELECT * FROM meeting ORDER BY date_time_end DESC";
                 //echo $strQuery;
                 $res = $crud->ElseCondition($strQuery);
                    if(mysql_num_rows($res) > 0)
                    {
              	     ?>
              	     <table class="table">
		         	   <tr class="success">
		         		<th><center>ลำดับ</center></th>
		         		<th><center>ชื่อผู้จอง</center></th>
		         		<th><center>หัวข้อ</center></th>
		         		<th><center>คำอธิบาย</center></th>
		         		<th><center>เวลาเริ่มต้น</center></th>
		         		<th><center>เวลาสิ้นสุด</center></th>
		         		<th><center>ชื่อห้อง</center></th>
		         		<th><center>สถานะ</center></th>
		         		<th><center>แก้ไข</center></th>
		         		<th><center>ลบ</center></th>
		         	  </tr>
              	   <?php
              	   $rowCount = 1;
              	      while($obj = mysql_fetch_assoc($res))
              	       {
              	       	 $strQuery2 = "SELECT * FROM room WHERE room_id = ".$obj['room_id']."";

                          $res2 = mysql_query($strQuery2);
                          $room_name = mysql_fetch_assoc($res2);
                          $strQuery3 = "SELECT * FROM users WHERE user_id = ".$obj['user_id']."";
                          $res3 = mysql_query($strQuery3);
                          $userObjs = mysql_fetch_assoc($res3);
                         
              	    	?>
                          <tr>
		         			             <td>
                                    <center><?=$rowCount?></center>
                               </td>
		         			             <td>
                                     <center><?=$userObjs['username']?></center>
                              </td>
		         			             <td>
                                    <center><?=$obj['title']?></center>
                              </td>
		         			             <td>
                                    <center><?=$obj['description']?></center>
                              </td>
		         			             <td>
                                    <center><?php echo  DateThai($obj['date_time_start']);?></center>
                              </td>
		         			             <td>
                                     <center><?php echo  DateThai($obj['date_time_end']);?></center>
                              </td>
                               <td>
                                     <center><?php echo $room_name['name'];?></center>
                              </td>
		           			           <td>
                                     <center><?php if($obj['state']==0){echo "ยังไม่ได้อนุมัติ";}else{ echo "อนุมัติ";} ?></center>
                              </td>
		         			            <td><center>
		         			                     <a href="#" onclick="load_data('<?=$obj['meeting_id']?>')" data-toggle="modal" data-target=".bs-example-modal-table" > 
		         			    		                <button class="btn btn-info" >
		         			    				              <span class="glyphicon glyphicon-edit" style="size: 15px;">
		         			    				             </span> 
		         			    			              </button>
		         			    		              </a>
		         			                </center>
		         			            </td>
		         			           <td><center>

                                   <a href="list_meeting/delete_list.php?idlist=<?=$obj['meeting_id']?>"
                                  class="ask-custom">
                                  <button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" style="size: 15px;"></span> </button>
                                   </form>
                                  
                                   </a>

		         			                
                                </center>
		         			</td>
		         	      </tr>

              	    	<?php
              	    	$rowCount++;
              	       }
              	       echo "</table>";
                    }else{
                    	echo "<h4 style='color:red' class='text-center'> ไม่มีข้อมูล </h4>";
                    }
	           ?>
		         			     <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#myModal">
		         			        <span class="glyphicon glyphicon-plus-sign" style="size: 15px;">
		         			        </span> &nbsp; เพิ่ม
		         			     </button>    
		     </div>


		
 		</div>
 		     <!-- pop up-->
  			<div class="modal fade" id="myModal" role="dialog">
  			  <div class="modal-dialog">
    
      			<!-- Modal content-->
     			 <div class="modal-content">
      			  <div class="modal-header">
        			  <button type="button" class="close" data-dismiss="modal">&times;</button>
         			<h4 class="modal-title">เพิ่มข้อมูลการจอง</h4>
        			</div>
        			<div class="modal-body">
        			   <form action="list_meeting/add_list.php" method="POST" class="form-grup">
        			      <p>หัวข้อการประชุม</p>
        			      <p><input type="text" name="title" class="form-control" required></p> 
        			      <p>รายละเอียด</p>
        			      <p><input type="text" name="description" class="form-control" required></p> 
        			      <p>เวลาเริ่มต้น</p>
        			      <p><input type="datetime" name="datetime_strart" id="testdate5" class="form-control" required></p> 
        			      <p>เวลาเริ่มสิ้นสุด</p>
        			      <p><input type="datetime" name="datetime_end"  id="testdate6" class="form-control" required/></p> 
        			       <p>ชื่อห้อง</p>
        			       <p><select name="roomid" class="form-control">
        			          <?php  
        			          		$strQuery4 = "SELECT * FROM room";
                                    $res4 = $crud->elseCondition($strQuery4);
                                    if(mysql_num_rows($res4)>0)
                                      {
                                       while ($room = mysql_fetch_assoc($res4)) 
                                             {
        			                         ?>
        			       	   
        			       	                <option value="<?=$room['room_id']?>">
        			       	                     <?=$room['name']?>
        			       	                </option>
        			       	                
                                             <?php   
                                              }
                                       } 

                               ?>
        			           </select>
        			       </p> 
        			      
        			      <p><input type="hidden" name="userid" class="form-control" value="<?=$user?>"></p> 

        			</div>
        			<div class="modal-footer">
         				 <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
         				 <input type="submit" name="submit" class="btn btn-success" value="ตกลง">
        			</div>
        			</form>
      				</div>
      
    			</div>
  				</div>
  				<!--out pop up-->

  				<!--start edit data-->
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
                        <div class="table-responsive" style="  height:450px; ">
                            <div id="divDataview">
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
    <!--out edit data-->
    <!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
 		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>  
        <script src="js/jquery.datetimepicker.full.js"></script>
        <script type="text/javascript" src="js/dtpk.js"></script>
        <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="js/jconfirmaction.jquery.js"></script>
       <!--link rel="stylesheet" href="../css/jquery.datetimepicker.css"-->
       <script type="text/javascript">
      
      $(document).ready(function() {
        $('.ask-custom').jConfirmAction({question : "คูณต้องการลบข้อมูลหรือไม่", yesAnswer : "ใช่", cancelAnswer : "ยกเลิก"});
      });
      
    </script>
        <script type="text/javascript">
         function load_data(idInput){
		     	var sdata = {
		     		id:idInput
		     	}
		     	$('#divDataview').load('list_meeting/edit_list.php',sdata);
		     }
        	
        </script>
  
	</body>
</html>