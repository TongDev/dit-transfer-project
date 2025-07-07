<?php
    session_start();
    include_once('functions.php');

    if ($_SESSION['courseB_ID'] == "" && $_SESSION['courseA_ID'] == "") {
        header("location: s_match_show.php");

    } else {

    $cbID = $_SESSION['courseB_ID'];
    $caID = $_SESSION['courseA_ID'];

    $fetch_all_bcl = new DB_con();
    $sql_all_bcl = $fetch_all_bcl->fetchdata_select_bcl($cbID);

    $fetch_sj_bid = new DB_con();
    $sql_sj_bid = $fetch_sj_bid->fetchdata_select_bcl($cbID);
    $sj_bid = mysqli_fetch_array($sql_sj_bid);

    if (isset($_POST['del'])) {
        $sjbID = $_POST['subject_BID'];
        if(empty($_POST['check_saID'])){
            echo "<script>alert('โปลดเลือกวิชาที่ต้องการลบก่อน !');</script>";
        } else {
            for($i=0;$i<count($_POST['check_saID']);$i++){
                $sjaID = $_POST['check_saID'][$i];
                $del = new DB_con();
                $sql_del = $del->delete_check($sjbID,$sjaID);

                //TEST หา subject_BID
                //$sql_del = $del->chk_del($sjbID,$sjaID);
                //$test = mysqli_fetch_array($sql_del);
                //echo $test['subject_BID'];
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จับคู่ตามหลักสูตร</title>
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
                                    <li>
                                        <a class="dropdown-item" href="course_b.php">หลักสูตรปริญญาตรี</a>
                                    </li>
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

                    <li>
                        <a class="btn btn-danger ml-2" aria-current="page" href="logout.php">ออกจากระบบ</a>
                    </li>
                </ul>
        </div>
    </nav>

    <!-- Table Subject Matched -->
    <div class="container">
        <h1 class="mt-3">จับคู่ตามหลักสูตร</h1>
        <hr>
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-4">
                    <a href="s_match_show.php" class="btn btn-danger mb-3">Back</a> 
                </div>
            </div>
        </div>
        <!-- ส่วนหัว -->
        <div class="row justify-content-center">
            <div class="col-5">
                <div class="text-center">
                    <h4>รายวิชาปริญญาตรี</h4>
                    <hr>
                </div>
            </div>
            <div class="col-6">
                <div class="text-center">
                    <h4>รายวิชาประกาศนียบัตรชั้นสูง (จับคู่แล้ว)</h4>
                    <hr>
                </div>
            </div>
            <div class="col-1">
                <div class="text-center">
                    <h4></h4>
                    
                </div>
            </div>
        </div>
  
            <!-- ส่วน Table BCL ที่เลือกมา -->
            
        <table class="table table-bordered table-striped">
            <div class="row justify-content-center">
                <thead class="text-center">
                    <tr>
                    <div class="col-5">
                        <th scope="col" style="width: 30px">No.</th>
                        <th scope="col">รหัสวิชา</th>
                        <th scope="col">ชื่อวิชา</th>
                        <th scope="col" style="width: 30px">นก.</th>
                        <th scope="col" style="width: 10px"></th>
                    </div>
                    <div class="col-5">
                        <th scope="col" style="width: 100px">รหัสวิชา</th>
                        <th scope="col">ชื่อวิชา</th>
                        <th scope="col" style="width: 30px">นก.</th>
                        <th scope="col" style="width: 10px"></th>
                    </div>
                    <div class="col-2">
                        <th scope="col" style="width: 65px">จับคู่</th>
                        <th scope="col" style="width: 50px">ลบ</th>
                    </div>
                    </tr>
                </thead>

                <div class="row justify-content-center">
                    <tbody>
                        <!-- fetch หลักสูตร ป.ตรี ทั้งคู่แล้ว และ ยังไม่คู่ รวมกัน และ เก็บในรูปแบบ Array -->
                        <?php
                            while ($row = mysqli_fetch_array($sql_all_bcl)) {
                        ?>
                        <tr>
                            <form action="" method="post">
                            
                            <div class="col-5">
                                <td class="text-center"><?php echo $row['subject_BID']; ?></td>
                                <td class="text-center" style="width: 110px"><?php echo $row['subject_BCode']; ?></td>
                                <td style="width: 400px"><?php echo $row['subject_BName']; ?></td>
                                <td class="text-center"><?php echo $row['subject_BCredit']; ?></td>
                                <td></td>
                            </div>
                            
                            <!-- ซ่อน BID ไป -->
                            <div class="mb-3">
                                <label for="subject_BID" class="form-label" hidden="true">BID</label>
                                <input type="text" name="subject_BID" class="form-control" value="<?php echo $row['subject_BID']; ?>" hidden="true" required>
                            </div>

                            <?php
                                $r1 = $row['subject_BID'];
                                $search = new DB_con();
                                // fetch หลักสูตร ปวส. ที่จับคู่แล้วมาเก็บในรูปแบบ Array
                                $sql_search = $search->fetchdata_all_matched_subject($r1,$cbID,$caID);
                                $num = mysqli_num_rows($sql_search);
                                while ($row_sa = mysqli_fetch_array($sql_search)){
                                    $r2 = $row_sa['subject_BID'];
                                    if($num > 1){
                                        $aid[] = $row_sa['subject_AID'];
                                        $code[] = $row_sa['subject_ACode'];
                                        $name[] = $row_sa['subject_AName'];
                                        $cre[] = $row_sa['subject_ACredit'];
                                    } elseif($num = 1){
                                        $aid = $row_sa['subject_AID'];
                                        $code = $row_sa['subject_ACode'];
                                        $name = $row_sa['subject_AName'];
                                        $cre = $row_sa['subject_ACredit'];
                                    }
                            }

                            //ถ้าไม่มีรายวิชาที่ตรงกันกับ Smatch ให้แสดงเป็นค่าว่าง
                            if (empty($r2)){ //เช็คว่า ลำดับวิชา ป.ตรี จาก sMatchNum เป็นค่าว่างรึเปล่า
                            ?>
                            <!--ถ้าไม่มีรายวิชาที่ตรงกันกับ Smatch ให้แสดงเป็นค่าว่าง-->
                            <div class="col-5">
                                <td></td>
                                <td></td>
                                <td</td>
                                <td></td>
                            </div>
                            <!-- ถ้าวิชาที่เทียบกับ รายวิชาปริญญาตรี มีมากกว่า 1 วิชา -->
                            <?php } elseif($num > 1) { ?>
                            
                                <div class="col-5">
                                    <td>
                                        <?php for ($i=0; $i < $num; $i++) {
                                            echo $code[$i];
                                        ?>
                                        <br>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php for ($i=0; $i < $num; $i++) {
                                            echo $name[$i];
                                        ?>
                                        <br>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php for ($i=0; $i < $num; $i++) {
                                            echo $cre[$i];
                                        ?>
                                        <br>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php for ($i=0; $i < $num; $i++) {
                                        ?>
                                            <input class="form-check-input mb-1" type="checkbox" value="<?php echo $aid[$i]; ?>" id="check_saID" Name="check_saID[]">
                                            <br>
                                        <?php } ?>
                                    </td>
                                </div>
                            <!-- ถ้าวิชาที่เทียบกับ รายวิชาปริญญาตรี = 1 วิชา -->
                            <?php } elseif($num = 1 && $r1 == $r2) { ?>

                                <div class="col-5">
                                    <td><?php echo $code; ?></td>
                                    <td><?php echo $name; ?></td>
                                    <td><?php echo $cre; ?></td>
                                    <td>
                                        <input class="form-check-input" type="checkbox" value="<?php echo $aid; ?>" id="check_saID" Name="check_saID[]">
                                    </td>
                                </div>
                            <?php } else { ?>
                            <!-- ถ้าบางรายวิชามีตรงกันกัน Smatch ที่ไม่ตรงให้ว่างไว้ -->
                                <div class="col-5">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </div>
                            <?php } ?>
                            <div class="col-2">
                                <!-- Btn จับคู่ -->
                                <td class="text-center">
                            <a href="s_match_insert.php?sb_match=<?php echo $r1; ?>&courseA_ID=<?php echo $caID; ?>&courseB_ID=<?php echo $cbID; ?>" class="btn btn-sm btn-success">จับคู่</a>
                                </td>
                                <!-- Btn ลบ -->
                                <td class="text-center">
                                    <button class="btn btn-danger btn-sm" name="del">ลบ</button>
                                </td>
                            </div>
                        </form>
                        </tr>
                        <?php } ?>
                    </tbody>
                </div>
            </div>
        </table>
        
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js" integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous"></script>
</body>
</html>
        
<?php } ?>