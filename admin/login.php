
<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = sanitize($_POST['username']);
  $password = md5($_POST['password']);

  $stmt = $pdo->prepare("SELECT * FROM admin WHERE username = ? AND password = ? LIMIT 1");
  $stmt->execute([$username, $password]);
  $admin = $stmt->fetch();

  if ($admin) {
    $_SESSION['admin_logged_in'] = true;
    header("Location: dashboard.php");
    exit();
  } else {
    $error = 'Invalid login details';
  }
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-serif bg-gradient-to-tr from-brand-400 dark:from-gray-400 dark:via-slate-800 dark:to-gray-400 min-h-screen flex items-center justify-center">
  <main class="w-full max-w-md bg-white/10 backdrop-blur-md text-white rounded-2xl shadow-2xl p-8">
    <h2 class="text-2xl font-semibold text-center text-white mb-6">Admin Login</h2>
    <?php if ($error): ?>
      <p class="text-red-400 text-sm text-center mb-4"><?= $error ?></p>
    <?php endif; ?>
    <form method="POST" class="space-y-4">
      <input name="username" placeholder="Username" required class="w-full p-3 rounded-md bg-slate-800 text-white" />
      <input name="password" type="password" placeholder="Password" required class="w-full p-3 rounded-md bg-slate-800 text-white" />
      <button class="w-full py-3 rounded-xl font-semibold bg-white text-slate-800 bg-brand-700 hover:bg-brand-400 transition-all shadow-lg">Login</button>
    </form>
  </main>

</body>
</html>
