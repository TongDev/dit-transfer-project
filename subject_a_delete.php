<?php
    include_once('functions.php');

    if (isset($_GET['del'])) {
        $sjaID = $_GET['del'];
        $deletedata = new DB_con();
        $sql = $deletedata->delete_a_subject($sjaID);

        if ($sql) {
            echo "<script>alert('รายวิชาเสร็จสิ้น !');</script>";
            echo "<script>window.location.href='subject_a.php'</script>";
        }
    }
?>