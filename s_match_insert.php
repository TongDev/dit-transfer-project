<?php
    include_once('functions.php');
    if(empty($_GET['sb_match'])){
        echo "<script>alert('โปลดเลือก รายวิชาที่ต้องการเพิ่มการก่อน !');</script>";
        echo "<script>window.location.href='s_match_detail.php'</script>";
    }else{
    $sjbID = $_GET['sb_match'];
    $r1 = $_GET['sb_match'];
    $cbID = $_GET['courseB_ID'];
    $caID = $_GET['courseA_ID'];
    //fetch วิชา ป.ตรี ที่เลือก
    $fetch_select_sjbID = new DB_con();
    $sql_sjbID = $fetch_select_sjbID->fetchonerecord_selected_sb($sjbID);//
    //fetch วิชา ปวส. ที่เลือกตามหลักสูตร ทั้งหมด
    $fetch_select_sjaID = new DB_con();
    $sql_sjaID = $fetch_select_sjaID->fetch_selected_sa($caID);//

    if (isset($_POST['insert'])) {
        if(empty($_POST['check_saID'])){
            echo "<script>alert('โปลดเลือกวิชาที่ต้องการจับคู่ !');</script>";
            echo "<script>window.location.href='#'</script>";
        } else {
            for($i=0;$i<count($_POST['check_saID']);$i++){
                $sjaID = $_POST['check_saID'][$i];
                $insert_sj_match = new DB_con();
                $sql_insert = $insert_sj_match->insert_sj_match($sjbID,$sjaID);
            }
            echo "<script>alert('จับคู่เสร็จสิ้น !');</script>";
            echo "<script>window.location.href='s_match_detail.php'</script>";
        }

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จับคู่รายวิชา</title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
</head>
<body>

    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="navbar-brand" href="index.php">Digital Technology</a>
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a class="btn btn-success" aria-current="page" href="teacher_menu.php">เมนู</a>
                    </li>
                    <li>
                        <div class="dropdown ml-2">
                            <button class="btn btn-info dropdown-toggle" type="button" id="dropdown-menu" data-toggle="dropdown" aria-expanded="false">จัดการข้อมูล</button>
                                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton">
                                    <li><h6 class="dropdown-header">หลักสูตร</h6></li>
                                    <li><a class="dropdown-item" href="course_b.php">หลักสูตรปริญญาตรี</a></li>
                                    <li><a class="dropdown-item" href="course_a.php">หลักสูตร ปวส.</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><h6 class="dropdown-header">รายวิชา</h6></li>
                                    <li><a class="dropdown-item" href="subject_b.php">รายวิชารปริญญาตรี</a></li>
                                    <li><a class="dropdown-item" href="subject_a.php">รายวิชา ปวส.</a></li>
                                    <li><a class="dropdown-item" href="s_match_show.php">วิชาที่จับคู่</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="school.php">สถาบัน</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="course_teacher.php">อาจารย์ประจำหลักสูตร</a></li>
                                    <li><a class="dropdown-item" href="student_show.php">ข้อมูลนักศึกษา</a></li>
                                </ul>
                        </div>
                    </li>
                    <li><a class="btn btn-danger ml-2" aria-current="page" href="logout.php">ออกจากระบบ</a></li>
                </ul>
        </div>
    </nav>
    <!--End Navbar-->

    <!-- HEADER -->
        <div class="container">
        <h1 class = "mt-3">จับคู่วิชา</h1>
        <hr>
    <!-- End HEADER -->

    <!-- btn Back -->
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-6">
                <a href="s_match_detail.php" class="btn btn-danger mb-3">Back</a> 
            </div>
        </div>
    </div>
    <!-- End btn Back -->

    <!-- แบ่งครึ่งจอ -->
    <div class="row justify-content-center">
        <!-- ครึ่งจอแรก -->
        <div class="col-6">
            <h4 class="mb-3">รายวิชา ป.ตรี ที่เลือก</h4>
            <hr>

            <?php
                while ($row_sjb = mysqli_fetch_array($sql_sjbID)) {
            ?>

            <!-- ส่วนแสดงรายวิชา ป.ตรี ที่เลือก -->
            <form action="" method="post">
                <div class="mb-3">
                    <label for="subject_BCode" class="form-label">รหัสวิชา</label>
                    <input type="text" name="subject_BCode" class="form-control" value="<?php echo $row_sjb['subject_BCode']; ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="subject_BName" class="form-label">รหัสวิชา</label>
                    <input type="text" name="subject_BName" class="form-control" value="<?php echo $row_sjb['subject_BName']; ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="subject_BDes" class="form-label">คำอธิบายรายวิชา</label>
                    <textarea class="form-control" name="subject_BDes" rows="6" disabled><?php echo $row_sjb['subject_BDes']; ?></textarea>
                </div>

        </div>
        <!-- End ครึ่งจอแรก -->

        <!-- ครึ่งจอท้าย -->
        <div class="col-6">
            <h4 class="mb-3">รายวิชา ปวส. ที่เลือก</h4>
            <hr>
            <!-- ตารางแสดงรายวิชา ปวส. ทั้งหมดที่เลือกมาจากหลักสูตร -->
            <table class="table table-bordered table-striped">
                <thead>
                    <th style="width: 30px">No.</th>
                    <th style="width: 110px">รหัสวิชา</th>
                    <th>ชื่อวิชา</th>
                    <th style="width: 150px">คำอธิบายรายวิชา</th>
                </thead>

                <tbody>

                <?php
                    while ($row_sjaID = mysqli_fetch_array($sql_sjaID)) {
                        $raID = $row_sjaID['subject_AID'];
                        $rbID = $row_sjb['subject_BID'];
                ?>
                    <tr>
                        <!-- Check Box -->
                        <?php
                            $checkID = new DB_con();
                            $result =  $checkID->checkID($raID,$rbID);
                            $num = mysqli_fetch_array($result);

                            $check_saID = new DB_con();
                            $result_saID =  $check_saID->check_saID($raID);
                            $num_aid = mysqli_fetch_array($result_saID);

                            if($num >= 1){
                        ?>
                        <td>
                            <input class="form-check-input" type="checkbox" value="<?php echo $raID; ?>" id="check_saID" Name="check_saID[]" disabled checked><?php echo $raID; ?>
                        </td>
                        <?php } elseif($num_aid >= 1) { ?>
                        <td>
                            <input class="form-check-input" type="checkbox" value="<?php echo $raID; ?>" id="check_saID" Name="check_saID[]" disabled checked><?php echo $raID; ?>
                        </td>
                        <?php } else { ?>
                        <td>
                            <input class="form-check-input" type="checkbox" value="<?php echo $raID; ?>" id="check_saID" Name="check_saID[]"><?php echo $raID; ?>
                        </td>
                        <?php } ?>
                        <!-- End Check Box -->
                        <td><?php echo $row_sjaID['subject_ACode']; ?></td>
                        <td><?php echo $row_sjaID['subject_AName']; ?></td>
                        <!-- Btn Description -->
                        <td class="text-center">
                            <a href="form_modal" data-sjaID="<?=$row_sjaID['subject_AID']?>" data-sjbID="<?=$row_sjb['subject_BID']?>" class = "btn btn-info btn-sm desClass" data-toggle="modal" data-target="#form_modal">คำอธิบายรายวิชา</a>
                        </td>
                        <!-- End Btn Description -->
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            </div>
            <!-- End ครึ่งจอท้าย -->

            <hr>
                <div class="row justify-content-center text-center">
                    <div class="col-6">
                        <button type="submit" name="insert" class="btn btn-success mb-3 btn-block">Insert</button>
                    </div>
                    <div class="col-6">
                        <button type="reset" name="reset" class="btn btn-danger mb-3 btn-block">Reset</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- End แบ่งครึ่งจอ -->

            <!-- Modal -->
            <div class="modal fade" id="form_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="btn_desLabel" aria-hidden="true">
                <!-- Modal Dialog -->
                <div class="modal-dialog modal-xl">
                    <!-- End Modal Content -->
                    <div class="modal-content">

                    </div>
                    <!-- End Modal Content -->
                </div>
                <!-- End Modal Dialog -->
            </div>
            <!-- End Modal -->

    <?php } ?>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js" integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous"></script>
    <!--"test_des.php?sjbID=<script>+sjbID</script>&sjaID=<script>+sjaID</script>"-->
    <script>
        $('.desClass').click(function(){
            var sjaID=$(this).attr('data-sjaID');
            var sjbID=$(this).attr('data-sjbID');
            $.ajax({url:"match_modal.php?sjaID="+sjaID+"&sjbID="+sjbID,cache:false,success:function(result){
                $(".modal-content").html(result);
            }});
        });
    </script>

</body>
</html>
<?php  } ?>
