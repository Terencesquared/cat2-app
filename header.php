<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CAT2 Student Portal</title>
<link rel="stylesheet" href="style.css"></head><body>
<nav>
  <a href="index.php">Home</a>
  <?php if (isset($_SESSION['username'])): ?>
    <a href="dashboard.php">Dashboard</a><a href="feedback.php">Feedback</a><a href="logout.php">Logout (<?= htmlspecialchars($_SESSION['username']) ?>)</a>
  <?php else: ?>
    <a href="signup.php">Sign up</a><a href="login.php">Login</a>
  <?php endif; ?>
</nav><main>
