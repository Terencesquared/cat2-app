<?php
require 'config.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $stmt = $conn->prepare('SELECT id, username, password_hash FROM users WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    if ($row && password_verify($password, $row['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        header('Location: dashboard.php'); exit;
    }
    $msg = 'Invalid username or password.';
}
include 'header.php';
?>
<h1>Login</h1>
<?php if ($msg): ?><div class="err"><?= $msg ?></div><?php endif; ?>
<form method="POST" action="login.php">
  <label>Username</label><input name="username" required>
  <label>Password</label><input type="password" name="password" required>
  <button type="submit">Login</button>
</form>
<?php include 'footer.php'; ?>
