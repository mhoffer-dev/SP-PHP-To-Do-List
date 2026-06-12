<?php
session_start();
require_once '../config/database.php';
require_once '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification du TOKEN 
    if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
        die("Erreur CSRF.");
    }

    createTask($pdo, $_POST);

    // Redirection après POST
    header('Location: index.php');
    exit;
}

$priorites = $pdo->query("SELECT * FROM priorite")->fetchAll();
$statuts = $pdo->query("SELECT * FROM statut")->fetchAll();
$categories = $pdo->query("SELECT * FROM categorie")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une tâche</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            min-height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 750px;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 32px;
            color: #222;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
            margin-top: 15px;
            font-weight: bold;
            font-size: 16px;
            color: #333;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
        }

        textarea {
            min-height: 140px;
            resize: vertical;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #3498db;
        }

        button {
            margin-top: 30px;
            padding: 15px;
            background: #2ecc71;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: 0.2s;
        }

        button:hover {
            background: #27ae60;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #3498db;
            font-size: 16px;
        }

        .back:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Ajouter une tâche</h1>

    <form method="POST">

        <label for="title">Titre :</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Description :</label>
        <textarea id="description" name="description"></textarea>

        <label for="dateEcheance">Date échéance :</label>
        <input type="date" id="dateEcheance" name="dateEcheance">

        <label for="idPriorite">Priorité :</label>
        <select id="idPriorite" name="idPriorite">
            <?php foreach ($priorites as $p): ?>
                <option value="<?= $p['idPriorite'] ?>">
                    <?= htmlspecialchars($p['priorite']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="idStatut">Statut :</label>
        <select id="idStatut" name="idStatut">
            <?php foreach ($statuts as $s): ?>
                <option value="<?= $s['idStatut'] ?>">
                    <?= htmlspecialchars($s['statut']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="idCategorie">Catégorie :</label>
        <select id="idCategorie" name="idCategorie">
            <?php foreach ($categories as $c): ?>
                <option value="<?= $c['idCategorie'] ?>">
                    <?= htmlspecialchars($c['categorie']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- Token CSRF -->
        <input
            type="hidden"
            name="csrf_token"
            value="<?= generateCsrfToken() ?>">

        <button type="submit">Créer la tâche</button>

    </form>

    <a class="back" href="index.php">← Retour à la liste</a>

</div>

</body>
</html>