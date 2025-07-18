# DIT Transfer Project

โปรเจกต์นี้เป็นระบบเว็บแอปพลิเคชันสำหรับจัดการการลงทะเบียนเรียน (Course Registration System) โดยใช้ PHP และฐานข้อมูล MySQL เหมาะสำหรับใช้ในสถาบันการศึกษาหรือหลักสูตรต่าง ๆ เพื่อบริหารจัดการสมาชิกและรายวิชา

## คุณสมบัติหลัก

- ระบบจัดการสมาชิก (Member Management)
- ระบบจัดการหลักสูตรและรายวิชา
- ระบบลงทะเบียนเรียนของสมาชิก
- การเชื่อมต่อและจัดการข้อมูลกับฐานข้อมูล MySQL
- หน้าเว็บสำหรับดูข้อมูลสมาชิกและหลักสูตรต่าง ๆ

## โครงสร้างไฟล์

- `config/` - ไฟล์ตั้งค่าการเชื่อมต่อฐานข้อมูล
- `member.php` - ระบบจัดการข้อมูลสมาชิก
- `course.php` - ระบบจัดการหลักสูตรและรายวิชา
- `register.php` - ระบบลงทะเบียนเรียน
- ไฟล์ PHP อื่น ๆ สำหรับฟังก์ชันเสริมและหน้าต่าง ๆ ของเว็บ

## การติดตั้งและใช้งาน

1. ติดตั้งเว็บเซิร์ฟเวอร์ที่รองรับ PHP เช่น XAMPP, WAMP หรือ LAMP
2. สร้างฐานข้อมูล MySQL และนำไฟล์ SQL ในโฟลเดอร์ `database` (ถ้ามี) ไป Import
3. ปรับแก้ไฟล์ `config/database.php` เพื่อใส่ข้อมูลการเชื่อมต่อฐานข้อมูลของคุณ (host, username, password, dbname)
4. นำโฟลเดอร์โปรเจกต์นี้ไปไว้ในไดเรกทอรีเว็บเซิร์ฟเวอร์ เช่น `htdocs` ใน XAMPP
5. เข้าใช้งานผ่านเว็บเบราว์เซอร์ เช่น `http://localhost/dit-transfer-project/`

## ข้อควรระวัง

- โปรเจกต์นี้เป็นเวอร์ชันพื้นฐาน อาจต้องปรับปรุงเรื่องความปลอดภัยและ UX/UI เพิ่มเติม
- ไม่มีระบบ Authentication (Login) ที่สมบูรณ์ ควรเสริมเมื่อต้องการใช้งานจริง
- ควรสำรองข้อมูลฐานข้อมูลเป็นประจำ

## ติดต่อ

หากมีคำถามหรือข้อเสนอแนะ ติดต่อได้ทาง [Tong.Panpet.4941@gmail.com]

---

ขอบคุณที่ใช้โปรเจกต์นี้ครับ!

