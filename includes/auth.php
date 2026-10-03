<?php
// includes/auth.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Définir le chemin de base si non défini
if (!isset($base_url)) {
    $base_url = '/platforme des événements'; // Remplacez par le chemin de base approprié
}

// Redirection si non connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: " . $base_url . "/login.php");
    exit;
}

// Fonction utilitaire pour vérifier les rôles
function hasRole($roles) {
    if (!isset($_SESSION['role'])) return false;
    
    if (is_array($roles)) {
        return in_array($_SESSION['role'], $roles);
    }
    return $_SESSION['role'] === $roles;
}

function isAdmin() {
    return hasRole(['admin', 'chef_commission']);
}

// Forcer l'accès admin pour certaines pages
function requireAdmin() {
    global $base_url;
    if (!isAdmin()) {
        die("Accès refusé. Vous devez être administrateur.");
    }
}
?>
