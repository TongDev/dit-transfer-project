<?php

    include_once('functions.php');

    $insertdata = new DB_con();

    if (isset($_POST['insert'])) {

        if ($_POST['student_Title'] == 'นาง') {
            $std_tt = 'นาง';
            $std_te = 'Female';
        } elseif ($_POST['student_Title'] == 'นางสาว') {
            $std_tt = 'นาง';
            $std_te = 'Female';
        } else {
            $std_tt = 'นาย';
            $std_te = 'Male';
        }

        $std_id = $_POST['student_ID'];
        $std_fn = $_POST['student_F_Name'];
        $std_ln = $_POST['student_L_Name'];
        $std_fne = $_POST['student_EF_Name'];
        $std_lne = $_POST['student_EL_Name'];
        $std_aid = $_POST['courseA_ID'];

        $chk_school = new DB_con();
        $sql_chk_school = $chk_school->chk_school($std_aid);
        $checked = mysqli_fetch_array($sql_chk_school);
        if ($std_aid == $checked['courseA_ID']) {
            $std_sch = $checked['schoolNum'];
        } else {
            echo "ไม่มีหลักสูตรที่เลือก";
        }

        $std_gdy = $_POST['graduateYear'];
        $std_cs = $_POST['creditsStudied'];
        $std_ce = $_POST['creditsEarned'];
        $std_cre = $_POST['stdCredit'];

        $check_student = new DB_con();
        $chk_std = $check_student->check_student($std_fn,$std_ln);
        $std_num = mysqli_num_rows($chk_std);

        $check_student_id = new DB_con();
        $chk_std_id = $check_student_id->check_student_id($std_id);
        $std_id_num = mysqli_num_rows($chk_std_id);

        if ($std_num > 0) {
            echo "<script>alert('ชื่อ - นามสกุล ซ้ำ, โปลดลองใหม่อีกครั้ง !');</script>";
            echo "<script>window.history.back();</script>";
        } elseif ($std_id_num > 0) {
            echo "<script>alert('รหัสนักศึกษาซ้ำ, โปลดลองใหม่อีกครั้ง !');</script>";
            echo "<script>window.history.back();</script>";
        } else {
            $sql_insert = $insertdata->insert_student($std_id,$std_tt,$std_fn,$std_ln,$std_te,$std_fne,$std_lne,$std_sch,$std_aid,$std_gdy,$std_cs,$std_ce,$std_cre);
        }

        if ($sql_insert) {
            echo "<script>alert('เพิ่มนักศึกษาเสร็จสิ้น !');</script>";
            echo "<script>window.location.href='student_show.php'</script>";
        } else {
            echo "<script>alert('เพิ่มนักศึกษาล้มเหลว !');</script>";
            echo "<script>window.history.back();</script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มนักศึกษา</title>
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
        </div >
    </nav>
    <!-- Form insert avp -->
    <div class="container">
        <h1 class="mt-3">เพิ่มนักศึกษา</h1>
        <hr>
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-4">
                    <a href="student_show.php" class="btn btn-danger mb-3">Back</a> 
                </div>
            </div>
        </div>

        <form action="" method="post">
            <div class="mb-3">
                <label for="student_ID" class="form-label">รหัสนักศึกษา (ถ้ามี)</label>
                <input type="text" name="student_ID" class="form-control">
            </div>
            <div class="mb-3">
                <label for="student_Title" class="form-label">คำนำหน้าชื่อ</label>
                <select name="student_Title" class="form-select">
                    <option selected>เลือกคำนำหน้าชื่อ</option>
                    <option value="นาย">นาย</option>
                    <option value="นาง">นาง</option>
                    <option value="นางสาว">นางสาว</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="student_F_Name" class="form-label">ชื่อ (ภาษาไทย)</label>
                <input type="text" name="student_F_Name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="student_L_Name" class="form-label">นามสกุล (ภาษาไทย)</label>
                <input type="text" name="student_L_Name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="student_EF_Name" class="form-label">First Name</label>
                <input type="text" name="student_EF_Name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="student_EL_Name" class="form-label">Last Name</label>
                <input type="text" name="student_EL_Name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="courseA_CodeName" class="form-label">หลักสูตร</label>
                <select class="form-select" name="courseA_ID" id="courseA_ID" aria-label="โปรดเลือกหลักสูตรปริญญาตรี" required>
                    <option selected>หลักสูตรประกาศนียบัตรชั้นสูง</option>
                        <?php
                            include_once('functions.php');
                            $fetchselect = new DB_con();
                            $sql = $fetchselect->fetchselect_a();
                            while($row = mysqli_fetch_array($sql)){
                        ?>
                            <option value="<?php echo $row['courseA_ID']; ?>"><?php echo $row["courseA_ID"];?>. <?php echo $row["courseA_CodeName"];?> สาขา<?php echo $row["branchA_Name"];?> <?php echo $row["schoolName"];?></option>
                        <?php
                            }
                        ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="graduateYear" class="form-label">ปีที่จบการศึกษา</label>
                <input type="text" name="graduateYear" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="creditsStudied" class="form-label">จำนวนหน่วยกิตที่เรียน</label>
                <input type="text" name="creditsStudied" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="creditsEarned" class="form-label">จำนวนหน่วยกิตที่ได้</label>
                <input type="text" name="creditsEarned" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="stdCredit" class="form-label">ระดับคะแนนเฉลี่ยสะสม</label>
                <input type="text" name="stdCredit" class="form-control" required>
            </div>
            <button type="submit" name="insert" class="btn btn-success">INSERT</button>
            <hr>
        </form>
    </div>
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js" integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous"></script>
</body>
</html>