<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize($_POST['name']);
    $rating = (int)$_POST['rating'];
    $service = sanitize($_POST['service']);
    $type = sanitize($_POST['type']);
    $city = sanitize($_POST['city']);
    $comments = sanitize($_POST['comments']);

    $stmt = $pdo->prepare("INSERT INTO testimonials (name, rating, service, type, city, comments) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([$name, $rating, $service, $type, $city, $comments])) {
        header('Location: showcase.php');
        exit();
    } else {
        $msg = 'Something went wrong. Try again.';
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <title>Submit Testimonial</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-serif bg-gradient-to-tr from-brand-400 dark:from-gray-400 dark:via-slate-800 dark:to-gray-400 min-h-screen flex flex-col">
  <main class="flex-1 grid place-items-center p-4">
    <form method="POST" class="w-full max-w-lg bg-white/10 backdrop-blur-md text-white rounded-2xl shadow-2xl p-6 sm:p-8 space-y-4">
      <h2 class="text-2xl font-semibold text-center text-brand-700 text-gray-800 font-serif">
        Tell us how we did!
      </h2>

      <?php if ($msg): ?>
        <p class="text-red-400 text-sm text-center"><?= $msg ?></p>
      <?php endif; ?>

      <div class="space-y-3">
        <input name="name" required placeholder="Name" class="w-full bg-slate-800 dark:text-white rounded-lg p-4 shadow-inner focus:bg-slate-800" />
        <input name="city" required placeholder="City / Country" class="w-full rounded-md bg-slate-800 dark:text-white p-3" />
      </div>

      <select name="service" required class="w-full p-2 border rounded text-white bg-slate-800">
        <option value="">Choose Service</option>
        <option value="web-dev">Web Development</option>
        <option value="web-design">Web Design</option>
        <option value="graphic">Graphic Design</option>
        <option value="saas">SAAS Web App development</option>
        <option value="wordpress">WordPress</option>
      </select>

      <input name="type" required placeholder="What did you get (Logo, E-commerce Website etc)" class="w-full bg-slate-800 dark:text-white rounded-lg p-4 shadow-inner" />

      <select name="rating" required class="w-full p-2 border rounded text-white bg-slate-800">
        <option value="">Rate our work</option>
        <option value="5">★★★★★</option>
        <option value="4">★★★★</option>
        <option value="3">★★★</option>
        <option value="2">★★</option>
        <option value="1">★</option>
      </select>

      <textarea name="comments" required rows="2" placeholder="Your feedback…" class="w-full bg-slate-800 dark:text-white rounded-lg p-4 shadow-inner focus:outline-brand-400"></textarea>

      <button type="submit" class="w-full py-3 rounded-xl font-semibold bg-white text-slate-800 bg-brand-700 hover:bg-brand-400 transition-all shadow-lg">
        Submit
      </button>
    </form>
  </main>

  <footer class="text-center text-white/80 mb-4">
    &copy; 2025 ALl Rights Reserved by Ayesha Anwar & Abdul Hannan
  </footer>
</body>
</html>
