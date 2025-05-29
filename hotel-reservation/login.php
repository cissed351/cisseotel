
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL); //hatayı yazması için
session_start();
include 'db.php';

$error = '';

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {
                header("Location: admin/dashboard.php");
            } else {
                header("Location: dashboard.php");
            }
            exit();
        } else {
            $error = "❌ Hatalı şifre.";
        }
    } else {
        $error = "❌ Bu e-posta ile kayıtlı bir kullanıcı bulunamadı.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Giriş Yap</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="auth-page">

<div class="auth-box">
  <h3><i class="fas fa-sign-in-alt me-2"></i>Giriş Yap</h3>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger text-center mt-3"><?= $error ?></div>
  <?php endif; ?>

  <form method="POST" action="login.php" class="mt-4">
    <!-- E-Posta -->
    <div class="input-group mb-3">
      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      <input type="email" name="email" class="form-control" placeholder="E-posta" required>
    </div>

    <!-- Şifre -->
    <div class="input-group mb-4">
      <span class="input-group-text"><i class="fas fa-lock"></i></span>
      <input type="password" name="password" class="form-control" placeholder="Şifre" required>
    </div>

    <!-- Giriş Butonu -->
    <button type="submit" name="login" class="btn btn-primary w-100">
      <i class="fas fa-sign-in-alt me-2"></i> Giriş Yap
    </button>
  </form>

  <div class="auth-link mt-3">
    <p>Hesabınız yok mu? <a href="register.php"><i class="fas fa-user-plus me-1"></i>Kayıt Ol</a></p>
  </div>
</div>
</body>
</html>
