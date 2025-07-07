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
        <h1 class="mt-3">ผู้จัดทำ</h1>
        <hr>
        <div class="container text-center">
            <h3>ผู้จัดทำ</h3>
            <hr>
            <p>1. นาย ปานเพชร อยู่ศิริ</p>
            <p>2. นางสาว วรรณภา วิชาชัย</p>
            <hr>
            <h3>อาจารย์ที่ปรึกษาหลัก</h3>
            <p>อาจารย์ณภัทรวรัญญ์ ศรีฮาตร</p>
            <hr>
            <h3>อาจารย์ที่ปรึกษาร่วม</h3>
            <p>1.อาจารย์ ดร.ธรรมรัตน์ บุญรอด</p>
            <p>2.อาจารย์สิริอร วงษ์ทวี</p>
            <p>3.อาจารย์บัญชา เหลือผล</p>
            
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js" integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous"></script>
</body>
</html>