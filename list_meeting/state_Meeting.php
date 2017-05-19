
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<?php
include '../connect/class_crud.php';
$crud = new CRUD();
if (isset($_REQUEST['id'])) {
    $id = intval($_REQUEST['id']);
    
    $strid = "SELECT * FROM meeting WHERE meeting_id =" . $id . ";";
    $res = $crud->ElseCondition($strid);
    if (mysql_num_rows($res)) {
        while ($obj = mysql_fetch_assoc($res)) {
            $strUser = "SELECT * FROM users WHERE user_id =" . $obj['user_id'] . " ;";
            $res2 = $crud->ElseCondition($strUser);
            $obj2 = mysql_fetch_assoc($res2);
            ?>
       <form action="list_meeting/update_state.php" method="POST" >
            <table >
                
                <tr>
                    <td><p><label>ชื่อผู้จอง</label></p>
                        <p><input type="text" value="<?= $obj2['name'] ?>" class="form-control" disabled></p>
                    </td>
                    <td width="20%"></td>
                    <td><p><label>หัวข้อการประชุม</label></p>
                        
                        <p>
                            <input type="text"  value="<?=$obj['title']?>" class="form-control" disabled></p>         
                    </td>
                   
                </tr>
                
                <tr>
                    <td><p><label>เบอร์โทร</label></p>
                        <p><input type="text" value="<?= $obj['description'] ?>" class="form-control" disabled></p>
                    </td>
                    <td width="20%"></td>
                     <td><p><label>สถานะ</label></p>
                        <input type="hidden" name="idmeeting" value="<?=$id?>">
                        <p>
                            <input type="checkbox" name="state" value="1" checked data-toggle="toggle" data-on="อนุมัติ" data-off="ไม่อนุมัติ" data-onstyle="info" >
                       </p>         
                    </td>
                </tr>
            </table>
           <br><input type="submit" class="btn btn-success btn-lg" value="ตกลง">
       </form>
            <?php
        }
    }
} else {
    header("location:../admin.php");
}
?>

