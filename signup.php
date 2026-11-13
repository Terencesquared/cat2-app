<?php
require 'config.php';
$msg = ''; $ok = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $full_name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    if ($username === '' || $full_name === '' || $email === '' || strlen($password) < 6) {
        $msg = 'All fields are required and the password must be at least 6 characters.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = 'Enter a valid email address.';
    } else {
        $stmt = $conn->prepare('SELECT id FROM users WHERE username = ?');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            $msg = 'That username is already taken.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $ins = $conn->prepare('INSERT INTO users (username, full_name, email, password_hash) VALUES (?,?,?,?)');
            $ins->bind_param('ssss', $username, $full_name, $email, $hash);
            $ins->execute();
            $ok = true; $msg = 'Account created for ' . htmlspecialchars($username) . '. You can now log in.';
        }
    }
}
include 'header.php';
?>
<h1>Sign up</h1>
<?php if ($msg): ?><div class="<?= $ok ? 'ok' : 'err' ?>"><?= $msg ?></div><?php endif; ?>
<form method="POST" action="signup.php">
  <label>Username</label><input name="username" required>
  <label>Full name</label><input name="full_name" required>
  <label>Email</label><input type="email" name="email" required>
  <label>Password</label><input type="password" name="password" required>
  <button type="submit">Register</button>
</form>
<?php include 'footer.php'; ?>
