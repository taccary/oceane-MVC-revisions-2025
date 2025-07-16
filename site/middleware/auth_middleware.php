<?php
// Middleware simplifié pour vérifier le rôle
function requireRole($role) {
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== $role) {
        header('Location: index.php?p=connexion');
        exit;
    }
}
