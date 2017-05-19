<?php
    header('Content-Type: text/html; charset=utf-8');
    include 'data_month.php';
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbName = "meeting";
     $conn = mysql_connect($host,$user,$pass) or die('error connecting to server'.mysql_error());
      mysql_select_db($dbName, $conn) or die('error connecting to database->'.mysql_error());
      mysql_query("SET NAMES UTF8");
    
    date_default_timezone_set("Asia/Bangkok");
    
     //Sun - Sat
      $month = isset($_GET['month']) ? $_GET['month'] : date('m'); //ถ้าส่งค่าเดือนมาใช้ค่าที่ส่งมา ถ้าไม่ส่งมาด้วย ใช้เดือนปัจจุบัน
      $year = isset($_GET['year']) ? $_GET['year'] : date('Y'); //ถ้าส่งค่าปีมาใช้ค่าที่ส่งมา ถ้าไม่ส่งมาด้วย ใช้ปีปัจจุบัน
    //วันที่
      $Year_Month =  $year."-".$month."-";
      //echo $Year_Month;
      $startDay = $year.'-'.$month."-01";   //วันที่เริ่มต้นของเดือน
      $timeDate = strtotime($startDay);   //เปลี่ยนวันที่เป็น timestamp
      $lastDay = date("t", $timeDate);   //จำนวนวันของเดือน
      $endDay = $year.'-'.$month."-". $lastDay;  //วันที่สุดท้ายของเดือน
      $startPoint = date('w', $timeDate);   //จุดเริ่มต้น วันในสัปดาห์
      $yearThai = $year+ 543 ;

?>
<html>
 <head>
     <meta charset="utf-8">
     <title></title>
     
       <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
 </head>
 <body>

   <br><br/>
