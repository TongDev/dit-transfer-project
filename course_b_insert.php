<?php

    include_once('functions.php');

    $insertdata = new DB_con();

    if (isset($_POST['insert'])) {
        $cbcName = $_POST['courseB_CodeName'];
        $cbName = $_POST['courseB_Name'];
        $bName = $_POST['branchB_Name'];
        $cbImprove = $_POST['courseB_Improve'];
        $cbCredit = $_POST['courseB_Credit'];

        $check_codename = new DB_con();
        $result = $check_codename->check_codename_b($cbcName);
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            echo "<script>alert('รหัสหลักสูตรซ้ำ, โปลดลองใหม่อีกครั้ง !');</script>";
            echo "<script>window.history.back();</script>";
        } else {
            $sql_insert = $insertdata->insert_b($cbcName,$cbName,$bName,$cbImprove,$cbCredit);
        }
        
        if ($sql_insert) {
            echo "<script>alert('เพิ่มหลักสูตรเสร็จสิ้น !');</script>";
            echo "<script>window.location.href='course_b.php'</script>";
        } else {
            echo "<script>alert('เพิ่มหลักสูตรล้มเหลว');</script>";
            echo "<script>window.history.back();</script>";
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มหลักสูตรปริญญาตรี</title>
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
                        <a class="btn btn-danger ml-2" aria-current="page" href="index.php">ออกจากระบบ</a>
                    </li>
                </ul>
        </div >
    </nav>
    <!-- Form insert bcl -->
    <div class="container">
        <h1 class="mt-3">เพิ่มหลักสูตรปริญญาตรี</h1>
        <hr>
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-4">
                    <a href="course_b.php" class="btn btn-danger mb-3">Back</a> 
                </div>
            </div>
        </div>
        <form action="" method="post">
            <div class="mb-3">
                <label for="courseB_CodeName" class="form-label">ชื่อย่อหลักสูตร</label>
                <input type="text" name="courseB_CodeName" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="courseB_Name" class="form-label">ชื่อหลักสูตร</label>
                <input type="text" name="courseB_Name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="branchB_Name" class="form-label">สาขา</label>
                <input type="text" name="branchB_Name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="courseB_Improve" class="form-label">ปีที่ปรับปรุง</label>
                <input type="text" name="courseB_Improve" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="courseB_Credit" class="form-label">หน่วยกิต</label>
                <input type="text" name="courseB_Credit" class="form-control">
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