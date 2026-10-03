<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard/index.php");
    exit;
}

require_once 'config/database.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $error = "Veuillez remplir tous les champs.";
    } else {
        $stmt = $pdo->prepare("SELECT id, name, email, password, role, instance_id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && md5($password) === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['instance_id'] = $user['instance_id'];
            header("Location: dashboard/index.php");
            exit;
        } else {
            $error = "Email ou mot de passe incorrect.";
        }
    }
}

require_once 'includes/header.php';
?>

<div class="auth-premium">
    <aside class="auth-premium__brand">
        <div class="auth-premium__brand-content">
            <div class="myevent-auth-logo">M</div>
            <h2>Bienvenue sur Myevent</h2>
            <p>La plateforme de référence pour organiser, valider et promouvoir les événements de l'ISGI Khouribga.</p>
            <div class="hero-mockup__tags mt-8">
                <span class="hero-mockup__tag hero-mockup__tag--b">Sécurisé</span>
                <span class="hero-mockup__tag hero-mockup__tag--g">Officiel</span>
                <span class="hero-mockup__tag hero-mockup__tag--y">Simple</span>
            </div>
        </div>
    </aside>

    <div class="auth-premium__panel">
        <div class="auth-premium__card animate-fade-in">
            <h2>Connexion</h2>
            <p class="text-center text-sm text-slate-500 mt-2 mb-6">Accédez à votre espace personnel</p>

            <?php if ($error): ?>
                <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form action="login.php" method="POST" class="space-y-5">
                <div>
                    <label for="email" class="myevent-label">Adresse email</label>
                    <input id="email" name="email" type="email" required class="myevent-input admin-input admin-input--lg"
                           placeholder="prenom.nom@isgi.ma"
                           value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                </div>
                <div>
                    <label for="password" class="myevent-label">Mot de passe</label>
                    <input id="password" name="password" type="password" required class="myevent-input admin-input admin-input--lg"
                           placeholder="••••••••">
                </div>
                <button type="submit" class="btn btn-primary btn--lg w-full">Se connecter</button>
            </form>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
