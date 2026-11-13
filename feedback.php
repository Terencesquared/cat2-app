<?php
require 'config.php';
if (!isset($_SESSION['username'])) { header('Location: login.php'); exit; }
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course = trim($_POST['course'] ?? '');
    $rating = (int)($_POST['rating'] ?? 0);
    $comments = trim($_POST['comments'] ?? '');
    if ($course === '' || $rating < 1 || $rating > 5 || $comments === '') {
        $msg = 'Fill in all fields (rating 1-5).';
    } else {
        $stmt = $conn->prepare('INSERT INTO feedback (user_id, course, rating, comments) VALUES (?,?,?,?)');
        $stmt->bind_param('isis', $_SESSION['user_id'], $course, $rating, $comments);
        $stmt->execute();
        $msg = 'Feedback saved.';
    }
}
$rows = $conn->query('SELECT f.id, u.username, f.course, f.rating, f.comments, f.submitted_at
                      FROM feedback f JOIN users u ON u.id = f.user_id ORDER BY f.id DESC');
include 'header.php';
?>
<h1>Course feedback</h1>
<?php if ($msg): ?><div class="ok"><?= htmlspecialchars($msg) ?></div><?php endif; ?>
<form method="POST" action="feedback.php">
  <label>Course</label><input name="course" required>
  <label>Rating (1-5)</label><input type="number" name="rating" min="1" max="5" required>
  <label>Comments</label><textarea name="comments" rows="4" required></textarea>
  <button type="submit">Submit feedback</button>
</form>
<h2>Submitted feedback</h2>
<table>
<tr><th>ID</th><th>User</th><th>Course</th><th>Rating</th><th>Comments</th><th>Submitted</th></tr>
<?php while ($r = $rows->fetch_assoc()): ?>
<tr><td><?= $r['id'] ?></td><td><?= htmlspecialchars($r['username']) ?></td><td><?= htmlspecialchars($r['course']) ?></td>
<td><?= $r['rating'] ?></td><td><?= htmlspecialchars($r['comments']) ?></td><td><?= $r['submitted_at'] ?></td></tr>
<?php endwhile; ?>
</table>
<?php include 'footer.php'; ?>
