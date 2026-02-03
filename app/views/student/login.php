<!DOCTYPE html>
<html lang="fr">c
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center">
  <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-sm">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Login</h2>

    <?php if (!empty($error)): ?>
        <p class="text-red-500 mb-4"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" class="space-y-4" action="/login">
        <input type="email" name="email" placeholder="Email" required
               class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-gray-400">

        <input type="password" name="password" placeholder="Mot de passe" required
               class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-gray-400">

        <button type="submit"
                class="w-full bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700 transition-colors">
            Se connecter
        </button>
    </form>
    <a href="/register">Reg</a>
  </div>
</div>

</body>
</html>
