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

                <?php
                include './connect/class_crud.php';
                include 'daymoth_thai.php';
                $crud = new CRUD();
                $strCheckUserid = "SELECT * FROM users WHERE username='" . $_SESSION['userid'] . "' ";
                // echo $strCheckUserid;
                $resID = $crud->ElseCondition($strCheckUserid);
                $userObj = mysql_fetch_assoc($resID);
                $user = $userObj['user_id'];

                $strQuery = "SELECT * FROM meeting  WHERE state= 0 ORDER BY date_time_end DESC";
                //echo $strQuery;
                $res = $crud->ElseCondition($strQuery);
                if (mysql_num_rows($res) > 0) {
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
                        <th><center>จัดการสถานะ</center></th>

                        </tr>
                        <?php
                        $rowCount = 1;
                        while ($obj = mysql_fetch_assoc($res)) {
                            $strQuery2 = "SELECT * FROM room WHERE room_id = " . $obj['room_id'] . "";

                            $res2 = mysql_query($strQuery2);
                            $room_name = mysql_fetch_assoc($res2);
                            $strQuery3 = "SELECT * FROM users WHERE user_id = " . $obj['user_id'] . "";
                            $res3 = mysql_query($strQuery3);
                            $userObjs = mysql_fetch_assoc($res3);
                            ?>
                            <tr>
                                <td>
                            <center><?= $rowCount ?></center>
                            </td>
                            <td>
                            <center><?= $userObjs['username'] ?></center>
                            </td>
                            <td>
                            <center><?= $obj['title'] ?></center>
                            </td>
                            <td>
                            <center><?= $obj['description'] ?></center>
                            </td>
                            <td>
                            <center><?php echo DateThai($obj['date_time_start']); ?></center>
                            </td>
                            <td>
                            <center><?php echo DateThai($obj['date_time_end']); ?></center>
                            </td>
                            <td>
                            <center><?php echo $room_name['name']; ?></center>
                            </td>
                            <td>
                            <center><?php if ($obj['state'] == 0) {
                              echo "ยังไม่ได้อนุมัติ";
                                 } else {
                                   echo "อนุมัติ";
                                 } ?>
                            </center>
                            </td>
                            <td><center>
                                <a href="#" onclick="load_data('<?= $obj['meeting_id'] ?>')" data-toggle="modal" data-target=".bs-example-modal-table" > 
                                    <button class="btn btn-warning" >
                                        <span class="glyphicon glyphicon-edit" style="size: 15px;">
                                        </span> 
                                    </button>
                                </a>
                            </center>
                            </td>
                            
                            </tr>

                            <?php
                            $rowCount++;
                        }
                        echo "</table>";
                    } else {
                        echo "<h4 style='color:red' class='text-center'> ไม่มีข้อมูล </h4>";
                    }
                    ?>
                      
            </div>



        </div>
        

        <!--start edit data-->
        <div class="modal fade bs-example-modal-table" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h3 class="modal-title">แก้ไขสถานะการจอง</h3>
                             
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body no-padding">
                            <br>
                            <center>
                            <div class="table-responsive" style="  height:250px; ">
                                <div id="divDataview">
                                </div>
                            </div>
                            </center>
                        </div>
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
            function load_data(idInput) {
                var sdata = {
                    id: idInput
                }
                $('#divDataview').load('list_meeting/state_Meeting.php', sdata);
            }

        </script>

    </body>
</html>