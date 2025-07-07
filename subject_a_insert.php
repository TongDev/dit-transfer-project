<?php

    include_once('functions.php');

    $insertdata = new DB_con();

    if (isset($_POST['insert'])) {
        $sjaCode = $_POST['subject_ACode'];
        $sjaName = $_POST['subject_AName'];
        $sjaCredit = $_POST['subject_ACredit'];
        $sjaDes = $_POST['subject_ADes'];
        $caID = $_POST['courseA_ID'];
        
        $check_sjaCode = new DB_con();
        $result = $check_sjaCode->check_sjaCode($sjaCode);
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            echo "<script>alert('รหัสวิชาซ้ำ, โปลดลองใหม่อีกครั้ง !');</script>";
            echo "<script>window.history.back();</script>";
        } else {
            $sql_insert = $insertdata->insert_a_subject($sjaCode,$sjaName,$sjaCredit,$sjaDes,$caID);
        }
        
        if ($sql_insert) {
            echo "<script>alert('เพิ่มวิชาเสร็จสิ้น !');</script>";
            echo "<script>window.location.href='subject_a.php'</script>";
        } else {
            echo "<script>alert('เพิ่มวิชาล้มเหลว !');</script>";
            echo "<script>window.history.back();</script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มรายวิชาปริญญาตรี</title>
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
    <!-- Form insert bcl -->
    <div class="container">
        <h1 class="mt-5">เพิ่มรายวิชาประกาศนียบัตรชั้นสูง</h1>
        <hr>
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-4">
                    <a href="subject_a.php" class="btn btn-danger mb-3">Back</a> 
                </div>
            </div>
        </div>
        <form action="" method="post">
            <div class="mb-3">
                <label for="courseA_CodeName" class="form-label">หลักสูตร</label>
                <select class="form-select" name="courseA_ID" name="courseA_ID" aria-label="โปรดเลือกหลักสูตร" required>
                    <option selected>โปรดเลือกหลักสูตร</option>
                    <?php
                    include_once('functions.php');
                    $fetchselect = new DB_con();
                    $sql = $fetchselect->fetchselect_a();
                    while($row = mysqli_fetch_array($sql)){
                    ?>
                    <option value="<?php echo $row['courseA_ID']; ?>"><?php echo $row["courseA_ID"];?>. <?php echo $row["courseA_CodeName"];?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="subject_ACode" class="form-label">รหัสวิชา</label>
                <input type="text" name="subject_ACode" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="subject_AName" class="form-label">ชื่อวิชา</label>
                <input type="text" name="subject_AName" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="subject_ADes" class="form-label">คำอธิบายรายวิชา</label>
                <textarea class="form-control" name="subject_ADes" rows="6" required></textarea>
            </div>
            <div class="mb-3">
                <label for="subject_ACredit" class="form-label">หน่วยกิต</label>
                <input type="text" name="subject_ACredit" class="form-control" required>
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