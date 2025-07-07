<?php

    include_once('functions.php');

    $regsiter = new DB_con();

    if (isset($_POST['submit'])) {
        $ctcUser = $_POST['ctcUserName'];
        $ctcPass = $_POST['ctcPassword'];
        $ctcName = $_POST['ctcName'];
        $ctcTel = $_POST['ctcTel'];

        $sql = $regsiter->register($ctcUser,$ctcPass,$ctcName,$ctcTel);
        
        if ($sql) {
            echo "<script>alert('สมัครสมาชิกเสร็จสิ้น !');</script>";
            echo "<script>window.location.href='index.php'</script>";
        } else {
            echo "<script>alert('สมัครสมาชิกล้มเหลว !');</script>";
            echo "<script>window.location.href='register.php'</script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก</title>
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
                        <a class="btn btn-light" aria-current="page" href="index.php">หน้าแรก</a>
                    </li>
                    <li class="nav-item">
                        <!-- Dropdown Login -->
                        <div class="dropdown dropleft ml-2">
                            <button class="btn btn-success dropdown-toggle" type="button" id="dropdown-menu" data-toggle="dropdown" aria-expanded="false">เข้าสู่ระบบ</button>
                                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <form class="px-2 py-2">

                                            <div class="mb-3">
                                                <label for="DropdownFormUsername" class="form-label">Username</label>
                                                <input type="text" class="form-control" id="DropdownFormUsername" style="weight">
                                            </div>
                                        
                                            <div class="mb-3">
                                                <label for="DropdownFormPassword" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="DropdownFormPassword" >
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
    <!-- Form register -->
    <div class="container">
        <h1 class="mt-5">สมัครสมาชิก</h1>
        <hr>
        <form action="" method="post">
            <div class="mb-3">
                <label for="ctcUserName" class="form-label">Username</label>
                <input type="text" name="ctcUserName" id="ctcUserName" class="form-control" onblur="checkusername(this.value)" required>
                <span id="usernameavailable"></span>
            </div>
            <div class="mb-3">
                <label for="ctcPassword" class="form-label">Password</label>
                <input type="password" name="ctcPassword" id="ctcPassword" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="ctcName" class="form-label">ชื่อ - นามสกุล</label>
                <input type="text" name="ctcName" id="ctcName" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="ctcTel" class="form-label">เบอร์โทรศัพท์</label>
                <input type="text" name="ctcTel" id="ctcTel" class="form-control" required>
            </div>

            <button type="submit" name="submit" id="submit" class="btn btn-success">Register</button>
            <hr>
        </form>
    </div>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        function checkusername(value) {
            $.ajax({
                type: 'POST',
                url: 'checkuser_available.php',
                data: 'ctcUserName'+value,
                success: function(data) {
                    $('#usernameavailable').html(data);
                }
            });
        }
    </script>
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js" integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous"></script>
</body>
</html>