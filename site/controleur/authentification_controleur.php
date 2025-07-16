<?php
include_once __DIR__ . '/../modele/authentification_modele.php';

function afficherConnexion() {
    $message = null;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $result = login($username, $password);
        $message = $result['message'];
        if ($result['status'] === 'success') {
            header('Location: index.php');
            exit;
        }
    }
    return [
        'view' => __DIR__ . '/../vue/connexion_vue.php',
        'data' => ['message' => $message]
    ];
}

function afficherDeconnexion() {
    logout();
    return [
        'view' => __DIR__ . '/../vue/deconnexion_vue.php',
        'data' => []
    ];
}
