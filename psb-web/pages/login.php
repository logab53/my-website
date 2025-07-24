<?php include('../includes/header.php'); ?>
<div class="card">
<h2><i class="fas fa-sign-in-alt"></i> Login</h2>
<form method="POST" action="dashboard.php">
  <input type="text" name="username" placeholder="Username">
  <input type="password" name="password" placeholder="Password">
  <button type="submit" class="btn-primary">Login</button>
</form>
<p style="margin-top:10px;text-align:center;">Belum punya akun? <a href="register.php">Daftar</a></p>
</div>
<?php include('../includes/footer.php'); ?>
