<?php
require 'templates/header_admin.php';
session_start();

// ตรวจสอบว่ามี session['username'] หรือไม่
if (!isset($_SESSION['username'])) {
    // หากไม่มี session['username'], ให้ redirect ไปที่หน้า login.php
    header('Location: index.php');
    exit();
}

?>
<div class="container mt-5">
    <h1>Admin Page - Add Accordion</h1>

    <!-- Form to add Accordion -->
    <form action="add_accordion.php" method="post">
        <div class="form-group">
            <label for="videotitle">Accordion Title:</label>
            <input type="text" class="form-control" id="videotitle" name="videotitle" required>
        </div>
        <div class="form-group">
            <label for="videodesc">Accordion Content:</label>
            <textarea class="form-control" id="videodesc" name="videodesc" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="videolink">YouTube Link:</label>
            <input type="text" class="form-control" id="videolink" name="videolink">
        </div>
        <button type="submit" class="btn btn-primary">Add Video</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>