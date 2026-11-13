<?php require 'config.php'; include 'header.php'; ?>
<h1>CAT2 Student Portal</h1>
<p>Hosted on Ubuntu Server with Apache, PHP and MySQL (LAMP).</p>
<?php if (!isset($_SESSION['username'])): ?>
<p><a href="signup.php">Create an account</a> or <a href="login.php">log in</a>.</p>
<?php else: ?>
<p>You are logged in as <b><?= htmlspecialchars($_SESSION['username']) ?></b>.</p>
<?php endif; include 'footer.php'; ?>
