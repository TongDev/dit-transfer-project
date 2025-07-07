<?php
    session_start();

    if ($_SESSION['ctcID'] == "") {
        header("location: index.php");
    } else {

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการข้อมูล</title>
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

                    <!--<li class="nav-item">
                        <a class="btn btn-success" aria-current="page" href="index.php">หน้าแรก</a>
                    </li>-->

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

    <div class="container">
        <h1 class="mt-2">ยินดีต้อนรับ, <?php echo $_SESSION['ctcName']; ?></h1>
        <hr>
    </div>

    <div class="container">
        <div class="row justify-content-between pl-5 mb-3">
            <div class="col-4">
                <div class="card text-center" style="width: 12rem;">
                    <a href="modal_course" data-toggle="modal" data-target="#modal_course">
                    <img src="img/course.png" class="card-img-top">
                    <div class="card-body">
                        <label>จัดการหลักสูตร</label>
                    </div>
                    </a>
                </div>
            </div>

            <div class="col-4">
                <div class="card text-center" style="width: 12rem;">
                    <a href="school.php">
                    <img src="img/school.png" class="card-img-top">
                    <div class="card-body">
                        <label>จัดการสถาบัน</label>
                    </div>
                    </a>
                </div>
            </div>

            <div class="col-4">
                <div class="card text-center" style="width: 12rem;">
                    <a href="course_teacher.php">
                    <img src="img/teacher.png" class="card-img-top">
                    <div class="card-body">
                        <label>อาจารย์ประจำหลักสูตร</label>
                    </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="row justify-content-between pl-5">
            <div class="col-4">
                <div class="card text-center" style="width: 12rem;">
                    <a href="modal_subject" data-toggle="modal" data-target="#modal_subject">
                    <img src="img/subject.png" class="card-img-top">
                    <div class="card-body">
                        <label>จัดการข้อมูลรายวิชา</label>
                    </div>
                    </a>
                </div>
            </div>

            <div class="col-4">
                <div class="card text-center" style="width: 12rem;">
                    <a href="s_match_show.php">
                    <img src="img/match.png" class="card-img-top">
                    <div class="card-body">
                        <label>จับคู่เทียบโอน</label>
                    </div>
                    </a>
                </div>
            </div>

            <div class="col-4">
                <div class="card text-center" style="width: 12rem;">
                    <a href="student_show.php">
                    <img src="img/student.png" class="card-img-top">
                    <div class="card-body">
                        <label>จัดการข้อมูลนักศึกษา</label>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal_course" tabindex="-1" aria-labelledby="courselabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="courselabel">เลือกหลักสูตร</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-between">
                        <div class="col-6">
                            <div class="card text-center" style="width: 12rem;">
                                <a href="course_b.php">
                                <img src="img/bcl.png" class="card-img-top">
                                <div class="card-body">
                                    <label>ปริญญาตรี</label>
                                </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card text-center" style="width: 12rem;">
                                <a href="course_a.php">
                                <img src="img/avp.png" class="card-img-top">
                                <div class="card-body">
                                    <label>ประกาศนียบัตรชั้นสูง</label>
                                </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal_subject" tabindex="-1" aria-labelledby="subjectlabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="subjectlabel">เลือกรายวิชา</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-between">
                        <div class="col-6">
                            <div class="card text-center" style="width: 12rem;">
                                <a href="subject_b.php">
                                <img src="img/bcl.png" class="card-img-top">
                                <div class="card-body">
                                    <label>ปริญญาตรี</label>
                                </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card text-center" style="width: 12rem;">
                                <a href="subject_a.php">
                                <img src="img/avp.png" class="card-img-top">
                                <div class="card-body">
                                    <label>ประกาศนียบัตรชั้นสูง</label>
                                </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js" integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous"></script>
</body>
</html>
<?php
    }
?>