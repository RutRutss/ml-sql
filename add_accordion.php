<?php
require 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $videotitle = $_POST['videotitle'];
    $videodesc = $_POST['videodesc'];
    $videolink = $_POST['videolink'];

    // ตรวจสอบว่า videotitle ที่ต้องการเพิ่มไม่มีอยู่ในฐานข้อมูลแล้ว
    $check_sql = "SELECT COUNT(*) FROM videos WHERE videotitle = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $videotitle);
    $check_stmt->execute();
    $check_stmt->bind_result($count);
    $check_stmt->fetch();
    $check_stmt->close();

    if ($count > 0) {
        // ถ้า videotitle มีอยู่ในฐานข้อมูลแล้ว, แสดง popup และ redirect กลับไปที่หน้า admin.php
        echo '<script>alert("มีวิดีโอชื่อนี้อยู่แล้ว");</script>';
        echo '<script>window.location.href = "admin.php";</script>';
        exit;
    }

    // กำหนดคำสั่ง SQL
    $sql = "INSERT INTO videos (videotitle, videodesc, videolink) VALUES (?, ?, ?)";

    // เตรียมคำสั่ง SQL และผูกค่า parameter
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $videotitle, $videodesc, $videolink);

    // ทำการ execute คำสั่ง SQL
    if ($stmt->execute()) {
        // ปิดคำสั่ง SQL
        $stmt->close();

        // ปิดการเชื่อมต่อกับฐานข้อมูล
        $conn->close();

        header('Location: admin.php');
        exit;
    } else {
        // หากมี error, ให้แสดง popup และ redirect กลับไปที่หน้า admin.php
        echo '<script>alert("Error during insertion. Please try again.");</script>';
        echo '<script>window.location.href = "admin.php";</script>';
        exit;
    }
}
