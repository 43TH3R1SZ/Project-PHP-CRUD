<?php
$title = "แก้ไขข้อมูลพนักงาน";
require_once "layout/header.php"; // ตรวจสอบว่าในไฟล์ header.php มี tag เปิด html/head หรือไม่ ถ้าไม่มีให้ใช้ head ด้านล่าง
require_once "./db/connect.php";
require_once "./db/controller.php";

$result = $controller->getDepartments();

if (!isset($_GET["id"])) {
    header("Location:index.php");
    exit;
} else {
    $id = $_GET["id"];
    $emp = $controller->getEmployeeDetail($id);
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
        /* เปลี่ยนสีปุ่มบันทึกในหน้าแก้ไขให้เป็นสีส้ม/เหลือง เพื่อสื่อถึงการแก้ไข */
        .btn-warning-custom {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #000;
        }
        .btn-warning-custom:hover {
            background-color: #e0a800;
            border-color: #d39e00;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.4);
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
                        <a class="nav-link" href="#">พนักงาน</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <div class="card form-card bg-white">
                    <div class="card-header bg-warning bg-opacity-75 py-3 rounded-top-4">
                        <h4 class="m-0 fw-bold text-center text-dark">
                            <i class="bi bi-pencil-square me-2"></i>แก้ไขข้อมูลพนักงาน
                        </h4>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <form method="POST" action="updateform.php">
                            <input type="hidden" name="emp_id" value="<?php echo $emp["emp_id"] ?>">

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="fname" class="form-label">ชื่อจริง</label>
                                    <input type="text" name="fname" id="fname" class="form-control form-control-lg bg-light" 
                                           value="<?php echo $emp["fname"] ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="lname" class="form-label">นามสกุล</label>
                                    <input type="text" name="lname" id="lname" class="form-control form-control-lg bg-light" 
                                           value="<?php echo $emp["lname"] ?>" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="salary" class="form-label">เงินเดือน</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-cash"></i></span>
                                    <input type="number" name="salary" id="salary" class="form-control form-control-lg bg-light" 
                                           value="<?php echo $emp["salary"] ?>" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="department" class="form-label">แผนก</label>
                                <select name="department_id" id="department" class="form-select form-select-lg bg-light">
                                    <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <option value="<?php echo $row["department_id"] ?>" 
                                            <?php if ($row["department_id"] == $emp["department_id"]) echo "selected"; ?>>
                                            <?php echo $row["department_name"]; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="index.php" class="btn btn-light btn-lg px-4 me-md-2 text-secondary">ยกเลิก</a>
                                <button type="submit" name="submit" class="btn btn-warning-custom btn-lg btn-submit px-5 shadow">
                                    <i class="bi bi-check-circle-fill me-2"></i>บันทึกการแก้ไข
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