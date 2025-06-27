<?php
require_once '../includes/db.php';
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
  header('Location: login.php');
  exit();
}

if (isset($_GET['action'], $_GET['id'])) {
  $id = (int)$_GET['id'];
  $action = $_GET['action'] === 'hide' ? 0 : 1;
  $pdo->prepare("UPDATE testimonials SET visible = ? WHERE id = ?")->execute([$action, $id]);
  header('Location: dashboard.php');
  exit();
}

$testimonials = $pdo->query("SELECT * FROM testimonials ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-serif bg-gradient-to-tr from-brand-400 dark:from-gray-400 dark:via-slate-800 dark:to-gray-400 min-h-screen flex flex-col">
  <main class="flex-1 max-w-6xl mx-auto py-10 px-4">
    <h1 class="text-3xl font-bold text-center text-white mb-10">Manage Testimonials</h1>
    <div class="grid md:grid-cols-2 gap-6">
      <?php foreach ($testimonials as $t): ?>
        <div class="bg-white/10 backdrop-blur-md text-white rounded-xl shadow-xl p-6 border <?= $t['visible'] ? '' : 'opacity-50' ?>">
          <div class="flex justify-between items-start mb-2">
            <h2 class="text-lg font-semibold"><?= htmlspecialchars($t['name']) ?> <span class="text-sm text-white/70">from <?= htmlspecialchars($t['city']) ?></span></h2>
            <div class="text-yellow-400">
              <?= str_repeat('★', $t['rating']) . str_repeat('☆', 5 - $t['rating']) ?>
            </div>
          </div>
          <p class="text-white/90 text-sm mb-1"><strong>Service:</strong> <?= htmlspecialchars($t['service']) ?> (<?= htmlspecialchars($t['type']) ?>)</p>
          <p class="italic text-white/80 mb-3">"<?= htmlspecialchars($t['comments']) ?>"</p>
          <div class="flex gap-3">
            <?php if ($t['visible']): ?>
              <a href="?action=hide&id=<?= $t['id'] ?>" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Hide</a>
            <?php else: ?>
              <a href="?action=show&id=<?= $t['id'] ?>" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">Show</a>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </main>

  <footer class="text-center text-white/80 mt-4 mb-4">
    &copy; 2025 Admin Panel | AH Freelance Hub
  </footer>
</body>
</html>
