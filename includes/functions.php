<?php

// Lire toutes les tâches
function getAllTasks(PDO $pdo, string $sort = 'dateCreation', string $order = 'DESC')
{
    $allowedSort = ['dateCreation', 'dateEcheance', 'idPriorite', 'idStatut'];
    $allowedOrder = ['ASC', 'DESC'];

    if (!in_array($sort, $allowedSort)) $sort = 'dateCreation';
    if (!in_array($order, $allowedOrder)) $order = 'DESC';

    $sql = "
        SELECT t.*,
               p.priorite,
               s.statut,
               c.categorie
        FROM tache t
        JOIN priorite p ON t.idPriorite = p.idPriorite
        JOIN statut s ON t.idStatut = s.idStatut
        JOIN categorie c ON t.idCategorie = c.idCategorie
        ORDER BY $sort $order
    ";

    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

// Lire une tâche
function getTaskById(PDO $pdo, int $id)
{
    $stmt = $pdo->prepare(
        "SELECT * FROM tache WHERE idTache = ?"
    );

    $stmt->execute([$id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getTagsByTask(PDO $pdo, int $idTache)
{
    $sql = "
        SELECT tag.tag
        FROM tag
        JOIN tache_tag tt ON tt.idTag = tag.idTag
        WHERE tt.idTache = ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$idTache]);

    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

// Ajouter une tâche
function createTask(PDO $pdo, array $data)
{
    $sql = "
        INSERT INTO tache
        (title, description, dateCreation, dateEcheance,
         idPriorite, idStatut, idCategorie)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ";

    $stmt = $pdo->prepare($sql);

    return $stmt->execute([
        $data['title'],
        $data['description'],
        date('Y-m-d'),
        $data['dateEcheance'],
        $data['idPriorite'],
        $data['idStatut'],
        $data['idCategorie']
    ]);
}

// Modifier une tâche
function updateTask(PDO $pdo, int $id, array $data)
{
    $sql = "
        UPDATE tache
        SET title = ?,
            description = ?,
            dateEcheance = ?,
            idPriorite = ?,
            idStatut = ?,
            idCategorie = ?
        WHERE idTache = ?
    ";

    $stmt = $pdo->prepare($sql);

    return $stmt->execute([
        $data['title'],
        $data['description'],
        $data['dateEcheance'],
        $data['idPriorite'],
        $data['idStatut'],
        $data['idCategorie'],
        $id
    ]);
}

// Supprimer une tâche 
function deleteTask(PDO $pdo, int $id)
{
    $stmt = $pdo->prepare(
        "DELETE FROM tache WHERE idTache = ?"
    );

    return $stmt->execute([$id]);
}

/**
 * Génération d'un token CSRF
 */
function generateCsrfToken(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

/**
 * Vérification du token
 */
function verifyCsrfToken(?string $token): bool
{
    return isset($_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], $token ?? '');
}
