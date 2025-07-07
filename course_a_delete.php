<?php
    include_once('functions.php');

    if (isset($_GET['del'])) {
        $caID = $_GET['del'];
        $deletedata = new DB_con();
        $sql = $deletedata->delete_a($caID);

        if ($sql) {
            echo "<script>alert('ลบหลักสูตรเสร็จสิ้น !');</script>";
            echo "<script>window.location.href='course_a.php'</script>";
        }
    }
?>