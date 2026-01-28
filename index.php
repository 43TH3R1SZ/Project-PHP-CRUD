<?php
require_once "./layout/session.php"; // เรียกใช้ session
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ยินดีต้อนรับ - HR System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Prompt', sans-serif;
            background-color: #f8f9fa;
        }
        /* Hero Section Styling */
        .hero-section {
            background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
            color: white;
            padding: 100px 0;
            margin-bottom: 50px;
            box-shadow: 0 10px 30px rgba(13, 110, 253, 0.2);
        }
        .feature-icon {
            font-size: 3rem;
            color: #0d6efd;
            margin-bottom: 20px;
        }
        .feature-card {
            border: none;
            border-radius: 20px;
            transition: transform 0.3s;
            height: 100%;
        }
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .btn-cta {
            padding: 12px 35px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s;
        }
        .btn-cta:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php"><i class="bi bi-buildings-fill me-2"></i>HR System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="index.php">หน้าแรก</a></li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <?php if (isset($_SESSION["userid"])) { ?>
                                <i class="bi bi-person-circle me-1"></i> สวัสดี <?php echo $_SESSION["username"]; ?>
                            <?php } else { ?>
                                <i class="bi bi-person me-1"></i> บัญชีผู้ใช้
                            <?php } ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <?php if (isset($_SESSION["userid"])) { ?>
                                <li><a class="dropdown-item" href="dashboard.php">ไปที่ระบบจัดการ</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="logout.php"><i class="bi bi-box-arrow-right me-1"></i>ออกจากระบบ</a></li>
                            <?php } else { ?>
                                <li><a class="dropdown-item" href="loginform.php"><i class="bi bi-box-arrow-in-right me-1"></i>เข้าสู่ระบบ</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">ระบบบริหารจัดการทรัพยากรบุคคล</h1>
            <p class="lead mb-4 opacity-75">จัดการข้อมูลพนักงาน แผนก และเงินเดือน ได้อย่างมีประสิทธิภาพ<br>รวดเร็ว ปลอดภัย และใช้งานง่าย</p>
            
            <div class="d-flex justify-content-center gap-3">
                <?php if (isset($_SESSION["userid"])) { ?>
                    <a href="dashboard.php" class="btn btn-light btn-cta text-primary shadow">
                        <i class="bi bi-speedometer2 me-2"></i>เข้าสู่ระบบจัดการ
                    </a>
                <?php } else { ?>
                    <a href="loginform.php" class="btn btn-light btn-cta text-primary shadow">
                        <i class="bi bi-box-arrow-in-right me-2"></i>เข้าสู่ระบบเพื่อใช้งาน
                    </a>
                <?php } ?>
            </div>
        </div>
    </header>

    <div class="container mb-5">
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="card feature-card p-4 shadow-sm">
                    <div class="card-body">
                        <i class="bi bi-people-fill feature-icon"></i>
                        <h4 class="card-title fw-bold">จัดการพนักงาน</h4>
                        <p class="card-text text-muted">เพิ่ม ลบ แก้ไข ข้อมูลพนักงานได้อย่างง่ายดาย พร้อมระบบค้นหาที่รวดเร็ว</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card p-4 shadow-sm">
                    <div class="card-body">
                        <i class="bi bi-building-fill-gear feature-icon"></i>
                        <h4 class="card-title fw-bold">จัดการแผนก</h4>
                        <p class="card-text text-muted">บริหารจัดการโครงสร้างแผนก เชื่อมโยงข้อมูลพนักงานเข้ากับหน่วยงานต่างๆ</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card p-4 shadow-sm">
                    <div class="card-body">
                        <i class="bi bi-shield-lock-fill feature-icon"></i>
                        <h4 class="card-title fw-bold">ความปลอดภัย</h4>
                        <p class="card-text text-muted">ระบบยืนยันตัวตนที่ปลอดภัย จำกัดสิทธิ์การเข้าถึงข้อมูลเพื่อความเป็นส่วนตัว</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center py-4 text-muted bg-white border-top mt-auto">
        <div class="container">
            <small>&copy; 2024 HR Management System. All rights reserved.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>