<?php


      $title = "       เดือน $thaiMon[$month] พ.ศ. ".$yearThai."          ";
      //ลดเวลาลง 1 เดือน
      $prevMonTime = strtotime ( '-1 month' , $timeDate  );
      $prevMon = date('m', $prevMonTime);
      $prevYear = date('Y', $prevMonTime);
        //เพิ่มเวลาขึ้น 1 เดือน
      $nextMonTime = strtotime ( '+1 month' , $timeDate  );
      $nextMon = date('m', $nextMonTime);
      $nextYear = date('Y', $nextMonTime);
          echo '<div id="main">';
          echo '<div id="nav">
                 <center>
                 <a href="index.php?year='.$prevYear."&month=".$prevMon.'">
                    <button class="btn btn-success" >
                          <span class="glyphicon glyphicon-menu-left"></span>
                    </button>
                 </a>
                 <font-size>   &nbsp;'.$title.'&nbsp;&nbsp; </font-size>
                    <a href="index.php?year='.$nextYear."&month=".$nextMon.'">
                    <button class="btn btn-success"> 
                           <span class="glyphicon glyphicon-menu-right">
                           </span>
                    </button>
                    </a>
                 </center>
                 <br>
                     </div>
                    <div style="clear:both"></div>';
           echo "<table id='tb_calendar' class='table table-bordered' width='100%'>"; //เปิดตาราง
           echo "<tr>
                <th bgcolor='#ff8566' width='14.29%'>อาทิตย์</th>
                <th bgcolor='#ffff80' width='14.29%'>จันทร์</th>
                <th bgcolor='#ffccff' width='14.29%' >อังคาร</th>
                <th bgcolor='#b3ff66' width='14.29%'>พุธ</th>
                <th bgcolor='#ffc266' width='14.29%'>พฤหัสบดี</th>
                <th bgcolor='#99ccff' width='14.29%'>ศุกร์</th>
                <th bgcolor='#cc80ff' width='14.29%'>เสาร์</th>
                </tr>";
           echo "<tr>";    //เปิดแถวใหม่
      $col = $startPoint;          //ให้นับลำดับคอลัมน์จาก ตำแหน่งของ วันในสับดาห์ 
              if($startPoint < 7)
                 {         //ถ้าวันอาทิตย์จะเป็น 7
                echo str_repeat("<td> </td>", $startPoint); //สร้างคอลัมน์เปล่า กรณี วันแรกของเดือนไม่ใช่วันอาทิตย์
                 }
                  for($i=1; $i <= $lastDay; $i++)
                  { //วนลูป ตั้งแต่วันที่ 1 ถึงวันสุดท้ายของเดือน
                              $col++;       //นับจำนวนคอลัมน์ เพื่อนำไปเช็กว่าครบ 7 คอลัมน์รึยัง
                               
                               if($i<10){
                                $date = "0".$i;
                              }else{
                                $date = $i;
                              
                              }
                                $datenow = $Year_Month;
                                $datenow .= $date." 00:00:00";
                               // echo $datenow;
                                $dateAfter = $Year_Month;
                                $dateAfter .= $date." 23:59:59";
                                $haveData = false;

                                  
                                $strQuery = "SELECT * FROM meeting WHERE date_time_start BETWEEN '".$datenow."' AND '".$dateAfter."'  ";  
                                $res = mysql_query($strQuery);                         
                                $row = mysql_num_rows($res);                                       


                               $strQuery1 = "SELECT * FROM meeting WHERE date_time_start BETWEEN '".$datenow."' AND '".$dateAfter."' AND state = 1 ";  
                                $res1 = mysql_query($strQuery1);                         
                                $row1=mysql_num_rows($res1);

                              $strQuery2 = "SELECT * FROM meeting WHERE date_time_start BETWEEN '".$datenow."' AND '".$dateAfter."' AND state = 0 ";  
                                $res2 = mysql_query($strQuery2);                         
                                $row2=mysql_num_rows($res2);



                                if(mysql_num_rows($res)){
                                    $obj_list = mysql_fetch_assoc($res);
                                    $haveData = True;
                                    $state = 1;
                                }
                            

                              if($i<10){
                                $strDaytmp = "0".$i;
                              }else{
                                  $strDaytmp = $i;
                                //แสดงวันที่ 
                              }
                               $dm = $i."-".$month;
                                  // echo $dm;
                                 $dm_c  = date("d-m");
                                // echo $dm_c;
                              if($i==date("d")){?>

                                   <?php    

                                   if( $dm==date("d-m") ){
                                    ?><td height='100' width='100' bgcolor="pink" ><?php echo $i;?>
                                    <br>   
                                     <?php if($row==$row1 and $row!=0 ) {  ?>
                                        <center>
                                               <button type="button" class='btn btn-warning'
                                               data-toggle='modal' data-target='#formshow'
                                               onclick='load_data("<?=$datenow;?>")' >มีรายการจอง</button>
                                        </center>
                                       
                                      <?php  }else  if($row==$row2 and $row!=0  ) { ?> 
                                        <center>
                                               <button type="button" class='btn btn-info'
                                               data-toggle='modal' data-target='#formshow'
                                               onclick='load_data1("<?=$datenow;?>")' >รออนุมัติ</button>
                                        </center>
                                        <?php  }else if($row!=0 ) {?> 
                                         <center>
                                               <button type="button" class='btn btn-warning'
                                               data-toggle='modal' data-target='#formshow'
                                               onclick='load_data("<?=$datenow;?>")' >มีรายการจอง</button>
                                        </center>
                                        <br>
                                        <center>
                                               <button type="button" class='btn btn-info'
                                               data-toggle='modal' data-target='#formshow'
                                               onclick='load_data1("<?=$datenow;?>")' >รออนุมัติ</button>
                                        </center>
                                          <?php  }?> 
                                  
                                     
                                        </td> 

                               <?php    }else{ 
                                    echo "<td height='100' width='100'   >",
                                              "",$i , "
                                        </td>";  //สร้างคอลัมน์ 
                                   }
              
                                  
                              }else{
                        
                                  if($haveData==True){
                                    ?>
                                    <td height='100' width='100'><?=$i?>
                                    <br>
                                     
                                      <?php if ($state==1) {   ?>
                                      <?php if($row==$row1) {  ?>
                                        <center>
                                               <button type="button" class='btn btn-warning'
                                               data-toggle='modal' data-target='#formshow'
                                               onclick='load_data("<?=$datenow;?>")' >มีรายการจอง</button>
                                        </center>
                                       
                                      <?php  }else  if($row==$row2) { ?> 
                                        <center>
                                               <button type="button" class='btn btn-info'
                                               data-toggle='modal' data-target='#formshow'
                                               onclick='load_data1("<?=$datenow;?>")' >รออนุมัติ</button>
                                        </center>
                                        <?php  }else {?> 
                                         <center>
                                               <button type="button" class='btn btn-warning'
                                               data-toggle='modal' data-target='#formshow'
                                               onclick='load_data("<?=$datenow;?>")' >มีรายการจอง</button>
                                        </center>
                                        <br>
                                        <center>
                                               <button type="button" class='btn btn-info'
                                               data-toggle='modal' data-target='#formshow'
                                               onclick='load_data1("<?=$datenow;?>")' >รออนุมัติ</button>
                                        </center>
                                          <?php  }?> 
                                     <?php  }?> 
                                     
                                        </td> 
                                     
                                         <!-- //สร้างคอลัมน์  -->
                                        <?php

                                   }else{ 
                                    echo "<td height='100' width='100' >",
                                              "",$i , "
                                        </td>";  //สร้างคอลัมน์ 
                                   }
                        
                              }

                        if($col % 7 == false)
                          {   //ถ้าครบ 7 คอลัมน์ให้ขึ้นบรรทัดใหม่
                              echo "</tr><tr>";   //ปิดแถวเดิม และขึ้นแถวใหม่
                              $col = 0;     //เริ่มตัวนับคอลัมน์ใหม่
                          }
                  }
                        if($col < 7)
                        {         // ถ้ายังไม่ครบ7 วัน
                            echo str_repeat("<td> </td>", 7-$col); //สร้างคอลัมน์ให้ครบตามจำนวนที่ขาด
                        }
                        echo '</tr>';  //ปิดแถวสุดท้าย
                        echo '</table>'; //ปิดตาราง
                        echo '</main>';
            ?>

