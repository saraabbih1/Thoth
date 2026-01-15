<h2>Login</h2>

<?php if (isset($error)): ?>
    <p style="color:red"><?= $error ?></p>
<?php endif; ?>

<form method="POST">
    <input type="email" name="email">
    <input type="password" name="password">
    <button>Login</button>
</form>
