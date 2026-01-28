<?php
session_start();
$title = "เข้าสู่ระบบ";

require_once "db/connect.php";
require_once "db/controller.php";

// ตัวแปรสำหรับแจ้งเตือน
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // 2. เรียกใช้ $controller (ตามไฟล์ connect) และ getUser (ตามไฟล์ controller)
    $result = $controller->getUser($username, $password); 

    if (!$result) {
        $error_message = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
    } else {
        // 3. เก็บ Session
        $_SESSION["username"] = $username;
        $_SESSION["userid"] = $result["id"];
        
        // 4. เปลี่ยนหน้า
        header("Location: index.php");
        exit;
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
        body { font-family: 'Prompt', sans-serif; background-color: #f8f9fa; }
        .login-card { border: none; border-radius: 15px; box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php"><i class="bi bi-buildings-fill me-2"></i>HR System</a>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                
                <?php if(!empty($error_message)): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-circle-fill me-2"></i> <?php echo $error_message; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <div class="card login-card">
                    <div class="card-header bg-primary text-white py-3 rounded-top-4 text-center">
                        <h4 class="m-0 fw-bold"><i class="bi bi-box-arrow-in-right me-2"></i>เข้าสู่ระบบ</h4>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        
                        <form method="POST" action="<?php echo htmlentities($_SERVER["PHP_SELF"]) ?>">
                            
                            <div class="mb-3">
                                <label for="username" class="form-label">ชื่อผู้ใช้งาน (Username)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                                    <input type="text" name="username" class="form-control form-control-lg" 
                                           value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST") echo $_POST["username"]; ?>" 
                                           required placeholder="กรอกชื่อผู้ใช้">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label">รหัสผ่าน (Password)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-key"></i></span>
                                    <input type="password" name="password" class="form-control form-control-lg" 
                                           required placeholder="กรอกรหัสผ่าน">
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" name="submit" class="btn btn-primary btn-lg shadow-sm">
                                    เข้าสู่ระบบ
                                </button>
                            </div>
                        </form>

                    </div>
                    <div class="card-footer bg-white text-center py-3 text-muted">
                        <small>Employee Management System</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>