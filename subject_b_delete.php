<?php
    include_once('functions.php');

    if (isset($_GET['del'])) {
        $sjbID = $_GET['del'];
        $deletedata = new DB_con();
        $sql = $deletedata->delete_b_subject($sjbID);

        if ($sql) {
            echo "<script>alert('รายวิชาเสร็จสิ้น !');</script>";
            echo "<script>window.location.href='subject_b.php'</script>";
        }
    }
?>