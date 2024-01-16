<?php
require 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // กำหนดคำสั่ง SQL
    $sql = "SELECT * FROM users WHERE username = ?";

    // เตรียมคำสั่ง SQL และผูกค่า parameter
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);

    // ทำการ execute คำสั่ง SQL
    $stmt->execute();

    // รับผลลัพธ์
    $result = $stmt->get_result();

    // ตรวจสอบว่ามีผลลัพธ์หรือไม่
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // ตรวจสอบรหัสผ่าน
        if (password_verify($password, $row['password'])) {
            // Login สำเร็จ
            // เริ่ม session
            session_start();
            // กำหนด session
            $_SESSION['username'] = $username;
            // Redirect ไปยังหน้า admin.php
            header('Location: admin.php');
            exit();
        } else {
            // Login ไม่สำเร็จ
            header('Location: login.php');
            exit();
        }
    } else {
        // Login ไม่สำเร็จ
        header('Location: login.php');
        exit();
    }

    // ปิดคำสั่ง SQL
    $stmt->close();

    // ปิดการเชื่อมต่อกับฐานข้อมูล
    $conn->close();
}
