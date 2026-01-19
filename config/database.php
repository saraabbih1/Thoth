<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Étudiant</title>
</head>
<body>

<h1>Bienvenue sur votre Dashboard</h1>

<a href="/logout">Déconnexion</a>

<hr>

<h2>Tous les cours disponibles</h2>

<?php if (!empty($courses)) : ?>
    <ul>
        <?php foreach ($courses as $course) : ?>
            <li>
                <strong><?= htmlspecialchars($course['title']) ?></strong><br>
                <?= htmlspecialchars($course['description']) ?><br>

                <?php if (!in_array($course['id'], array_column($myCourses, 'id'))): ?>
                    <form method="POST" action="/student/enroll">
                        <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                        <button type="submit">S'inscrire</button>
                    </form>
                <?php else: ?>
                    Déjà inscrit
                <?php endif; ?>
            </li>
            <hr>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>Aucun cours disponible.</p>
<?php endif; ?>

<hr>

<h2>Mes cours</h2>

<?php if (!empty($myCourses)) : ?>
    <ul>
        <?php foreach ($myCourses as $course) : ?>
            <li><?= htmlspecialchars($course['title']) ?></li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>Vous n'êtes inscrit à aucun cours.</p>
<?php endif; ?>

</body>
</html>
