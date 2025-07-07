<?php
    include_once('functions.php');
    $id = $_GET['student_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เทียบโอนนักศึกษา</title>
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
                                    <li><a class="dropdown-item disabled" href="student_show.php">ข้อมูลนักศึกษา</a></li>
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
        <h1 class="mt-3">เทียบโอนนักศึกษา</h1>
        <hr>
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-4">
                    <a href="student_show.php" class="btn btn-danger mb-3">Back</a> 
                </div>
                <div class="col-2">
                    <a href="transfered.php" class="btn btn-success mb-3">ผลการเทียบโอน</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <?php
            $id = $_GET['student_id'];
            $update_std = new DB_con();
            $sql = $update_std->fetchonerecord_student($id);
            while($row = mysqli_fetch_array($sql)) {
        ?>
        <div class="row justify-content-center">
            <form action="" method="post">
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
        
        <hr>

        <table id="s_match_b_table" class="table table-bordered table-striped">
            <thead>
                <th class="text-center">หลักสูตร</th>
                <th class="text-center" style="width: 150px;">รหัสวิชา</th>
                <th class="text-center">ชื่อวิชา</th>
                <th class="text-center" style="width: 80px;">หน่วยกิต</th>
                <th class="text-center">ผลการเรียน</th>
            </thead>
                <tbody>
                    <?php
                        $caid = $row['courseA_ID'];
                        $fetchdata = new DB_con();
                        $sql = $fetchdata->grade($caid);
                        while ($row = mysqli_fetch_array($sql)) {
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $row['courseA_CodeName']; ?></td>
                            <td class="text-center"><?php echo $row['subject_ACode']; ?></td>
                            <td><?php echo $row['subject_AName']; ?></td>
                            <td class="text-center"><?php echo $row['subject_ACredit']; ?></td>
                            <td class="text-center" style="width: 150px;">
                                <select name="grade" class="form-select">
                                    <option selected>เลือกเกรด</option>
                                    <option value="4.0">A (4.0)</option>
                                    <option value="3.5">B+ (3.5)</option>
                                    <option value="3.0">B (3.0)</option>
                                    <option value="2.5">C+ (2.5)</option>
                                    <option value="2.0">C (2.0)</option>
                                    <option value="1.5">D+ (1.5)</option>
                                    <option value="1.0">D (1.0)</option>
                                </select>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <hr>
            <div class="row justify-content-center">
                <div class="col-6 text-center"><button class="btn btn-success btn-block" type="submit">Submit</button></div>
                <div class="col-6 text-center"><button class="btn btn-danger btn-block" type="reset">Reset</button></div>
            </div>
            <hr>
        </form>
        <?php } ?>
    </div>
    
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js" integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous"></script>
</body>
</html>