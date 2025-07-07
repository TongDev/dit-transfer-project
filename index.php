<?php
    session_start();
    include_once('functions.php');

    $login = new DB_con();

    if (isset($_POST['login'])) {
        $ctcUser = $_POST['ctcUserName'];
        $ctcPass = $_POST['ctcPassword'];

        $result = $login->login($ctcUser,$ctcPass);
        $num = mysqli_fetch_array($result);
        
        if ($num > 0) {
            $_SESSION['ctcID'] = $num['ctcID'];
            $_SESSION['ctcName'] = $num['ctcName'];
            echo "<script>alert('ลงชื่อเข้าใช้เสร็จสิ้น !');</script>";
            echo "<script>window.location.href='teacher_menu.php'</script>";
        } else {
            echo "<script>alert('ลงชื่อเข้าใช้ล้มเหลว !');</script>";
            echo "<script>window.location.href='index.php'</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแรก</title>
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
                    <!-- Menu -->
                    <li class="nav-item">
                        <a class="btn btn-light" aria-current="page" href="index.php">หน้าหลัก</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger ml-2" aria-current="page" href="index.php">ข้อมูลการเทียบโอน</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-warning ml-2" aria-current="page" href="index.php">คู่มือการใช้งาน</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-secondary ml-2" aria-current="page" href="member.php">ผู้จัดทำ</a>
                    </li>
                    <li class="nav-item">
                        <!-- Dropdown Login -->
                        <div class="dropdown dropleft ml-2">
                            <button class="btn btn-success dropdown-toggle" type="button" id="dropdown-menu" data-toggle="dropdown" aria-expanded="false">เข้าสู่ระบบ</button>
                                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <form class="px-2 py-2" method="post">
                                            <div class="mb-3">
                                                <label for="ctcUserName" class="form-label">Username</label>
                                                <input type="text" class="form-control" name="ctcUserName" id="ctcUserName" style="weight" requrired>
                                            </div>
                                        
                                            <div class="mb-3">
                                                <label for="ctcPassword" class="form-label">Password</label>
                                                <input type="password" class="form-control" name="ctcPassword" id="ctcPassword" requrired>
                                            </div>
                                            <button type="submit" class="btn btn-success" name="login">Login</button>
                                        </form>
                                    </li>
                                </ul>
                        </div>
                    </li>
                </ul>
        </div>
    </nav>

    <div class="container">
        <h1 class="mt-3">ยินดีต้อนรับ, ระบบเทียบโอนรายวิชา สาขาเทคโนโลยีดิจิทัล</h1>
        <hr>
        <div class="container">
            <form action="" method="post" class="row g-2 mb-3">
                <div class="col-4">
                    <input class="form-control" type="search" name="search" placeholder="ค้นหานักศึกษา. . ." aria-label="Search">
                </div>
                <div class="col-auto">
                <select name="column" class="form-select">
                    <option selected>Select Filter</option>
                    <option value="transcript_ID">#</option>
                    <option value="student_ID">รหัสนักศึกษา</option>
                    <option value="student_F_Name">ชื่อ</option>
                    <option value="student_L_Name">นามสกุล</option>
                    <option value="schoolNum">สถาบัน</option>
                    <option value="graduateYear">ปีที่จบการศึกษา</option>
                </select>
                </div>
                <div class="col-auto">
                <button class="btn btn-outline-success"" type="submit" name="search">ค้นหา</button>
                </div>
            </form>
        </div>
    </div>

    <div class="container">
        <table class="table table-bordered table-striped table-light">
                <thead class="text-center">
                    <th style="width: 30px">#</th>
                    <th style="width: 115px">รหัสนักศึกษา</th>
                    <th style="width: 250px">ชื่อ-นามสกุล</th>
                    <th style="width: 250px">สถาบัน</th>
                    <th style="width: 120px">ปีจบการศึกษา</th>
                    <th style="width: 180px">หน่วยกิตที่เทียบได้</th>
                    <th style="width: 180px">หน่วยกิตที่เหลือ</th>
                </thead>

                <tbody>
                    <?php
                        $fetchdata = new DB_con();
                        $sql = $fetchdata->fetchdata_student();
                        while ($row = mysqli_fetch_array($sql)) {
                    ?>
                        <tr>
                            <td><?php echo $row['transcript_ID']; ?></td>
                            <td><?php echo $row['student_ID']; ?></td>
                            <td><?php echo $row['student_T_Name']; ?> <?php echo $row['student_F_Name']; ?> <?php echo $row['student_L_Name']; ?></td>
                            <td class="text-center"><?php echo $row['schoolName']; ?></td>
                            <td class="text-center"><?php echo $row['graduateYear']; ?></td>
                            <?php
                                $id = $row['transcript_ID'];
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
                            <td class="text-center"><?php echo $sum ?></td>
                            <td class="text-center"><?php echo $result ?></td>
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