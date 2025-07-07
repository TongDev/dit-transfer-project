<?php
    session_start();
    include_once('functions.php');

    $insertdata = new DB_con();

    if (isset($_POST['submit'])) {
        $cbID = $_POST['courseB_ID'];
        $caID = $_POST['courseA_ID'];
        $result = $insertdata->fetchdata_b_and_a($cbID,$caID); //
        $num = mysqli_fetch_array($result);
        
        if ($num > 0) {
            $_SESSION['courseB_ID'] = $num['courseB_ID'];
            $_SESSION['courseA_ID'] = $num['courseA_ID'];
            echo "<script>alert('ตรวจสอบรายวิชาจับคู่เสร็จสิ้น !');</script>";
            echo "<script>window.location.href='s_match_detail.php'</script>";
        } else {
            echo "<script>alert('ตรวจสอบรายวิชาจับคู่ล้มเหลว !');</script>";
            echo "<script>window.location.href='#'</script>";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จับคู่รายวิชา</title>
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
                                    <li><a class="dropdown-item disabled" href="s_match_show.php">วิชาที่จับคู่</a></li>
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
        <h1 class="mt-3">จับคู่รายวิชา</h1>
        <hr>
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-4">
                    <a href="teacher_menu.php" class="btn btn-danger mb-3">Back</a> 
                </div>
                <div class="col-2">
                    <!-- Pop-up จับคู่ตามหลักสูตร -->
                    <button href="s_match_search.php" class="btn btn-success mb-3" data-toggle="modal" data-target="#search_s_match" data-whatever="@mdo">จับคู่ตามหลักสูตร</button>
                        <div class="modal fade" id="search_s_match" tabindex="-1" aria-labelledby="SearchModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="SearchModalLabel">จับคู่ตามหลักสูตร</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            <!-- Select BCL -->
                                            <div class="mb-3">
                                                <label for="courseB_CodeName" class="form-label">หลักสูตรปริญญาตรี</label>
                                                <select class="form-select" name="courseB_ID" id="courseB_ID" aria-label="โปรดเลือกหลักสูตรปริญญาตรี" required>
                                                    <option selected>โปรดเลือกหลักสูตรปริญญาตรี</option>
                                                        <?php
                                                        include_once('functions.php');
                                                        $fetchselect = new DB_con();
                                                        $sql = $fetchselect->fetchselect_b();
                                                        while($row = mysqli_fetch_array($sql)){
                                                        ?>
                                                        <option value="<?php echo $row['courseB_ID']; ?>"><?php echo $row["courseB_ID"];?>. <?php echo $row["courseB_CodeName"];?> สาขา<?php echo $row["branchB_Name"];?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                </select>
                                            </div>
                                            <!-- Select AVP -->
                                            <div class="mb-3">
                                                <label for="courseA_CodeName" class="form-label">หลักสูตรประกาศนียบัตรชั้นสูง</label>
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
                                            <hr class="mb-3">
                                                <button type="submit" name="submit" class="btn btn-success">ตรวจสอบรายวิชาจับคู่</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="text-center">
                    <h4>รายวิชาปริญญาตรี</h4>
                    <hr>
                </div>
            </div>
            <div class="col-6">
                <div class="text-center">
                    <h4>รายวิชาประกาศนียบัตรชั้นสูง</h4>
                    <hr>
                </div>
            </div>
            <table id="s_match_b_table" class="table table-bordered table-striped">
                <thead>
                        <th class="text-center">#</th>
                        <th class="text-center">หลักสูตร</th>
                        <th class="text-center" style="width: 120px;">รหัสวิชา</th>
                        <th class="text-center">ชื่อวิชา</th>
                        <th class="text-center">หน่วยกิต</th>
                        <th></th>
                        <th class="text-center">หลักสูตร</th>
                        <th class="text-center" style="width: 100px;">รหัสวิชา</th>
                        <th class="text-center">ชื่อวิชา</th>
                        <th class="text-center">หน่วยกิต</th>
                </thead>
                <tbody>
                    <?php
                        include_once('functions.php');
                        $fetchdata = new DB_con();
                        $sql = $fetchdata->fetchdata_s_match();
                        while ($row = mysqli_fetch_array($sql)) {
                    ?>
                        <tr>
                            <td><?php echo $row['sMatchNum']; ?></td>
                            <td class="text-center"><?php echo $row['courseB_CodeName']; ?></td>
                            <td class="text-center"><?php echo $row['subject_BCode']; ?></td>
                            <td><?php echo $row['subject_BName']; ?></td>
                            <td class="text-center"><?php echo $row['subject_BCredit']; ?></td>
                            <td class="text-center" style="width: 50px;">เทียบ</td>
                            <td class="text-center"><?php echo $row['courseA_CodeName']; ?></td>
                            <td class="text-center"><?php echo $row['subject_ACode']; ?></td>
                            <td><?php echo $row['subject_AName']; ?></td>
                            <td class="text-center"><?php echo $row['subject_ACredit']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js" integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous"></script>
</body>
</html>