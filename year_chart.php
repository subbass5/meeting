<?php  session_start();  
       error_reporting(E_ALL ^ E_DEPRECATED);
       include_once 'connect/class_crud.php';
      // $crud = new CRUD();
?>
<!DOCTYPE html>
<html lang="en">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
     <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

  </head>
  <body>
 <?php
if (isset($_POST['submit'])) {   
    $date = $_POST['fromYear']; 
    $date_Y = $date-543;
   

?>
    <form id="form1" name="form1" method="post" action="" >
<div class="row"  >
    <div class="col-xs-1"></div>
    <div class="col-xs-5" align="center" >
   <h4> สถิติการใช้ห้องประชุมประจำปี พ.ศ </h4>
    </div>
    <div class="col-xs-2">
       <select name="fromYear" class="form-control"  >
 <?php   
 $starting_year  =$date_Y+533;
 $ending_year = $date_Y+553;
 $current_year = $date_Y+543;
 for($starting_year; $starting_year <= $ending_year; $starting_year++) {
     echo '<option value="'.$starting_year.'"';
     if( $starting_year ==  $current_year ) {
            echo ' selected="selected"';
     }
     echo ' >'.$starting_year.'</option>';
 }     ?>          

 </select>

    </div>
<div class="col-xs-2"  >
   <button name="submit" type="submit" class="btn btn-danger " id="btnAdd"  > 
        <span  class="glyphicon glyphicon-search" aria-hidden="true">  ค้นหา </span> 
            </button>
    </div>

  </div>
  </form>     
  
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
         
         <?php
          $crud = new CRUD();
           $date = date("Y");
           $result=mysql_query("SELECT meeting.room_id,room.name,count(*) as number FROM meeting,room WHERE meeting.room_id =room.room_id AND
           meeting.state = 1 AND meeting.date_time_start like '%$date_Y%'  GROUP BY meeting.room_id");

                $num =mysql_num_rows($result);
            if ($num==0) {
 ?>         
        [' Task', 'Hours per Day'],
     
          ['ไม่มีข้อมูล',    1]
         
<?php }else{ 
    echo "[' ชื่ห้อง', 'จำนวน'],";
           while($row = mysql_fetch_array($result)) {  
               echo "['".$row["name"]."', ".$row["number"]."],";  
           
               }  
            } ?>  
                  
        ]);

        var options = {
//pieStartAngle: 100,
 // legend: 'none',
        pieSliceText: 'label',
     //   pieSliceTextStyle: {
      //  fontSize: 20, // 12, 18 whatever you want (don't specify px)
       // bold: true,    // true or false
       
        
       
   // }, 
          title: 'สถิติการใช้ห้องประชุมประจำปี พ.ศ ' + <?php echo  $date_Y+543; ?>,
        titleTextStyle: {
        fontSize: 20, // 12, 18 whatever you want (don't specify px)
        bold: true,    // true or false
       
        legend:'left'
       
    } 
    

        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  
        chart.draw(data, options);
      }

    </script>

    </style>

    <div id="piechart" style="width: 100%; height: 600px; border: 1  "></div> 

<?php 
    
}else{

?>
<form id="form1" name="form1" method="post" action="" >
<div class="row"  >
    <div class="col-xs-1"></div>
    <div class="col-xs-5" align="center" >
   <h4> สถิติการใช้ห้องประชุมประจำปี พ.ศ </h4>
    </div>
    <div class="col-xs-2">
       <select name="fromYear" class="form-control"  >
 <?php   
 $starting_year  =date('Y', strtotime('-10 year'))+543;
 $ending_year = date('Y', strtotime('+10 year'))+542;
 $current_year = date('Y')+543;
 for($starting_year; $starting_year <= $ending_year; $starting_year++) {
     echo '<option value="'.$starting_year.'"';
     if( $starting_year ==  $current_year ) {
            echo ' selected="selected"';
     }
     echo ' >'.$starting_year.'</option>';
 }     ?>          

 </select>

    </div>
<div class="col-xs-2"  >
   <button name="submit" type="submit" class="btn btn-danger " id="btnAdd"  > 
        <span  class="glyphicon glyphicon-search" aria-hidden="true">  ค้นหา </span> 
            </button>
    </div>

  </div>
  </form>     
  
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          [' ชื่ห้อง', 'จำนวน'],
         <?php
          $crud = new CRUD();
           $date = date("Y");
           $result=mysql_query("SELECT meeting.room_id,room.name,count(*) as number FROM meeting,room WHERE meeting.room_id =room.room_id AND
           meeting.state = 1 AND meeting.date_time_start like '%$date%' GROUP BY meeting.room_id");
           while($row = mysql_fetch_array($result)) {  
               echo "['".$row["name"]."', ".$row["number"]."],";  
           
               }  
             ?>  
                  
        ]);

        var options = {
            animation: {
                duration: 1500,
                startup: true
            },
          pieSliceText: 'label',
          title: 'สถิติการใช้ห้องประชุมประจำปี พ.ศ ' + <?php echo  $date+543; ?>,
        titleTextStyle: {
        fontSize: 20, // 12, 18 whatever you want (don't specify px)
        bold: true,    // true or false
 // true of false
     legend:'left'
    } 
        };
 function getRandomColor() {
        var letters = '0123456789ABCDEF'.split('');
        var color = '#';
        for (var i = 0; i < 6; i++ ) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }    
    
    options.series={};
    for(var i = 0;i < data.getNumberOfRows();i++){
        options.series[i]={color:getRandomColor()}
    }
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }

    </script>

    </style>
    



    <div id="piechart" style="width: 100%; height: 600px; border: 1  "></div> 

<?php   }  ?>
  </body>
</html>