<?php
include 'db.php';

$success = '';
$error = '';

if (isset($_POST['register'])) {
    $fullname = trim(mysqli_real_escape_string($conn, $_POST['fullname']));
    $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // E-posta zaten var mı?
    $check = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email'");
    if (!$check) {
        $error = "❌ E-posta kontrol hatası: " . mysqli_error($conn);
    } elseif (mysqli_num_rows($check) > 0) {
        $error = "❌ Bu e-posta zaten kayıtlı.";
    } else {
        $insert = mysqli_query($conn, "INSERT INTO users (fullname, email, password, role) VALUES ('$fullname', '$email', '$password', 'user')");
        if ($insert) {
            $success = "✅ Kayıt başarılı! Giriş sayfasına yönlendiriliyorsunuz.";
            header("refresh:2;url=login.php");
        } else {
            $error = "❌ Kayıt hatası: " . mysqli_error($conn);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Kayıt Ol</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="auth-page">

<div class="auth-box">
  <h3><i class="fas fa-user-plus me-2"></i>Kayıt Ol</h3>

  <?php if (!empty($success)): ?>
    <div class="alert alert-success text-center mt-3"><?= $success ?></div>
  <?php elseif (!empty($error)): ?>
    <div class="alert alert-danger text-center mt-3"><?= $error ?></div>
  <?php endif; ?>

  <form method="POST" action="" class="mt-4">
    <!-- Ad Soyad -->
    <div class="input-group mb-3">
      <span class="input-group-text"><i class="fas fa-user"></i></span>
      <input type="text" name="fullname" class="form-control" placeholder="Ad Soyad" required>
    </div>

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

    <!-- Kayıt Butonu -->
    <button type="submit" name="register" class="btn btn-primary w-100">
      <i class="fas fa-user-plus me-2"></i> Kayıt Ol
    </button>
  </form>

  <div class="auth-link mt-3">
    <p>Zaten hesabınız var mı? <a href="login.php"><i class="fas fa-sign-in-alt me-1"></i>Giriş Yap</a></p>
  </div>
</div>
</body>
</html>
