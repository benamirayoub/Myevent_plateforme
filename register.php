<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard/index.php");
    exit;
}

require_once 'config/database.php';

$token = $_GET['token'] ?? '';
$error = '';

if (empty($token)) {
    die("Lien d'invitation invalide ou manquant.");
}

$stmt = $pdo->prepare("SELECT * FROM invitations WHERE token = ? AND used_at IS NULL AND (expires_at IS NULL OR expires_at > NOW())");
$stmt->execute([$token]);
$invitation = $stmt->fetch();

if (!$invitation) {
    die("Ce lien d'invitation a expiré, a déjà été utilisé, ou est invalide.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    if (empty($name) || empty($email) || empty($password)) {
        $error = "Veuillez remplir tous les champs.";
    } elseif ($email !== $invitation['email']) {
        $error = "L'adresse email doit correspondre à celle de l'invitation (" . htmlspecialchars($invitation['email']) . ").";
    } elseif ($password !== $password_confirm) {
        $error = "Les mots de passe ne correspondent pas.";
    } else {
        $hashed_password = md5($password);

        $pdo->beginTransaction();
        try {
            $stmt_user = $pdo->prepare("INSERT INTO users (name, email, password, role, instance_id) VALUES (?, ?, ?, ?, ?)");
            $stmt_user->execute([$name, $email, $hashed_password, $invitation['role'], $invitation['instance_id']]);
            $user_id = $pdo->lastInsertId();

            $stmt_inv = $pdo->prepare("UPDATE invitations SET used_at = NOW() WHERE id = ?");
            $stmt_inv->execute([$invitation['id']]);

            $pdo->commit();

            $_SESSION['user_id'] = $user_id;
            $_SESSION['name'] = $name;
            $_SESSION['role'] = $invitation['role'];
            $_SESSION['instance_id'] = $invitation['instance_id'];

            header("Location: dashboard/index.php?welcome=1");
            exit;
        } catch (\Exception $e) {
            $pdo->rollBack();
            $error = "Erreur lors de la création du compte : L'email existe peut-être déjà.";
        }
    }
}

require_once 'includes/header.php';
?>
<div class="auth-premium">
    <aside class="auth-premium__brand">
        <div class="auth-premium__brand-content">
            <div class="myevent-auth-logo">M</div>
            <h2>Rejoignez Myevent</h2>
            <p>Finalisez votre inscription pour accéder à la plateforme officielle de l'ISGI.</p>
        </div>
    </aside>
    <div class="auth-premium__panel">
        <div class="auth-premium__card animate-fade-in">
            <h2>Inscription</h2>
            <p class="text-center text-sm text-slate-500 mt-2 mb-6">
                Rôle : <strong class="text-brand-purple"><?= htmlspecialchars(ucfirst($invitation['role'])) ?></strong>
            </p>
            <?php if ($error): ?>
                <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form class="space-y-5" action="register.php?token=<?= htmlspecialchars($token) ?>" method="POST">
                <div>
                    <label class="myevent-label">Nom complet</label>
                    <input name="name" type="text" required class="admin-input admin-input--lg"
                           value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                </div>
                <div>
                    <label class="myevent-label">Email</label>
                    <input name="email" type="email" required readonly class="admin-input bg-slate-50 text-slate-500"
                           value="<?= htmlspecialchars($invitation['email']) ?>">
                </div>
                <div>
                    <label class="myevent-label">Mot de passe</label>
                    <input name="password" type="password" required class="admin-input admin-input--lg">
                </div>
                <div>
                    <label class="myevent-label">Confirmer</label>
                    <input name="password_confirm" type="password" required class="admin-input admin-input--lg">
                </div>
                <button type="submit" class="btn btn-primary btn--lg w-full">Créer mon compte</button>
            </form>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
