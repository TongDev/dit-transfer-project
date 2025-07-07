<?php
    include_once('functions.php');

    if (isset($_GET['del'])) {
        $ctcID = $_GET['del'];
        $deletedata = new DB_con();
        $sql = $deletedata->delete_ctc($ctcID);

        if ($sql) {
            echo "<script>alert('ลบอาจารย์ประจำหลักสูตรเสร็จสิ้น !');</script>";
            echo "<script>window.location.href='course_teacher.php'</script>";
        }
    }
?>