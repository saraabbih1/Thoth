<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Inscription</h2>

<?php if (!empty($error)) : ?>
    <p style="color:red"><?= $error ?></p>
<?php endif; ?>

<form method="POST" action="/register">
    <input type="text" name="name" placeholder="Nom complet"><br><br>
    <input type="email" name="email" placeholder="Email"><br><br>
    <input type="password" name="password" placeholder="Mot de passe"><br><br>

    <button type="submit">S'inscrire</button>
</form>

</body>
</html>
