# 📋 To Do List PHP - Projet LP DWCA

Application web de gestion de tâches développée en PHP avec MySQL dans le cadre de l’UE 6.1.1 - Langage PHP et base de données.

---

## 🚀 Fonctionnalités

- CRUD complet des tâches (Créer, Lire, Modifier, Supprimer)
- Gestion des priorités
- Gestion des statuts
- Gestion des catégories
- Système de tags (relation N-N)
- Tri dynamique des tâches
  - par date de création
  - par date d’échéance
  - par priorité
  - par statut
- Protection CSRF sur les formulaires
- Affichage sécurisé (protection XSS via `htmlspecialchars`)
- Interface simple et responsive (HTML/CSS)

---

## 🧱 Stack technique

- PHP 8.x
- MySQL / MariaDB
- PDO (requêtes préparées)
- HTML5 / CSS3
- WAMP (en développement)

---

## 📁 Structure du projet

todo-list-php/
│
├── config/
│ └── database.php
│
├── includes/
│ └── functions.php
│
├── public/
│ ├── index.php
│ ├── create.php
│ ├── edit.php
│ ├── delete.php
│ └── style.css (optionnel)
│
├── sql/
│ └── todo_list.sql
│
└── README.md


---