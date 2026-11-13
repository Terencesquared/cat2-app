<?php
require 'config.php';
if (!isset($_SESSION['username'])) { header('Location: login.php'); exit; }
$stmt = $conn->prepare('SELECT username, full_name, email, created_at FROM users WHERE id = ?');
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$u = $stmt->get_result()->fetch_assoc();
include 'header.php';
?>
<h1>Login successful</h1>
<p>Welcome, <b><?= htmlspecialchars($u['full_name']) ?></b>.</p>
<table>
<tr><th>Username</th><td><?= htmlspecialchars($u['username']) ?></td></tr>
<tr><th>Email</th><td><?= htmlspecialchars($u['email']) ?></td></tr>
<tr><th>Registered</th><td><?= htmlspecialchars($u['created_at']) ?></td></tr>
</table>
<?php include 'footer.php'; ?>
