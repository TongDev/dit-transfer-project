<?php

    include_once('functions.php');
    $updatedata = new DB_con();

    if (isset($_POST['update'])) {
        $caID = $_GET['cA_ID'];
        $cacName = $_POST['courseA_CodeName'];
        $caName = $_POST['courseA_Name'];
        $baName = $_POST['branchA_Name'];
        $caImprove = $_POST['courseA_Improve'];
        $caCredit = $_POST['courseA_Credit'];
        $scNum = $_POST['schoolNum'];

        $sql = $updatedata->update_a($caID,$cacName,$caName,$baName,$caImprove,$caCredit,$scNum);

        if ($sql) {
            echo "<script>alert('แก้ไขรายหลักสูตรเสร็จสิ้น !');</script>";
            echo "<script>window.location.href='course_a.php'</script>";
        } else {
            echo "<script>alert('แก้ไขหลักสูตรล้มเหลว !');</script>";
            echo "<script>window.location.href='course_a_update.php'</script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขหลักสูตรประกาศนียบัตรชั้นสูง</title>
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
    <!-- Form update avp -->
    <div class="container">
        <h1 class="mt-3">แก้ไขหลักสูตร</h1>
        <hr>
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-4">
                    <a href="course_a.php" class="btn btn-danger mb-3">Back</a> 
                </div>
            </div>
        </div>
        <?php
            $caID = $_GET['cA_ID'];
            $update_avp = new DB_con();
            $sql = $update_avp->fetchonerecord_a($caID);
            while($row = mysqli_fetch_array($sql)) {
        ?>

        <form action="" method="post">
            <div class="mb-3">
                <label for="courseA_CodeName" class="form-label">ชื่อหลักสูตร</label>
                <input type="text" name="courseA_CodeName" class="form-control"
                value="<?php echo $row['courseA_CodeName']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="courseA_Name" class="form-label">ชื่อหลักสูตร</label>
                <input type="text" name="courseA_Name" class="form-control"
                value="<?php echo $row['courseA_Name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="branchA_Name" class="form-label">ชื่อสาขา</label>
                <input type="text" name="branchA_Name" class="form-control" 
                value="<?php echo $row['branchA_Name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="courseA_Improve" class="form-label">ปีที่ปรับปรุง</label>
                <input type="text" name="courseA_Improve" class="form-control" 
                value="<?php echo $row['courseA_Improve']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="courseA_Credit" class="form-label">หน่วยกิต</label>
                <input type="text" name="courseA_Credit" class="form-control" 
                value="<?php echo $row['courseA_Credit']; ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="schoolName" class="form-label">สถาบัน</label>
                <select class="form-select" name="schoolNum" id="schoolNum" aria-label="โปรดเลือกสถาบัน" required>
                    <option selected>โปรดเลือกสถาบัน</option>
                    <?php
                    include_once('functions.php');
                    $fetchselect0 = new DB_con();
                    $sql0 = $fetchselect0->fetchselect_school();
                    while($row0 = mysqli_fetch_array($sql0)){
                    ?>
                    <option value="<?php echo $row0['schoolNum']; ?>"><?php echo $row0["schoolNum"];?>. <?php echo $row0["schoolName"];?></option>
                    <?php
                        }
                    ?>
                </select>
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