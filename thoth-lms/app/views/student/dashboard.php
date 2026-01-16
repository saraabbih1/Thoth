
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

                <a href="/student/course/<?= $course['id'] ?>">
                    Voir le cours
                </a>
            </li>
            <hr>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>Aucun cours disponible.</p>
<?php endif; ?>

<hr>

<h2> Mes cours</h2>

<?php if (!empty($myCourses)) : ?>
    <ul>
        <?php foreach ($myCourses as $course) : ?>
            <li>
                <?= htmlspecialchars($course['title']) ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>Vous n'êtes inscrit à aucun cours.</p>
<?php endif; ?>

</body>
</html>
