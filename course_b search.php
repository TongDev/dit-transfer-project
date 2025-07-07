<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการหลักสูตรปริญญาตรี</title>
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
                        <a class="btn btn-success" aria-current="page" href="index.php">หน้าแรก</a>
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
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="school.php">สถาบัน</a></li>
                                </ul>
                        </div>
                    </li>

                    <li>
                        <a class="btn btn-danger ml-2" aria-current="page" href="index.php">ออกจากระบบ</a>
                    </li>
                </ul>
        </div >
    </nav>
    <!-- Table Course BCL -->
    <div class="container">

        <h1 class="mt-3">จัดการหลักสูตรปริญญาตรี</h1>
        <a href="course_b_insert.php" class="btn btn-success mb-3 mt-2">เพิ่มหลักสูตรปริญญาตรี</a>
        
        <hr>

        <table id="course_table" class="table table-bordered table-striped">
            <thead>
                <th>#</th>
                <th>ชื่อย่อหลักสูตร</th>
                <th>ชื่อหลักสูตร</th>
                <th>ชื่อสาขา</th>
                <th>ปีที่ปรับปรุง</th>
                <th>หน่วยกิตรวม</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </thead>

            <tbody>
                <?php
                    include_once('functions.php');
                    $fetchdata = new DB_con();
                    $sql = $fetchdata->fetchdata_bcl();
                    while ($row = mysqli_fetch_array($sql)) {
            
                ?>

                    <tr>
                        <td><?php echo $row['courseB_ID']; ?></td>
                        <td><?php echo $row['courseB_CodeName']; ?></td>
                        <td><?php echo $row['courseB_Name']; ?></td>
                        <td><?php echo $row['branchB_Name']; ?></td>
                        <td><?php echo $row['courseB_Improve']; ?></td>
                        <td><?php echo $row['courseB_Credit']; ?></td>
                        <td><a href="course_b_update.php?courseB_ID=<?php echo $row['courseB_ID']; ?>" class="btn btn-warning">แก้ไข</a></td>
                        <td><a href="course_b_delete.php?del=<?php echo $row['courseB_ID']; ?>" class="btn btn-danger">ลบ</a></td>
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