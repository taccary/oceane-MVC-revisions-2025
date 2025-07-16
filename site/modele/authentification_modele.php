<?php
// Modèle d'authentification
include_once "bd.inc.php";

/**
 * Cette fonction permet de gérer la connexion d'un utilisateur. Elle vérifie les identifiants fournis et, si valides, initialise la session de l'utilisateur.
 *
 * @param string $username
 * @param string $password
 * @return array
 */
function login(string $username, string $password) : array {
    $connexion = getPDO();
    $requete = "SELECT * FROM utilisateur WHERE mailU = :username";
    $stmt = $connexion->prepare($requete);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    if ($user && password_verify($password, $user['mdpU'])) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['mailU']
        ];
        return ['status' => 'success', 'message' => 'Connexion réussie'];
    }
    return ['status' => 'error', 'message' => 'Identifiants invalides'];
}

/**
 * Cette fonction permet de gérer la déconnexion d'un utilisateur. Elle détruit la session en cours.
 *
 * @return void
 */
function logout() : void {
    unset($_SESSION['user']);
    session_destroy();
}

/**
 * Cette fonction permet de vérifier si un utilisateur est authentifié.
 *
 * @return bool
 */
function isAuthenticated() : bool {
    return isset($_SESSION['user']);
}

/**
 * Cette fonction permet de récupérer les rôles de l'utilisateur connecté.
 * Elle peut être utilisée pour vérifier les permissions d'accès à certaines ressources.
 *
 * @return array|null
 */
function getUserRoles() : array|null {
    // fonction à ecrire pour récupérer les rôle de l'utilisateur et les logger en session
    return null;
}
