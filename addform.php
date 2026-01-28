<?php
$title = "แบบฟอร์มบันทึกข้อมูล";
require_once "layout/header.php"; // ถ้าในไฟล์นี้ยังไม่มี HTML Head ให้ใช้ Head ด้านล่างแทนนะครับ
require_once "./db/connect.php";
require_once "./db/controller.php"; // เรียกใช้ Controller ให้ถูกต้อง

$result = $controller->getDepartments();

// ตัวแปรสำหรับเก็บสถานะเพื่อแสดง Alert
$message = "";
$messageType = "";

if (isset($_POST["submit"])) {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $salary = $_POST["salary"];
    $department_id = $_POST["department_id"];
    
    $status = $controller->insert($fname, $lname, $salary, $department_id);
    if ($status) {
        $message = "บันทึกข้อมูลพนักงานเรียบร้อยแล้ว";
        $messageType = "success";
        // require_once "./layout/success_message.php"; // เปลี่ยนมาใช้ Alert ในหน้าเดียวกันแทน
    } else {
        $message = "เกิดข้อผิดพลาดในการบันทึกข้อมูล";
        $messageType = "danger";
        // require_once "./layout/error_message.php";
    }
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Prompt', sans-serif;
            background-color: #f8f9fa;
        }
        .form-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        }
        .form-label {
            font-weight: 600;
            color: #495057;
        }
        .btn-submit {
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php"><i class="bi bi-buildings-fill me-2"></i>HR System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">หน้าแรก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="addForm.php">เพิ่มพนักงาน</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                
                <?php if(!empty($message)): ?>
                    <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show shadow-sm" role="alert">
                        <i class="bi <?php echo ($messageType == 'success') ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill'; ?> me-2"></i>
                        <?php echo $message; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="card form-card bg-white">
                    <div class="card-header bg-primary text-white py-3 rounded-top-4">
                        <h4 class="m-0 fw-bold text-center">
                            <i class="bi bi-person-plus-fill me-2"></i>แบบฟอร์มบันทึกข้อมูลพนักงาน
                        </h4>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <form method="POST" action="addform.php">
                            
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="fname" class="form-label">ชื่อจริง</label>
                                    <input type="text" name="fname" id="fname" class="form-control form-control-lg bg-light" placeholder="ระบุชื่อจริง" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="lname" class="form-label">นามสกุล</label>
                                    <input type="text" name="lname" id="lname" class="form-control form-control-lg bg-light" placeholder="ระบุนามสกุล" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="salary" class="form-label">เงินเดือน</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-cash"></i></span>
                                    <input type="number" name="salary" id="salary" class="form-control form-control-lg bg-light" placeholder="ระบุเงินเดือน (บาท)" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="department" class="form-label">แผนก</label>
                                <select name="department_id" id="department" class="form-select form-select-lg bg-light" required>
                                    <option value="" selected disabled>-- เลือกแผนก --</option>
                                    <?php 
                                    // Reset pointer just in case, though usually not needed if fetched once
                                    // $result->execute(); 
                                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <option value="<?php echo $row["department_id"] ?>"><?php echo $row["department_name"]; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="index.php" class="btn btn-light btn-lg px-4 me-md-2 text-secondary">ยกเลิก</a>
                                <button type="submit" name="submit" class="btn btn-primary btn-lg btn-submit px-5 shadow">
                                    <i class="bi bi-save me-2"></i>บันทึกข้อมูล
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>