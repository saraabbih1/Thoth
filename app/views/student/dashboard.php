<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Étudiant</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-6xl mx-auto px-6 py-8">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">
            Bienvenue sur votre Dashboard
        </h1>

        <a href="/logout"
           class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
            Déconnexion
        </a>
    </div>

    <!-- Tous les cours -->
    <section class="mb-10">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">
            Tous les cours disponibles
        </h2>

        <?php if (!empty($courses)) : ?>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($courses as $course) : ?>
                    <div class="bg-white rounded-xl shadow p-5">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">
                            <?= htmlspecialchars($course['title']) ?>
                        </h3>

                        <p class="text-gray-600 text-sm mb-4">
                            <?= htmlspecialchars($course['description']) ?>
                        </p>

                        <a href="/student/course/<?= $course['id'] ?>"
                           class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                            Voir le cours
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p class="text-gray-500">Aucun cours disponible.</p>
        <?php endif; ?>
    </section>

    <!-- Mes cours -->
    <section>
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">
            Mes cours
        </h2>

        <?php if (!empty($myCourses)) : ?>
            <ul class="bg-white rounded-xl shadow divide-y">
                <?php foreach ($myCourses as $course) : ?>
                    <li class="p-4 text-gray-700 font-medium">
                        <?= htmlspecialchars($course['title']) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p class="text-gray-500">
                Vous n'êtes inscrit à aucun cours.
            </p>
        <?php endif; ?>
    </section>

</div>

</body>
</html>
