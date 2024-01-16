<?php require 'templates/header.php' ?>
<div class="container mt-5">
    <div class="mb-3 text-center">
        <h1>ระบบฐานข้อมูลและการออกแบบ</h1>
    </div>

    <?php
    require 'db_conn.php';

    // ดึงข้อมูลจากฐานข้อมูล
    $sql = "SELECT * FROM videos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) { ?>


            <div class="accordion" id="accordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?php echo $row["id"]; ?>">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $row["id"]; ?>" aria-expanded="true" aria-controls="collapse<?php echo $row["id"]; ?>">
                            <i class="fa-solid fa-database"></i><?php echo "&nbsp".$row['videotitle'] ?>
                        </button>
                    </h2>
                    <div id="collapse<?php echo $row["id"]; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $row["id"]; ?>" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong><?php echo $row["videodesc"]; ?></strong><br>
                            <div class="text-center" style="height: 600px; ">
                                <iframe class="w-75 h-100" src="<?php echo $row["videolink"]; ?>" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php }
    } else {
        echo '<p>No videos available.</p>';
    }

    $conn->close();
    ?>

</div>
<?php require 'templates/footer.php' ?>