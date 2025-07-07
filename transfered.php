<?php
    include_once('functions.php');
    $id = $_GET['student_id'];

    $chk_cid = new DB_con();
    $sql_cid = $chk_cid->fetchonerecord_student($id);
    $row_cid = mysqli_fetch_array($sql_cid);
    $ca_id = $row_cid['courseA_ID'];

    $show = new DB_con();
    $sql_show = $show->showdata($ca_id);
    $row_data = mysqli_fetch_array($sql_show);
    $cb_id = $row_data['courseB_ID'];

    $show_cre = new DB_con();
    $sql_cre = $show_cre->show_credit($cb_id);
    $row_show_cre = mysqli_fetch_array($sql_cre);

    $show_cre_g = new DB_con();
    $sql_cre_g = $show_cre_g->show_credit_g($id);
    $row_show_cre_g = mysqli_fetch_array($sql_cre_g);
    $num_cre_g = mysqli_num_rows($sql_cre_g);
    $sum = 0;
    for($i=0;$i<$num_cre_g; $i++){
        $a[$i] = $row_show_cre_g['matchCredit'];
        $sum = $sum + $a[$i];
    }

    $result = $row_show_cre['courseB_Credit'] - $sum ;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ผลการเทียบโอนนักศึกษา</title>
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

                    <li>
                        <a class="btn btn-danger ml-2" aria-current="page" href="logout.php">ออกจากระบบ</a>
                    </li>
                </ul>
        </div >
    </nav>
    <!-- Table Course BCL -->
    <div class="container">
        <h1 class="mt-3">ผลการเทียบโอนนักศึกษา</h1>
        <hr>
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-4">
                    <a href="student_transfer.php?student_id=<?php echo $id; ?>" class="btn btn-danger mb-3">Back</a> 
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <?php
            $id = $_GET['student_id'];
            $std = new DB_con();
            $sql = $std->fetchonerecord_student($id);
            while($row = mysqli_fetch_array($sql)) {
        ?>
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="mb-2">
                    <label for="student_ID" class="form-label">รหัสนักศึกษา</label>
                    <input type="text" name="student_ID" class="form-control" value="<?php echo $row['student_ID']; ?>" disabled>
                </div>
                <div class="mb-2">
                    <label for="student_Name" class="form-label">ชื่อ - นามสกุล</label>
                    <input type="text" class="form-control" value="<?php echo $row['student_T_Name'].$row['student_F_Name']; ?>   <?php echo $row['student_L_Name']; ?>" disabled>
                </div>
                <div class="mb-2">
                    <label for="student_E_Name" class="form-label">First name - Last Name</label>
                    <input type="text" class="form-control" value="<?php echo $row['student_EF_Name']; ?>   <?php echo $row['student_EL_Name']; ?>" disabled>
                </div>
                <div class="mb-2">
                    <label for="stdCredit" class="form-label">คะแนนเฉลี่ยสะสม</label>
                    <input type="text" class="form-control" value="<?php echo $row['stdCredit']; ?>" disabled>
                </div>
            </div>
                    
            <div class="col-6">
                <div class="mb-2">
                    <label for="schoolID" class="form-label">รหัสสถาบัน</label>
                    <input type="text" class="form-control" value="<?php echo $row['schoolID']; ?>" disabled>
                </div>
                <div class="mb-2">
                    <label for="schoolName" class="form-label">ชื่อสถาบัน</label>
                    <input type="text" class="form-control" value="<?php echo $row['schoolName']; ?>" disabled>
                </div>
                <div class="mb-2">
                    <label for="courseA_Name" class="form-label">หลักสูตร</label>
                    <input type="text" class="form-control" value="<?php echo $row['courseA_Name']; ?>" disabled>
                </div>
                <div class="mb-2">
                    <label for="graduateYear" class="form-label">ปีที่จบการศึกษา</label>
                    <input type="text" class="form-control" value="<?php echo $row['graduateYear']; ?>" disabled>
                </div>
            </div>
        </div>
        <?php } ?>

        <hr>

        <h2 class="text-center">รายวิชาเทียบได้</h2>

        <table id="s_match_b_table" class="table table-bordered table-striped">
            <thead>
                <th class="text-center">#</th>
                <th class="text-center" style="width: 150px;">รหัสวิชา</th>
                <th class="text-center">ชื่อวิชา</th>
                <th class="text-center">กลุ่มวิชา</th>
                <th class="text-center">หมวดหมู่</th>
                <th class="text-center" style="width: 80px;">หน่วยกิต</th>
                <th class="text-center">เทียบโอน</th>
                <th class="text-center" style="width: 150px;">รหัสวิชา</th>
                <th class="text-center">ชื่อวิชา</th>
                <th class="text-center" style="width: 80px;">หน่วยกิต</th>
                <th class="text-center">เกรด</th>
            </thead>

            <tbody>

            <?php
                $data_b = new DB_con();
                $sql_data_b = $data_b->fetch_data_b($cb_id);
                $num_data_b = mysqli_num_rows($sql_data_b);
                while ($row_data_b = mysqli_fetch_array($sql_data_b)) {
                    $sjb = $row_data_b['subject_BID'];
            ?>

                <tr>
                    <td><?php echo $sjb; ?></td>
                    <td><?php echo $row_data_b['subject_BCode']; ?></td>
                    <td><?php echo $row_data_b['subject_BName']; ?></td>
                    <td><?php echo $row_data_b['sgName']; ?></td>
                    <td><?php echo $row_data_b['categoryName']; ?></td>
                    <td class="text-center"><?php echo $row_data_b['subject_BCredit']; ?></td>
                    <?php
                        $check = new DB_con();
                        $sql_check = $check->check_sjb($id,$sjb);
                        $num_chk = mysqli_num_rows($sql_check);
                        $row_chk = mysqli_fetch_array($sql_check);
                        if ($num_chk == "") {
                    ?>
                    <td class="text-center"><img src="img/check-red.png" style="width: 20px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <?php } else { ?>
                    <td class="text-center"><img src="img/check-green.png" style="width: 20px;"></td>
                    <td><?php echo $row_chk['subject_ACode']; ?></td>
                    <td><?php echo $row_chk['subject_AName']; ?></td>
                    <td><?php echo $row_chk['subject_ACredit']; ?></td>
                    <td><?php echo $row_chk['subjectGrade']; ?></td>
                    <?php } ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>

        <hr>
        <h1>สรุป</h1>
        <h3>หน่วยกิตในหลักสูตรทั้งหมด  <?php echo $row_show_cre['courseB_Credit']; ?>  หน่วยกิต</h3>
        <h3>หน่วยกิตเทียบได้  <?php echo $sum; ?>  หน่วยกิต</h3>
        <h3>หน่วยกิตเทียบที่เหลือ  <?php echo $result ?>  หน่วยกิต</h3>
        <hr>

    </div>
    
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js" integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous"></script>
</body>
</html>