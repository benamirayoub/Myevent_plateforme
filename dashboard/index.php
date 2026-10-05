<?php
$base_url = '/platforme des événements'; // Remplacez par le chemin de base approprié
require_once '../includes/auth.php';
require_once '../config/database.php';
require_once '../includes/header.php';

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

$stats = ['my_requests' => 0, 'pending_validation' => 0];

$stmt = $pdo->prepare("SELECT COUNT(*) FROM event_requests WHERE user_id = ?");
$stmt->execute([$user_id]);
$stats['my_requests'] = $stmt->fetchColumn();

if (in_array($role, ['admin', 'chef_commission', 'secretaire'])) {
    $stmt = $pdo->query("SELECT COUNT(*) FROM event_requests WHERE statut = 'director_approved'");
    $stats['pending_validation'] = $stmt->fetchColumn();
} elseif ($role === 'directeur' && isset($_SESSION['instance_id'])) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM event_requests WHERE instance_id = ? AND statut = 'waiting_director'");
    $stmt->execute([$_SESSION['instance_id']]);
    $stats['pending_validation'] = $stmt->fetchColumn();
}

$dashboard_active = 'index';
?>

<div class="myevent-dashboard flex-grow flex">
    <?php require_once '../includes/dashboard_sidebar.php'; ?>

    <div class="flex-1 p-8 max-w-6xl">
        <div class="dashboard-welcome flex flex-wrap justify-between items-start gap-4">
            <div>
                <h1>Bonjour, <?= htmlspecialchars($_SESSION['name']) ?> 👋</h1>
                <p>Votre espace de gestion d'événements Myevent</p>
                <span class="role-badge"><?= ucfirst(str_replace('_', ' ', $_SESSION['role'])) ?></span>
            </div>
            <?php if (in_array($_SESSION['role'], ['etudiant', 'professeur', 'admin'])): ?>
                <a href="create_request.php" class="btn-hero-primary text-sm !min-h-[44px]">+ Nouvelle demande</a>
            <?php endif; ?>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <?php if (in_array($_SESSION['role'], ['etudiant', 'professeur', 'admin'])): ?>
            <div class="stat-card">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="stat-label">Mes demandes</h3>
                    <div class="stat-icon stat-icon--blue">📄</div>
                </div>
                <p class="stat-value"><?= $stats['my_requests'] ?></p>
            </div>
            <?php endif; ?>

            <?php if (in_array($role, ['admin', 'directeur', 'chef_commission', 'secretaire'])): ?>
            <div class="stat-card">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="stat-label">À valider</h3>
                    <div class="stat-icon stat-icon--yellow">⏳</div>
                </div>
                <p class="stat-value"><?= $stats['pending_validation'] ?></p>
            </div>
            <?php endif; ?>
        </div>

        <div class="myevent-card p-8">
            <h2 class="text-lg font-bold mb-2">Activité récente</h2>
            <p class="text-slate-500 text-sm">Consultez vos demandes dans l'onglet « Mes demandes » pour suivre leur progression.</p>
            <a href="requests.php" class="inline-flex mt-4 text-brand-blue font-semibold text-sm hover:underline">Voir mes demandes →</a>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
