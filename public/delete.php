<?php
require_once '../config/database.php';
require_once '../includes/functions.php';

if (isset($_GET['id'])) {
    deleteTask($pdo, (int)$_GET['id']);
}

header('Location: index.php');
exit;