</div>
<br>

<h4><b>หมายเหตุ</b></h4><br />
- สัญลักษณ์    <span type="text" class='btn btn-warning'>มีรายการจอง</span> หมายถึง ในวันนั้นมีรายการจองห้องประชุม<br /></br>
- สัญลักษณ์    <span type="text" class='btn btn-info'>รออนุมัติ</span>  หมายถึง มีรายการจองแล้วในวันนั้น แต่อยู่ระหว่างการดำเนินการส่งเอกสาร และการยืนยันจากหน่วยงานที่ดูแลห้องประชุม</div>
<div style="clear:both;"></div>
</div>
<p>&nbsp;</p>

<!-- ///////////////  form show ////////////////////// -->

<div id="formshow" class="modal fade" class="modal-dialog modal-lg  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ng-controller="TodoController" > 
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style=" padding: 10px"  >
      <div class="modal-header1" align="center" modal-header >
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"> X</span></button>
          <span aria-hidden="true">  <br> </span>
      </div>

     
      <div class="modal-body">
    
               <div id="divDataview">
      </div>

 
    </div>
  </div>
</div>
<script type="text/javascript">

         function load_data(idInput){
            var sdata = {

            sdata:idInput
          }
          $('#divDataview').load('popup.php',sdata);  
         }
      
          function load_data1(idInput){
            var sdata = {

            sdata:idInput
          }
          $('#divDataview').load('popupApp.php',sdata);  
         }
      
      

    </script>
</body>
</html>