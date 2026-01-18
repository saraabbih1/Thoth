<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>
<body>

<h2>Inscription</h2>

<?php if (!empty($error)) : ?>
    <p style="color:red"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" action="/register">
    <input type="text" name="name" placeholder="Nom complet" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Mot de passe" required><br><br>

    <button type="submit">S'inscrire</button>
</form>

</body>
</html>
