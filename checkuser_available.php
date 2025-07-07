<?php
    include_once('functions.php');
    $checkusername = new DB_con();

    //รับค่า POST จาก val
    $ctcUserName = $_POST['ctcUserName'];

    $sql = $checkusername->usernameavailable($ctcUserName);

    $num = mysqli_num_rows($sql);

    if ($num > 0) {
        echo "<span style='color: red;'>มี Username นี้อยู่ในระบบอยู่แล้ว !.</span>";
        echo "<script>$('#submit').porp('disabled', ture);</script>";
    } else {
        echo "<span style='color: green;'>สามารถใช้ Username นี้ได้ !.</span>";
        echo "<script>$('#submit').porp('disabled', false);</script>";
    }
?>