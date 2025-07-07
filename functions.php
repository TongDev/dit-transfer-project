<?php

    define('DB_SERVER','localhost');
    define('DB_USER','root');
    define('DB_PASS','');
    define('DB_NAME','dit_tsf');

    class DB_con{
        function __construct() {
            $conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
            $this->dbcon = $conn;

            if (mysqli_connect_errno()) {
                echo "การเชื่อมต่อ SQL ล้มเหลว : " . mysqli_connect_error();
            }
        }
        /* -------------------------------------- ส่วน Admin --------------------------------------------------------- */
        //สมัครสมาชิก !
        /*public function register($ctcUser,$ctcPass,$ctcName,$ctcTel){
            $result = mysqli_query($this->dbcon, "INSERT INTO tbl_courseteacher(ctcUserName,ctcPassword,ctcName,ctcTel) VALUES ('$ctcUser','$ctcPass','$ctcName','$ctcTel')");
            return $result;
        }*/
        //เช็ค Username ว่าซ้ำมั้ย !
        public function usernameavailable($ctcUserName){
            $checkuser = mysqli_query($this->dbcon, "SELECT ctcUserName FROM tbl_courseteacher WHERE ctcUserName = '$ctcUserName'");
            return $checkuser;
        }
        //Query user
        public function fetchdata_ctc(){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tbl_courseteacher");
            return $result ;
        }
        //เพิ่ม user
        public function insert_teacher($ctcUser,$ctcPass,$ctcName,$ctcTel){
            $result = mysqli_query($this->dbcon, "INSERT INTO tbl_courseteacher(ctcUserName,ctcPassword,ctcName,ctcTel) VALUES ('$ctcUser','$ctcPass','$ctcName','$ctcTel')");
            return $result;
        }
        //fetch record เดียวเพื่อแสดง user
        public function fetchonerecord_ctc($ctcID){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tbl_courseteacher WHERE ctcID = '$ctcID'");
            return $result;
        }
        //แก้ไข user ที่เลือก
        public function update_ctc($ctcID,$ctcUserName,$ctcPassword,$ctcName,$ctcTel){
            $result = mysqli_query($this->dbcon, "UPDATE tbl_courseteacher SET
                ctcUsername = '$ctcUserName',
                ctcPassword = '$ctcPassword',
                ctcName = '$ctcName',
                ctcTel = '$ctcTel'
                WHERE ctcID = '$ctcID'
            ");
            return $result;
        }
        //ลบผู้ใช้งาน
        public function delete_ctc($ctcID){
            $result = mysqli_query($this->dbcon, "DELETE FROM tbl_courseteacher WHERE ctcID = '$ctcID'");
            return $result;
        }
        //ลงชื่อเข้าใช้ (login)
        public function login($ctcUser,$ctcPass){
            $loginquery = mysqli_query($this->dbcon, "SELECT ctcID,ctcName FROM tbl_courseteacher WHERE ctcUserName = '$ctcUser' AND ctcPassword = '$ctcPass'");
            return $loginquery;
        }
        /** --------------------------------------ส่วนหลักสูตร ป.ตรี----------------------------------------------------- */
        //Query หลักสูตร ป.ตรี
        public function fetchdata_bcl(){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tbl_bcl");
            return $result ;
        }
        //fetch record เดียวเพื่อแก้ไขข้อมูล ป.ตรี
        public function fetchonerecord_b($cbID){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tbl_bcl WHERE courseB_ID = '$cbID'");
            return $result;
        }     
        //แสดงข้อมูลเดิมของ Record และทำการแก้ไข ป.ตรี
        public function update_b($cbID,$cbcName,$cbName,$bName,$cbImprove,$cbCredit){
            $result = mysqli_query($this->dbcon, "UPDATE tbl_bcl SET
                courseB_CodeName = '$cbcName',
                courseB_Name = '$cbName',
                branchB_Name = '$bName',
                courseB_Improve = '$cbImprove',
                courseB_Credit = '$cbCredit'
                WHERE courseB_ID = '$cbID'
            ");
            return $result;
        }
        //เพิ่มข้อมูลหลักสูตร ป.ตรี
        public function insert_b($cbcName,$cbName,$bbName,$cbImprove,$cbCredit){
            $result = mysqli_query($this->dbcon, "INSERT INTO tbl_bcl(courseB_CodeName,courseB_Name,branchB_Name,courseB_Improve,courseB_Credit) VALUES ('$cbcName','$cbName','$bbName','$cbImprove','$cbCredit')");
            return $result;
        }
        //ลบข้อมูลหลักสูตร ป.ตรี
        public function delete_b($cbID) {
            $deleterecord = mysqli_query($this->dbcon, "DELETE FROM tbl_bcl WHERE courseB_ID = '$cbID'");
            return $deleterecord ; 
        }
        //เช็ค Code Name
        public function check_codename_b($cbcName){
            $result = mysqli_query($this->dbcon, "SELECT courseB_CodeName FROM tbl_bcl WHERE courseB_CodeName = '$cbcName'");
            return $result ;
        }

        /** --------------------------------------ส่วนหลักสูตร ปวส.------------------------------------------------------ */
        //Query หลักสูตร ปวส.
        public function fetchdata_avp(){
            $result = mysqli_query($this->dbcon, "SELECT courseA_ID, courseA_CodeName,courseA_Name,branchA_Name,courseA_Improve,courseA_Credit,tbl_avp.schoolNum,schoolName FROM tbl_avp,tbl_school WHERE tbl_avp.schoolNum = tbl_school.schoolNum");
            return $result ;
        }
        //fetch record เดียวเพื่อแก้ไขข้อมูล ปวส.
        public function fetchonerecord_a($caID){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tbl_avp WHERE courseA_ID = '$caID'");
            return $result;
        }
        //แสดงข้อมูลเดิมของ Record และทำการแก้ไข ปวส.
        public function update_a($caID,$cacName,$caName,$bName,$caImprove,$caCredit,$scNum){
            $result = mysqli_query($this->dbcon, "UPDATE tbl_avp SET
                courseA_CodeName = '$cacName',
                courseA_Name = '$caName',
                branchA_Name = '$bName',
                courseA_Improve = '$caImprove',
                courseA_Credit = '$caCredit',
                schoolNum = '$scNum'
                WHERE courseA_ID = '$caID'
            ");
            return $result;
        }
        //เพิ่มข้อมูลหลักสูตร ปวส.
        public function insert_a($cacName,$caName,$baName,$caImprove,$caCredit,$scNum){
            $result = mysqli_query($this->dbcon, "INSERT INTO tbl_avp(courseA_CodeName,courseA_Name,branchA_Name,courseA_Improve,courseA_Credit,schoolNum) VALUES ('$cacName','$caName','$baName','$caImprove','$caCredit','$scNum')");
            return $result;
        }
        //fetch Select school
        public function fetchselect_school(){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tbl_school");
            return $result;
        }
        //ลบข้อมูลหลักสูตร ปวส.
        public function delete_a($caID) {
            $deleterecord = mysqli_query($this->dbcon, "DELETE FROM tbl_avp WHERE courseA_ID = '$caID'");
            return $deleterecord ; 
        }
        //เช็ค Code Name
        public function check_codename_a($cacName){
            $result = mysqli_query($this->dbcon, "SELECT courseA_CodeName FROM tbl_avp WHERE courseA_CodeName = '$cacName'");
            return $result ;
        }
        /** --------------------------------------ส่วนวิชา ป.ตรี--------------------------------------------------------- */
        //Query รายวิชา ป.ตรี
        public function fetchdata_b_subject(){
            $result = mysqli_query($this->dbcon, "SELECT 
            subject_BID,subject_BCode,subject_BName,subject_BCredit,subject_BDes,tblb_subject.sgID,sgName,tblb_subject.categoryID,categoryName,categorySID,tblb_subject.courseB_ID,courseB_CodeName,courseB_Name
            FROM tblb_subject,tbl_sg,tbl_category,tbl_bcl 
            WHERE subject_BID AND
            tblb_subject.sgID = tbl_sg.sgID AND
            tblb_subject.categoryID = tbl_category.categoryID AND
            tblb_subject.courseB_ID = tbl_bcl.courseB_ID
            ORDER BY subject_BID ASC");
            return $result ;
        }
        //fetch Select bcl
        public function fetchselect_b(){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tbl_bcl");
            return $result;
        }
        //fetch Select category
        public function fetchselect_cat(){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tbl_category");
            return $result;
        }
        //fetch Select sg
        public function fetchselect_sg(){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tbl_sg");
            return $result;
        }
        //เพิ่มรายวิชาหลักสูตร ป.ตรี
        public function insert_b_subject($sjbCode,$sjbName,$sjbCredit,$sjbDes,$sgID,$catID,$cbID){
            $result = mysqli_query($this->dbcon, "INSERT INTO tblb_subject(subject_BCode,subject_BName,subject_BCredit,subject_BDes,sgID,categoryID,courseB_ID) VALUES ('$sjbCode','$sjbName','$sjbCredit','$sjbDes','$sgID','$catID','$cbID')");
            return $result;
        }
        //fetch record เดียวเพื่อแก้ไขข้อมูล รายวิชา ป.ตรี 
        public function fetchonerecord_b_subject($sjbID){
            $result = mysqli_query($this->dbcon, "SELECT subject_BID,subject_BCode,subject_BName,subject_BCredit,subject_BDes,tblb_subject.courseB_ID,courseB_CodeName,tblb_subject.categoryID,categoryName,categorySID,tblb_subject.sgID,sgName,sgSID 
            FROM tblb_subject,tbl_bcl,tbl_category,tbl_sg WHERE subject_BID = '$sjbID' AND tblb_subject.courseB_ID = tbl_bcl.courseB_ID AND tblb_subject.categoryID = tbl_category.categoryID AND tblb_subject.sgID = tbl_sg.sgID");
            return $result;
        }
        //แสดงข้อมูลเดิมของ Record และทำการแก้ไข รายวิชา ป.ตรี
        public function update_b_subject($sjbID,$sjbCode,$sjbName,$sjbCredit,$sjbDes,$sgID,$catID,$cbID){
            $result = mysqli_query($this->dbcon, "UPDATE tblb_subject SET
                subject_BCode = '$sjbCode',
                subject_BName = '$sjbName',
                subject_BCredit = '$sjbCredit',
                subject_BDes = '$sjbDes',
                sgID = '$sgID',
                categoryID = '$catID',
                courseB_ID = '$cbID'
                WHERE subject_BID = '$sjbID'
            ");
            return $result;
        }
        //ลบข้อมูลหลักสูตร ปวส.
        public function delete_b_subject($sjbID) {
            $deleterecord = mysqli_query($this->dbcon, "DELETE FROM tblb_subject WHERE subject_BID = '$sjbID'");
            return $deleterecord ;       
        }
        //เช็ค Code Subject
        public function check_sjbCode($sjbCode){
            $result = mysqli_query($this->dbcon, "SELECT subject_BCode FROM tblb_subject WHERE subject_BCode = '$sjbCode'");
            return $result ;
        }
        //ค้นหารายวิชา ป.ตรี
        public function search_sb($search_b){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tblb_subject WHERE subject_BName like '%$search_b%'");
            return $result;
        }
        //Query รายวิชา ป.ตรี ที่ค้นหา
        public function fetchdata_sb_search($sjbName){
            $result = mysqli_query($this->dbcon, "SELECT 
            subject_BID,subject_BCode,subject_BName,subject_BCredit,subject_BDes,tblb_subject.sgID,sgName,tblb_subject.categoryID,categoryName,categorySID,tblb_subject.courseB_ID,courseB_CodeName,courseB_Name
            FROM tblb_subject,tbl_sg,tbl_category,tbl_bcl 
            WHERE subject_BID LIKE '$sjbName' AND
            tblb_subject.sgID = tbl_sg.sgID AND
            tblb_subject.categoryID = tbl_category.categoryID AND
            tblb_subject.courseB_ID = tbl_bcl.courseB_ID
            ORDER BY subject_BID ASC");
            return $result ;
        }
        /** --------------------------------------ส่วนวิชา ปวส.---------------------------------------------------------- */
        //Query รายวิชา ปวส.
        public function fetchdata_a_subject(){
            $result = mysqli_query($this->dbcon, "SELECT subject_AID,subject_ACode,subject_AName,subject_ACredit,subject_ADes,tbla_subject.courseA_ID,tbl_avp.courseA_ID,tbl_avp.schoolNum,schoolName,courseA_CodeName
            FROM tbla_subject,tbl_avp,tbl_school
            WHERE tbla_subject.courseA_ID = tbl_avp.courseA_ID AND
            tbl_avp.schoolNum = tbl_school.schoolNum
            ORDER BY subject_AID ASC");
            return $result;
        }
        //fetch Select avp
        public function fetchselect_a(){
            $result = mysqli_query($this->dbcon, "SELECT tbl_avp.courseA_ID,tbl_avp.courseA_CodeName,tbl_avp.courseA_Name,tbl_avp.branchA_Name,tbl_avp.courseA_Improve,tbl_avp.courseA_Credit,tbl_avp.schoolNum,schoolName
            FROM tbl_avp , tbl_school
            WHERE tbl_avp.schoolNum = tbl_school.schoolNum");
            return $result;
        }
        //เพิ่มรายวิชาหลักสูตร ปวส.
        public function insert_a_subject($sjaCode,$sjaName,$sjaCredit,$sjaDes,$caID){
            $result = mysqli_query($this->dbcon, "INSERT INTO tbla_subject(subject_ACode,subject_AName,subject_ACredit,subject_ADes,courseA_ID) VALUES ('$sjaCode','$sjaName','$sjaCredit','$sjaDes','$caID')");
            return $result;
        }
        //fetch record เดียวเพื่อแก้ไขข้อมูล รายวิชา ปวส.
        public function fetchonerecord_a_subject($sjaID){
            $result = mysqli_query($this->dbcon, "SELECT subject_ACode,subject_AName,subject_ACredit,subject_ADes,tbla_subject.courseA_ID,courseA_CodeName 
            FROM tbla_subject,tbl_avp WHERE subject_AID = '$sjaID' AND tbla_subject.courseA_ID = tbl_avp.courseA_ID");
            return $result;
        }
        //fetch record เดียวเพื่อแสดงข้อมูล รายวิชา ปวส.
        public function fetchone_getAID($get_sa){
            $result = mysqli_query($this->dbcon, "SELECT subject_ACode,subject_AName,subject_ACredit,subject_ADes
            FROM tbla_subject WHERE subject_AID = '$get_sa'");
            return $result;
        }
        //แสดงข้อมูลเดิมของ Record และทำการแก้ไข รายวิชา ปวส.
        public function update_a_subject($sjaID,$sjaCode,$sjaName,$sjaCredit,$sjaDes,$caID){
            $result = mysqli_query($this->dbcon, "UPDATE tbla_subject SET
                subject_ACode = '$sjaCode',
                subject_AName = '$sjaName',
                subject_ACredit = '$sjaCredit',
                subject_ADes = '$sjaDes',
                courseA_ID = '$caID'
                WHERE subject_AID = '$sjaID'
            ");
            return $result;
        }
        public function delete_a_subject($sjaID) {
            $deleterecord = mysqli_query($this->dbcon, "DELETE FROM tbla_subject WHERE subject_AID = '$sjaID'");
            return $deleterecord ;       
        }
        //เช็ค Code Subject
        public function check_sjaCode($sjaCode){
            $result = mysqli_query($this->dbcon, "SELECT subject_ACode FROM tbla_subject WHERE subject_ACode = '$sjaCode'");
            return $result ;
        }
        //ค้นหารายวิชา ปวส.
        public function search_sa($search_a){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tbla_subject WHERE subject_AName like '%$search_a%'");
            return $result;
        }
        /** --------------------------------------ส่วน สถาบัน---------------------------------------------------------- */
        //Query สถาบัน
        public function fetchdata_school(){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tbl_school");
            return $result;
        }
        //เพิ่มสถาบัน
        public function insert_school($schoolID,$schoolName){
            $result = mysqli_query($this->dbcon, "INSERT INTO tbl_school(schoolID,schoolName) VALUES ('$schoolID','$schoolName')");
            return $result;
        }
        //fetch record เดียวเพื่อแก้ไขข้อมูล สถาบัน
        public function fetchonerecord_school($schoolNum){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tbl_school WHERE schoolNum = '$schoolNum'");
            return $result;
        }
        //แสดงข้อมูลเดิมของ Record และทำการแก้ไข สถาบัน
        public function school_update($schoolNum,$schoolID,$schoolName){
            $result = mysqli_query($this->dbcon, "UPDATE tbl_school SET
                schoolID = '$schoolID',
                schoolName = '$schoolName'
                WHERE schoolNum = '$schoolNum'
            ");
            return $result;
        }
        public function school_delete($schoolNum) {
            $deleterecord = mysqli_query($this->dbcon, "DELETE FROM tbl_school WHERE schoolNum = '$schoolNum'");
            return $deleterecord ;       
        }
        //เช็ค School Name
        public function check_schoolname($schoolName){
            $result = mysqli_query($this->dbcon, "SELECT schoolName FROM tbl_school WHERE schoolName = '$schoolName'");
            return $result ;
        }
        /* -------------------------------------- ส่วน Admin --------------------------------------------------------- */
        //เช็ค Username
        public function check_username($ctcUser){
            $result = mysqli_query($this->dbcon, "SELECT ctcUserName FROM tbl_courseteacher WHERE ctcUserName = '$ctcUser'");
            return $result ;
        }
        /* -------------------------------------- ส่วน s_match_detail ------------------------------------------------------ */
        //Query subject match
        public function fetchdata_s_match(){
            $result = mysqli_query($this->dbcon, "SELECT sMatchNum,tbl_s_match.subject_BID,subject_BCode,subject_BName,subject_BCredit,tblb_subject.courseB_ID,courseB_CodeName,
            tbl_s_match.subject_AID,subject_ACode,subject_AName,subject_ACredit,tbla_subject.courseA_ID,courseA_CodeName
            FROM tbl_s_match,tblb_subject,tbla_subject,tbl_bcl,tbl_avp
            WHERE tbl_s_match.subject_BID = tblb_subject.subject_BID AND tblb_subject.courseB_ID = tbl_bcl.courseB_ID AND tbl_s_match.subject_AID = tbla_subject.subject_AID AND tbla_subject.courseA_ID = tbl_avp.courseA_ID
            ORDER BY sMatchNum ASC");
            return $result;
        }
        //Query BCL AND AVP = Match
        public function fetchdata_b_and_a($cbID,$caID){
            $result = mysqli_query($this->dbcon, "SELECT tbl_bcl.courseB_ID,courseB_CodeName,branchB_Name,tbl_avp.courseA_ID,tbl_avp.courseA_CodeName,tbl_avp.branchA_Name
            FROM tbl_bcl,tbl_avp WHERE tbl_bcl.courseB_ID = '$cbID' AND tbl_avp.courseA_ID = '$caID'");
            return $result;
        }
        //Query รายวิชา ป.ตรี ที่เลือกจากหลักสูตร
        public function fetchdata_select_bcl($cbID){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tblb_subject WHERE courseB_ID = '$cbID'");
            return $result ;
        }
        //Query รายวิชา ปวส. ที่มีการจับคู่ไว้แล้ว
        public function fetchdata_all_matched_subject($r1,$cbID,$caID){
            $result = mysqli_query($this->dbcon, "SELECT
            tbl_s_match.sMatchNum ,
            tbl_s_match.subject_BID ,
            tblb_subject.subject_BCode ,
            tblb_subject.subject_BName ,
            tblb_subject.subject_BCredit ,
            tblb_subject.courseB_ID ,
            tbl_s_match.subject_AID ,
            tbla_subject.subject_ACode ,
            tbla_subject.subject_AName ,
            tbla_subject.subject_ACredit ,
            tbla_subject.courseA_ID
            FROM tbl_s_match , tblb_subject , tbla_subject , tbl_bcl , tbl_avp
            WHERE
            tbl_s_match.subject_BID = '$r1' AND
            tblb_subject.courseB_ID = '$cbID' AND
            tbla_subject.courseA_ID = '$caID' AND
            tbl_s_match.subject_BID = tblb_subject.subject_BID AND
            tbl_s_match.subject_AID = tbla_subject.subject_AID AND
            tblb_subject.courseB_ID = tbl_bcl.courseB_ID AND
            tbla_subject.courseA_ID = tbl_avp.courseA_ID
            ORDER BY tbl_s_match.sMatchNum ASC");
            return $result;
            
        }
        //Query รายวิชา ป.ตรี ที่ทั้งจับคู่หรือไม่จับคู่ และ Query รายวิชา ปวส. ที่จับคู่แล้ว
        public function fetchdata_matct_all($cbID,$caID){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tblb_subject WHERE courseB_ID = '$cbID'");
            return $result ;
        }
        //fetch record เดียวเพื่อแสดงข้อมูล รายวิชา ป.ตรี ที่เลือก
        public function fetchonerecord_selected_sb($sjbID){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tblb_subject WHERE subject_BID = '$sjbID'");
            return $result;
        }
        //fetch record เดียวเพื่อแสดงข้อมูล รายวิชา ปวส. ที่เลือก
        public function fetchonerecord_selected_sa($sjaID){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tbla_subject WHERE subject_AID = '$sjaID'");
            return $result;
        }
        //fetch record เดียวเพื่อแสดงข้อมูล รายวิชา ปวส. ทั้งหมดใน หลักสูตรที่เลือก
        public function fetch_selected_sa($caID){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tbla_subject WHERE courseA_ID = '$caID'");
            return $result;
        }
        public function insert_sj_match($sjbID,$sjaID){
            $result = mysqli_query($this->dbcon , "INSERT INTO tbl_s_match(subject_BID,subject_AID) VALUE ('$sjbID','$sjaID')");
            return $result;
        }
        public function fetch_s_match($sjbID){
            $result = mysqli_query($this->dbcon , "SELECT tbl_s_match.sMatchNum , tbl_s_match.subject_BID , subject_BCode , subject_BName , tbl_s_match.subject_AID , subject_ACode , subject_AName , subject_ACredit
            FROM tbl_s_match , tblb_subject , tbla_subject
            WHERE tbl_s_match.subject_BID = '$sjbID' AND tbl_s_match.subject_BID = tblb_subject.subject_BID AND tbl_s_match.subject_AID = tbla_subject.subject_AID");
            return $result;
        }
        public function fetch_all_matched(){
            $result = mysqli_query($this->dbcon , "SELECT * FROM tbl_s_match");
            return $result;
        }
        public function checkID($raID,$rbID){
            $result = mysqli_query($this->dbcon , "SELECT subject_AID FROM tbl_s_match WHERE subject_AID='$raID' AND subject_BID='$rbID'");
            return $result;
        }
        public function check_saID($raID){
            $result = mysqli_query($this->dbcon , "SELECT subject_AID FROM tbl_s_match WHERE subject_AID='$raID'");
            return $result;
        }
        public function chk_del($sjbID,$sjaID){
            $result = mysqli_query($this->dbcon, "SELECT sMatchNum , subject_BID , subject_AID FROM tbl_s_match WHERE subject_BID = '$sjbID' AND subject_AID = '$sjaID'");
            return $result ;
        }
        public function delete_check($sjbID,$sjaID){
            $deleterecord = mysqli_query($this->dbcon, "DELETE FROM tbl_s_match WHERE subject_BID = '$sjbID' AND subject_AID = '$sjaID'");
            return $deleterecord ;
        }
        public function select_matched(){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tbl_s_match");
            return $result ;
        }
        /* -------------------------------------- ส่วน Transcript --------------------------------------------------------- */
        public function fetchdata_student(){
            $result = mysqli_query($this->dbcon, "SELECT transcript_ID,student_ID,student_T_Name,student_F_Name,student_L_Name,student_ET_Name,student_EF_Name,student_EL_Name,tbl_school.schoolNum,schoolName,courseA_ID,graduateYear,creditsStudied,creditsEarned,stdCredit
            FROM tbl_school , tbl_student
            WHERE tbl_student.schoolNum = tbl_school.schoolNum");
            return $result ;
        }
        public function chk_school($std_aid){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tbl_avp WHERE courseA_ID = '$std_aid'");
            return $result ;
        }
        //เช็ค ชื่อ สกุล ซ้ำ
        public function check_student($std_fn,$std_ln){
            $result = mysqli_query($this->dbcon, "SELECT student_F_Name, student_L_Name FROM tbl_student WHERE student_F_Name = '$std_fn' AND student_L_Name = '$std_ln'");
            return $result ;
        }
        //เช็ค รหัส ซ้ำ
        public function check_student_id($std_id){
            $result = mysqli_query($this->dbcon, "SELECT transcript_ID FROM tbl_student WHERE transcript_ID = '$std_id'");
            return $result ;
        }
        //เพิ่ม นศ.
        public function insert_student($std_id,$std_tt,$std_fn,$std_ln,$std_te,$std_fne,$std_lne,$std_sch,$std_aid,$std_gdy,$std_cs,$std_ce,$std_cre){
            $result = mysqli_query($this->dbcon, "INSERT INTO tbl_student(student_ID,student_T_Name,student_F_Name,	student_L_Name,student_ET_Name,student_EF_Name,student_EL_Name,schoolNum,courseA_ID,graduateYear,creditsStudied,creditsEarned,stdCredit) VALUES ('$std_id','$std_tt','$std_fn','$std_ln','$std_te','$std_fne','$std_lne','$std_sch','$std_aid','$std_gdy','$std_cs','$std_ce','$std_cre')");
            return $result;
        }
        //fetch record เดียวเพื่อแก้ไขข้อมูล สถาบัน
        public function fetchonerecord_student($id){
            $result = mysqli_query($this->dbcon, "SELECT transcript_ID,student_ID,student_T_Name,student_F_Name,student_L_Name,student_ET_Name,student_EF_Name,student_EL_Name,tbl_student.schoolNum,schoolName,tbl_student.courseA_ID,courseA_CodeName,branchA_Name,graduateYear,creditsStudied,creditsEarned,stdCredit,schoolID,courseA_Name FROM tbl_student , tbl_school , tbl_avp WHERE transcript_ID = '$id' AND tbl_student.schoolNum = tbl_school.schoolNum AND tbl_student.courseA_ID = tbl_avp.courseA_ID");
            return $result;
        }
        public function update_student($std_id,$std_tt,$std_fn,$std_ln,$std_te,$std_fne,$std_lne,$std_sch,$std_aid,$std_gdy,$std_cs,$std_ce,$std_cre,$id){
            $result = mysqli_query($this->dbcon, "UPDATE tbl_student SET student_ID = '$std_id',student_T_Name = '$std_tt',student_F_Name = '$std_fn',	student_L_Name = '$std_ln',student_ET_Name='$std_te',student_EF_Name='$std_fne',student_EL_Name='$std_lne',schoolNum='$std_sch',courseA_ID='$std_aid',graduateYear='$std_gdy',creditsStudied='$std_cs',creditsEarned='$std_ce',stdCredit='$std_cre' WHERE transcript_ID = '$id'");
            return $result;
        }
        public function student_delete($id){
            $deleterecord = mysqli_query($this->dbcon, "DELETE FROM tbl_student WHERE transcript_ID = '$id'");
            return $deleterecord ;       
        }
        /*--------------------------------------------------- index ----------------------------------------------------------*/
        public function index_search($column,$searchdata){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tbl_student WHERE $column LIKE '$searchdata'");
            return $result ;
        }
        /*--------------------------------------------------- transfer -------------------------------------------------------*/
        public function grade($caid){
            $result = mysqli_query($this->dbcon, "SELECT subject_AID,subject_ACode,subject_AName,subject_ACredit,tbla_subject.courseA_ID,courseA_CodeName
            FROM tbla_subject , tbl_avp
            WHERE tbl_avp.courseA_ID = '$caid' AND tbla_subject.courseA_ID = tbl_avp.courseA_ID");
            return $result ;
        }
        public function check_a_course($ca_id){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tbl_avp WHERE courseA_ID = '$ca_id'");
            return $result ;
        }
        public function insert_grade($std_id,$ca_id,$s,$g,$sm_num,$sm_cre){
            $result = mysqli_query($this->dbcon, "INSERT INTO tbl_grade(transcript_ID,courseA_ID,subject_AID,subjectGrade,sMatchNum,matchCredit) VALUE ('$std_id','$ca_id','$s','$g','$sm_num','$sm_cre')");
            return $result ;
        }
        public function chk_matched($s){
            $result = mysqli_query($this->dbcon, "SELECT tbl_s_match.sMatchNum , tbl_s_match.subject_BID , tbl_s_match.subject_AID , subject_ACredit FROM tbl_s_match , tbla_subject WHERE tbl_s_match.subject_AID = '$s' AND tbl_s_match.subject_AID = tbla_subject.subject_AID");
            return $result ;
        }
        public function chk_sm($s){
            $result = mysqli_query($this->dbcon, "SELECT tbl_s_match.sMatchNum , tbl_s_match.subject_BID , tbl_s_match.subject_AID , subject_ACredit FROM tbl_s_match , tbla_subject WHERE tbl_s_match.subject_AID = '34' AND tbl_s_match.subject_AID = tbla_subject.subject_AID");
            return $result;
        }
        public function grade_all(){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tbl_s_match");
            return $result;
        }
        public function chk_grade($sj_aid){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tbl_grade WHERE subject_AID = '$sj_aid'");
            return $result;
        }
        public function showdata($ca_id){
            $result = mysqli_query($this->dbcon, "SELECT tbl_s_match.sMatchNum , tbl_s_match.subject_BID , tbl_s_match.subject_AID , courseA_ID , courseB_ID
            FROM tbl_s_match , tbla_subject , tblb_subject
            WHERE courseA_ID = '$ca_id' AND tbl_s_match.subject_BID = tblb_subject.subject_BID AND tbl_s_match.subject_AID = tbla_subject.subject_AID");
            return $result;
        }
        public function fetch_data_b($cb_id){
            $result = mysqli_query($this->dbcon, "SELECT tblb_subject.subject_BID,tblb_subject.subject_BCode,tblb_subject.subject_BName,tblb_subject.subject_BCredit,tblb_subject.subject_BDes,tblb_subject.sgID, sgName ,tblb_subject.categoryID, categoryName ,tblb_subject.courseB_ID FROM tblb_subject , tbl_category , tbl_sg , tbl_bcl WHERE tblb_subject.courseB_ID = '$cb_id' AND tblb_subject.courseB_ID = tbl_bcl.courseB_ID AND tblb_subject.categoryID = tbl_category.categoryID AND tblb_subject.sgID = tbl_sg.sgID");
            return $result;
        }
        public function fetch_data_a($id){
            $result = mysqli_query($this->dbcon, "SELECT tbl_grade.grade_Num , tbl_grade.transcript_ID , tbl_grade.courseA_ID , tbl_grade.subject_AID , subject_ACode , subject_AName , subject_ACredit , tbl_grade.subjectGrade , tbl_grade.sMatchNum , tbl_grade.matchCredit
            FROM tbl_grade , tbl_student , tbl_avp , tbla_subject
            WHERE tbl_student.transcript_ID = '$id' AND tbl_grade.transcript_ID = tbl_student.transcript_ID AND tbl_grade.courseA_ID = tbl_avp.courseA_ID AND tbl_grade.subject_AID = tbla_subject.subject_AID");
            return $result;
        }
        public function check_sjb($id,$sjb){
            $result = mysqli_query($this->dbcon, "SELECT tbl_grade.transcript_ID , tbl_grade.subject_AID , tbl_s_match.subject_BID , subject_ACode , subject_AName , subject_ACredit , subjectGrade
            FROM tbl_grade , tbl_student , tbla_subject , tbl_s_match
            WHERE tbl_grade.transcript_ID = '$id' AND tbl_grade.subject_AID = tbl_s_match.subject_AID AND tbl_s_match.subject_BID = '$sjb' AND tbl_grade.transcript_ID = tbl_student.transcript_ID AND tbl_grade.subject_AID = tbla_subject.subject_AID AND tbl_grade.subject_AID = tbl_s_match.subject_AID");
            return $result;
        }
        public function show_credit($cb_id){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tbl_bcl WHERE courseB_ID = '$cb_id'");
            return $result;
        }
        public function show_credit_g($id){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tbl_grade WHERE transcript_ID = '$id'");
            return $result;
        }
    }
    
?>