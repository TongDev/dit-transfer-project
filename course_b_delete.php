<?php
    include_once('functions.php');

    if (isset($_GET['del'])) {
        $cbID = $_GET['del'];
        $deletedata = new DB_con();
        $sql = $deletedata->delete_b($cbID);

        if ($sql) {
            echo "<script>alert('ลบหลักสูตรเสร็จสิ้น !');</script>";
            echo "<script>window.location.href='course_b.php'</script>";
        }
    }
?>