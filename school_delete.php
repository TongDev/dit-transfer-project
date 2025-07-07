<?php
    include_once('functions.php');

    if (isset($_GET['del'])) {
        $schoolNum = $_GET['del'];
        $deletedata = new DB_con();
        $sql = $deletedata->school_delete($schoolNum);

        if ($sql) {
            echo "<script>alert('ลบสถาบันเสร็จสิ้น !');</script>";
            echo "<script>window.location.href='school.php'</script>";
        }
    }
?>