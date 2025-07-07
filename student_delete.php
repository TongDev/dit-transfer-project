<?php
    include_once('functions.php');

    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $deletedata = new DB_con();
        $sql = $deletedata->student_delete($id);

        if ($sql) {
            echo "<script>alert('ลบนักศึกษาเสร็จสิ้น !');</script>";
            echo "<script>window.location.href='student_show.php'</script>";
        }
    }
?>