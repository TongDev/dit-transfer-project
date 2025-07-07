<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการวิชาประกาศนียบัตรชั้นสูง</title>
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
                                    <li><a class="dropdown-item disabled" href="subject_a.php">รายวิชา ปวส.</a></li>
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
    <!-- Table Subject AVP -->
    <div class="container">

        <h1 class="mt-3">จัดการวิชาประกาศนียบัตรชั้นสูง</h1>
        <hr>
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-4">
                    <a href="teacher_menu.php" class="btn btn-danger mb-3">Back</a> 
                </div>
                <div class="col-3">
                    <a href="subject_a_insert.php" class="btn btn-success mb-3">เพิ่มรายวิชาประกาศนียบัตรชั้นสูง</a> 
                </div>
            </div>
        </div>

        <table id="subject_a_table" class="table table-bordered table-striped">
            <thead>
                <th>#</th>
                <th>สถาบัน</th>
                <th>หลักสูตร</th>
                <th>รหัสวิชา</th>
                <th>ชื่อวิชา</th>
                <th>คำอธิบายรายวิชา</th>
                <th>หน่วยกิต</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </thead>

            <tbody>
                <?php
                    include_once('functions.php');
                    $fetchdata = new DB_con();
                    $sql = $fetchdata->fetchdata_a_subject();
                    while ($row = mysqli_fetch_array($sql)) {
            
                ?>

                    <tr>
                        <td><?php echo $row['subject_AID']; ?></td>
                        <td><?php echo $row['schoolName']; ?></td>
                        <td><?php echo $row['courseA_CodeName']; ?></td>
                        <td><?php echo $row['subject_ACode']; ?></td>
                        <td><?php echo $row['subject_AName']; ?></td>
                        <td><?php echo $row['subject_ADes']; ?></td>
                        <td><?php echo $row['subject_ACredit']; ?></td>
                        <td><a href="subject_a_update.php?subject_AID=<?php echo $row['subject_AID']; ?>" class="btn btn-warning">แก้ไข</a></td>
                        <td><a href="subject_a_delete.php?del=<?php echo $row['subject_AID']; ?>" class="btn btn-danger">ลบ</a></td>
                    </tr>

                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js" integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous"></script>
</body>
</html>