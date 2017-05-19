<?php
session_start();
if (!$_SESSION['userid'] == "admin") {
    header('location:../logout.php');
}

$chk = @$_GET['state'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>admin</title>
        <!-- Bootstrap CSS -->

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="css/jquery.datetimepicker.css">
        <link rel="stylesheet" href="css/scroll.css">
        <link rel="stylesheet" href="css/deleteConfirm.css">


    </head>
    <body style="background-color: #eeeeee; ">
        <?php
        if ($chk == 1) {
            ?>

            <script>

                alert("myModal11");
                toastr
                toastr.info('Are you the 6 fingered man?')
            </script>
    <?php
}
?>

        <div class="container">
            <table style="background-color: #EEEEEE;">
                <tr>
                    <td>
                        <img src="img/header.png" style="width: 100%; height: 300px;">
                    </td>
                </tr>
                <tr VALIGN="TOP">
                    <td><center>
                    <table style="width: 100%;">
                        <tr VALIGN="TOP">
                            <td width="200">
                                <!--menu ต่างๆ-->
                                <br>
                                <h4>
                                    <span class="glyphicon glyphicon-bishop"></span>
                                    &nbsp;&nbsp;ผู้ดูแลระบบ
                                </h4><br>
                                <table  width="200">
                                    <tr>

                                        <!--menu 1-->
                                        <td>
                                            <table class="table">
                                                <tr class="info" VALIGN=TOP>
                                                    <th>เมนูหลัก</th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="?Page=manageMeeting" style="color: #666666;">อนุมัติการจอง
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="?Page=listMeetingroom" style="color: #666666;">รายการประชุมทั้งหมด
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="?Page=manageMeetingroom" style="color: #666666;">จัดการห้องประชุม
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="?Page=manageEquipment" style="color: #666666;">จัดการอุปกรณ์ห้องประชุม
                                                        </a>
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td>
                                                        <a href="?Page=manageUser" style="color: #666666;">จัดการบัญชีผู้ใช้

                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="?Page=manageNews" style="color: #666666;">จัดการข่าวประชาสัมพันธ์
                                                        </a>
                                                    </td>
                                                </tr>

                                            </table>	
                                            <br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <!--menu logout-->
                                        <td>
                                    <center>
                                        <a href="logout.php">
                                            <button type="button" class="btn btn-danger">
                                                <span class="glyphicon glyphicon-log-out">
                                                </span>
                                                &nbsp;Logout
                                            </button>
                                        </a>
                                    </center><br>
                                    </td>
                                    </tr>
                                </table>
                            </td>
                            <td >
                                <!--content show -->
                                <div class="demo">
                                    <div class="scroll">
                                        <?php
                                        $file = @$_GET['Page'];
                                        if ($file == '' || $file == 'manageMeeting') {
                                            echo "<h2 class='text-center'> รายการประชุม</h2><br>";
                                            include 'list_meeting/manageMeeting.php';
                                            ?>
                                            <script>
                                                $(document).ready(function () {

                                                    var response = ''
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "view_state.php",
                                                        async: false,
                                                        success: function (Text)
                                                        {
                                                            if (Text == 0) {
                                                                toastr.success("ไม่มีการรออนุมัติ", {timeOut: 500})
                                                            } else {
                                                                toastr.warning("มีการจองที่รออนุมัติ อยู่ " + Text + "  รายการ", {timeOut: 2000})
                                                            }

                                                        }
                                                    });

                                                });
                                            </script>

                                              <?php
                                                }else if($file == 'listMeetingroom'){
                                                    echo "<h2 class='text-center'> รายการประชุม</h2><br>";
                                                    include 'list_meeting/list_meeting_room.php';
                                                } else if ($file == 'manageMeetingroom') {
                                                    echo "<h2 class='text-center'> ข้อมูลห้องประชุม</h2><br>";
                                                    include 'manageroom/manage_meeting_room.php';
                                                } else if ($file == 'manageUser') {
                                                    echo "<h2 class='text-center'> ข้อมูลผู้ใช้งาน</h2><br>";
                                                    include 'manage_user/manage_user.php';
                                                } else if ($file == 'manageNews') {
                                                    echo "<h2 class='text-center'> ข้อมูลข่าวสาร</h2><br>";
                                                    include 'manage_news/manage_news.php';
                                                } else if ($file == 'manageEquipment') {

                                                    echo "<h2 class='text-center'> จัดการอุปกรณ์</h2><br>";
                                                    include 'manage_equipment/show_equipment.php';
                                                }
                                                ?>
                                        <br>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </center>
                </td>
                </tr>
            </table>

        </div>
<?php include 'footer.php'; ?>
        <!-- Modal -->
        <div class="modal fade" id="myModal11" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modal Header</h4>
                    </div>
                    <div class="modal-body">
                        <p>Some text in the modal.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- jQuery -->
        <script src="//code.jquery.com/jquery.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" type="text/javascript"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>  
        <script src="js/jquery.datetimepicker.full.js"></script>
        <script type="text/javascript" src="js/dtpk.js"></script>

        <script type="text/javascript" src="js/jconfirmaction.jquery.js"></script>
        <!--link rel="stylesheet" href="../css/jquery.datetimepicker.css"-->


    </body>
</html>