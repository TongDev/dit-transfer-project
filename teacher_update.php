<?php

    include_once('functions.php');

    $updatedata = new DB_con();

    if (isset($_POST['update'])) {
        $ctcID = $_GET['ctcID'];
        $ctcUser = $_POST['ctcUserName'];
        $ctcPass = $_POST['ctcPassword'];
        $ctcName = $_POST['ctcName'];
        $ctcTel = $_POST['ctcTel'];

        $sql = $updatedata->update_ctc($ctcID,$ctcUser,$ctcPass,$ctcName,$ctcTel);

        if ($sql) {
            echo "<script>alert('แก้ไขอาจารย์ประจำหลักสูตรเสร็จสิ้น !');</script>";
            echo "<script>window.location.href='course_teacher.php'</script>";
        } else {
            echo "<script>alert('แก้ไขอาจารย์ประจำหลักสูตรล้มเหลว !');</script>";
            echo "<script>window.location.href='teacher_update.php'</script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขอาจารย์ประจำหลักสูตร</title>
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
    <!-- Form update user -->
    <div class="container">
        <h1 class="mt-3">แก้ไขอาจารย์ประจำหลักสูตร</h1>
        <hr>
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-4">
                    <a href="course_teacher.php" class="btn btn-danger mb-3">Back</a> 
                </div>
            </div>
        </div>
        <?php
            $ctcID = $_GET['ctcID'];
            $update_ctc = new DB_con();
            $sql = $update_ctc->fetchonerecord_ctc($ctcID);
            while($row = mysqli_fetch_array($sql)) {
        ?>
        <form action="" method="post">
            <div class="mb-3">
                <label for="ctcName" class="form-label">ชื่อ - นามสกุล</label>
                <input type="text" name="ctcName" class="form-control"
                value="<?php echo $row['ctcName']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="ctcUserName" class="form-label">Username</label>
                <input type="text" name="ctcUserName" class="form-control"
                value="<?php echo $row['ctcUserName']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="ctcPassword" class="form-label">Password</label>
                <input type="password" name="ctcPassword" class="form-control" 
                value="<?php echo $row['ctcPassword']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="ctcTel" class="form-label">เบอร์โทรศัพท์</label>
                <input type="text" name="ctcTel" class="form-control" 
                value="<?php echo $row['ctcTel']; ?>" required>
            </div>
            <?php } ?>
            <button type="submit" name="update" class="btn btn-warning">UPDATE</button>
        </form>
    </div>


    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js" integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous"></script>
</body>
</html>