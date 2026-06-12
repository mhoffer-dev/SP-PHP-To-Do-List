<?php
require_once '../config/database.php';
require_once '../includes/functions.php';

// Tri choisi
$sort = $_GET['sort'] ?? 'dateCreation';
$order = $_GET['order'] ?? 'DESC';

// Récupération des tâches
$tasks = getAllTasks($pdo, $sort, $order);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>To Do List</title>

    <style>
        html {
            height: 100%;
        }

        body {
            min-height: 100vh;
            margin: 0;
            background: #f5f5f5;
            font-family: Arial, sans-serif;

            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
            padding: 40px;
        }

        h1 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            table-layout: fixed;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }

        th {
            background: #222;
            color: white;
        }

        .actions a {
            margin-right: 10px;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
            color: white;
        }

        .edit {
            background: #3498db;
        }

        .delete {
            background: #e74c3c;
        }

        .create {
            display: inline-block;
            margin-bottom: 15px;
            padding: 10px 15px;
            background: #2ecc71;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .sort-bar {
            margin-bottom: 20px;
            display: flex;
            gap: 25px;
            flex-wrap: wrap;
            font-size: 20px;
        }

        .sort-bar a {
            text-decoration: none;
            background: #444;
            color: white;
            padding: 6px 10px;
            border-radius: 5px;
        }

        .sort-bar a:hover {
            background: #222;
        }

        footer {
            background: #222;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 18px;
        }

        footer p {
            margin: 0;
        }
    </style>
</head>

<body>
    <main>
        <h1>📋 To Do List</h1>

        <div class="sort-bar">
            Trier par :
            <a href="?sort=dateCreation&order=DESC">📅 Date création</a>
            <a href="?sort=dateEcheance&order=ASC">⏳ Échéance</a>
            <a href="?sort=idPriorite&order=DESC">⚡ Priorité</a>
            <a href="?sort=idStatut&order=ASC">📌 Statut</a>
        </div>

        <a class="create" href="create.php">+ Ajouter une tâche</a>

        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Création</th>
                    <th>Échéance</th>
                    <th>Priorité</th>
                    <th>Statut</th>
                    <th>Catégorie</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

            <?php foreach ($tasks as $task): ?>

                <tr>
                    <td><?= htmlspecialchars($task['title']) ?></td>
                    <td><?= htmlspecialchars($task['description']) ?></td>
                    <td><?= date('d/m/Y', strtotime($task['dateCreation'])) ?></td>
                    <td><?= $task['dateEcheance'] ? date('d/m/Y', strtotime($task['dateEcheance'])) : '' ?></td>
                    <td><?= $task['priorite'] ?></td>
                    <td><?= $task['statut'] ?></td>
                    <td><?= $task['categorie'] ?></td>
                    <td class="actions">
                        <a class="edit" href="edit.php?id=<?= $task['idTache'] ?>">Modifier</a>
                        <a class="delete" href="delete.php?id=<?= $task['idTache'] ?>"
                        onclick="return confirm('Supprimer cette tâche ?')">
                            Supprimer
                        </a>
                    </td>
                </tr>

            <?php endforeach; ?>

            </tbody>
        </table>
    </main>
<footer>
    <p>
        © <?= date('Y') ?> - UE 6.1.1 To Do List PHP |
        Développé par Mickael Hoffer |
        LP DWCA
    </p>
</footer>
</body>
</html>