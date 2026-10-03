<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$base_url = '/platforme des événements'; // Remplacez par le chemin de base approprié
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Myevent — Plateforme officielle de gestion d'événements ISGI Khouribga">
    <title>Myevent — ISGI Khouribga</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        isgi: '#2563eb',
                        'isgi-dark': '#1d4ed8',
                        brand: {
                            red: '#ef4444', green: '#22c55e', blue: '#3b82f6',
                            'blue-dark': '#2563eb', yellow: '#eab308', purple: '#8b5cf6',
                        }
                    },
                    fontFamily: { sans: ['Plus Jakarta Sans', 'system-ui', 'sans-serif'] }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="<?= $base_url ?>/public/style.css">
    <link rel="stylesheet" href="<?= $base_url ?>/public/premium.css">
</head>
<body class="myevent-app min-h-screen flex flex-col">

    <nav class="myevent-nav">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 myevent-nav-inner">
            <a href="<?= $base_url ?>/index.php" class="myevent-brand-block">
                <div class="brand-logo">M</div>
                <div>
                    <span class="brand-name">Myevent</span>
                    <span class="brand-tagline">ISGI Khouribga</span>
                </div>
            </a>

            <div class="myevent-nav-links hidden md:flex">
                <a href="<?= $base_url ?>/index.php"
                   class="myevent-nav-link <?= $current_page === 'index.php' ? 'myevent-nav-link--active' : '' ?>">Accueil</a>
                <a href="<?= $base_url ?>/events.php"
                   class="myevent-nav-link <?= $current_page === 'events.php' ? 'myevent-nav-link--active' : '' ?>">Événements</a>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="<?= $base_url ?>/dashboard/index.php" class="myevent-nav-link myevent-nav-link--active">Mon Espace</a>
                    <a href="<?= $base_url ?>/logout.php" class="myevent-nav-link myevent-nav-logout">Déconnexion</a>
                <?php else: ?>
                    <a href="<?= $base_url ?>/login.php" class="myevent-btn-login">Connexion</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <main class="flex-grow">
