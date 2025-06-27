<?php require_once 'includes/db.php'; ?>
<?php
$stmt = $pdo->prepare("SELECT * FROM testimonials WHERE visible = 1 ORDER BY created_at DESC");
$stmt->execute();
$testimonials = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <title>Testimonials Showcase</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-serif bg-gradient-to-tr from-brand-400 dark:from-gray-400 dark:via-slate-800 dark:to-gray-400 min-h-screen flex flex-col">
  <main class="flex-1 max-w-6xl mx-auto py-10 px-4">
    <h1 class="text-3xl font-bold text-center text-white mb-10">What Clients Say</h1>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php foreach ($testimonials as $t): ?>
        <div class="bg-white/10 backdrop-blur-md text-white rounded-2xl shadow-xl p-6">
          <div class="flex justify-between items-center mb-2">
            <h2 class="text-lg font-semibold"><?= htmlspecialchars($t['name']) ?></h2>
            <div class="text-yellow-400">
              <?= str_repeat('★', $t['rating']) . str_repeat('☆', 5 - $t['rating']) ?>
            </div>
          </div>
          <p class="text-white/90 text-sm mb-1"><strong>Service:</strong> <?= htmlspecialchars($t['service']) ?> (<?= htmlspecialchars($t['type']) ?>)</p>
          <p class="text-white/70 text-sm mb-1"><strong>City:</strong> <?= htmlspecialchars($t['city']) ?></p>
          <p class="mt-2 italic">"<?= htmlspecialchars($t['comments']) ?>"</p>
        </div>
      <?php endforeach; ?>
    </div>
  </main>
</body>
</html>
