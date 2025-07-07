<!DOCTYPE html>
<html lang="en">
<body>
<?php
    include_once('functions.php');
    $sjbID = $_GET['sjbID'];
    $sjaID = $_GET['sjaID'];

    //fetch วิชา ป.ตรี ที่เลือก
    $fetch_select_sjbID = new DB_con();
    $sql_sjbID = $fetch_select_sjbID->fetchonerecord_selected_sb($sjbID);
    //fetch วิชา ปวส. ที่เลือกตามหลักสูตร ทั้งหมด
    $fetch_select_sjaID = new DB_con();
    $sql_sjaID = $fetch_select_sjaID->fetchonerecord_selected_sa($sjaID);
?>
<!-- Header -->
<div class="modal-header">
    <h5 class="modal-title">เปรียบเทียบคำอธิบายรายวิชา</h5>
        <button type="button" class="btn-close" data-dismiss="modal"></button>
</div>
<!-- End Header -->

<!-- Body -->
<div class="modal-body">
    <div class="row justify-content-between">
        <!-- ส่วนแสดงรายวิชา ป.ตรี ที่เลือก -->
        <div class="col-6">
        <form action="">
        <?php
            while($row_sjb = mysqli_fetch_array($sql_sjbID)){
        ?>
            <div class="mb-3">
                <label for="subject_BCode" class="form-label">รหัสวิชา</label>
                <input type="text" name="subject_BCode" class="form-control" value="<?php echo $row_sjb['subject_BCode']; ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="subject_BName" class="form-label">รหัสวิชา</label>
                <input type="text" name="subject_BName" class="form-control" value="<?php echo $row_sjb['subject_BName']; ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="subject_BDes" class="form-label">คำอธิบายรายวิชา</label>
                <textarea class="form-control" name="subject_BDes" rows="6" disabled><?php echo $row_sjb['subject_BDes']; ?></textarea>
            </div>
        <?php } ?>
        </form>
        </div>
        <!-- End ส่วนแสดงรายวิชา ป.ตรี ที่เลือก -->
        <div class="col-6">
        <?php
            while ($row_sjaID = mysqli_fetch_array($sql_sjaID)){
        ?>
        <!-- ส่วนแสดงรายวิชา ปวส. ที่เลือก -->
        <form action="">
            <div class="mb-3">
                <label for="subject_ACode" class="form-label">รหัสวิชา</label>
                <input type="text" name="subject_ACode" class="form-control" value="<?php echo $row_sjaID['subject_ACode']; ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="subject_AName" class="form-label">ชื่อวิชา</label>
                <input type="text" name="subject_AName" class="form-control" value="<?php echo $row_sjaID['subject_AName']; ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="subject_ADes" class="form-label">คำอธิบายรายวิชา</label>
                <textarea class="form-control" name="subject_ADes" rows="6" disabled><?php echo $row_sjaID['subject_ADes']; ?></textarea>
            </div>
        <?php } ?>
        </form>
        </div>
        <!-- End ส่วนแสดงรายวิชา ปวส. ที่เลือก -->
    </div>
</div>
<!-- End Body -->

<!-- Footer -->
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">ออก</button>
</div>
<!-- End Footer -->
</body>
</html>