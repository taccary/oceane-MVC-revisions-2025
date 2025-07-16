<?php
// Modèle d'authentification
include_once "bd.inc.php";

function login($username, $password) : array {
    $connexion = getPDO();
    $requete = "SELECT * FROM utilisateur WHERE username = :username";
    $stmt = $connexion->prepare($requete);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'role' => $user['role']
        ];
        return ['status' => 'success', 'message' => 'Connexion réussie'];
    }
    return ['status' => 'error', 'message' => 'Identifiants invalides'];
}

function logout() {
    unset($_SESSION['user']);
    session_destroy();
}

function isAuthenticated() : bool {
    return isset($_SESSION['user']);
}

function getUserRole() {
    return $_SESSION['user']['role'] ?? null;
}
