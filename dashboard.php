<?php
$title = "รายชื่อพนักงาน";
require_once "./db/connect.php";
require_once "./db/controller.php";
require_once "./layout/session.php";
$result = $controller->getEmployee();
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

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Prompt', sans-serif;
            background-color: #f8f9fa;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .table th {
            font-weight: 600;
            background-color: #f1f3f5;
            color: #495057;
        }

        .action-icon {
            font-size: 1.1rem;
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
                        <a class="nav-link active" href="index.php">หน้าแรก</a>
                    </li>
                    <?php if (!isset($_SESSION["userid"])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="loginform.php">เข้าสู่ระบบ</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                สวัสดี <?php echo $_SESSION["username"]; ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="logout.php">ออกจากระบบ</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h4 class="m-0 fw-bold text-primary">
                            <i class="bi bi-people-fill me-2"></i>ข้อมูลพนักงาน
                        </h4>
                        <a href="addForm.php" class="btn btn-primary btn-sm rounded-pill px-3">
                            <i class="bi bi-plus-lg me-1"></i> เพิ่มพนักงานใหม่
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col" class="ps-4">ชื่อ-นามสกุล</th>
                                        <th scope="col">แผนก</th>
                                        <th scope="col" class="text-end">เงินเดือน</th>
                                        <th scope="col" class="text-center" style="width: 150px;">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <tr>
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="rounded-circle bg-light d-flex justify-content-center align-items-center me-3" style="width: 40px; height: 40px;">
                                                        <i class="bi bi-person text-secondary"></i>
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold"><?php echo $row["fname"] . " " . $row["lname"]; ?></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-info text-dark bg-opacity-10 px-3 py-2 rounded-pill">
                                                    <?php echo $row["department_name"]; ?>
                                                </span>
                                            </td>
                                            <td class="text-end fw-bold text-success">
                                                <?php echo number_format($row["salary"]); ?> ฿
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="editform.php?id=<?php echo $row["emp_id"]; ?>" class="btn btn-sm btn-outline-warning" title="แก้ไข">
                                                        <i class="bi bi-pencil-square action-icon"></i>
                                                    </a>

                                                    <a href="delete.php?id=<?php echo $row["emp_id"]; ?>"
                                                        class="btn btn-sm btn-outline-danger btn-delete"
                                                        data-name="<?php echo $row['fname'] . ' ' . $row['lname']; ?>"
                                                        title="ลบ">
                                                        <i class="bi bi-trash action-icon"></i>
                                                    </a>

                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-muted text-end py-3">
                        <small>แสดงผลข้อมูลล่าสุด</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // ดักจับเหตุการณ์คลิกที่ปุ่มที่มี class 'btn-delete'
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault(); // หยุดการทำงานปกติของลิงก์ (ไม่ให้กระโดดไปหน้า delete.php ทันที)

                const href = this.getAttribute('href'); // เก็บลิงก์ไว้
                const name = this.getAttribute('data-name'); // เก็บชื่อพนักงาน

                Swal.fire({
                    title: 'คุณแน่ใจหรือไม่?',
                    text: `ต้องการลบข้อมูลของ "${name}" ใช่ไหม? การกระทำนี้ไม่สามารถย้อนกลับได้`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33', // สีแดง
                    cancelButtonColor: '#3085d6', // สีฟ้า
                    confirmButtonText: 'ใช่, ลบเลย!',
                    cancelButtonText: 'ยกเลิก',
                    customClass: {
                        popup: 'animated fadeInDown faster' // เพิ่ม Animation เล็กน้อย (ถ้าต้องการ)
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                });
            });
        });
    </script>
</body>

</html>