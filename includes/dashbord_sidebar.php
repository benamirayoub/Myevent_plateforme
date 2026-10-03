<?php
$dashboard_active = $dashboard_active ?? '';
?>
<aside class="myevent-sidebar w-64 hidden md:block">
    <div class="p-6">
        <h2 class="sidebar-title">Tableau de bord</h2>
        <nav>
            <a href="index.php" class="<?= $dashboard_active === 'index' ? 'active' : '' ?>">Accueil</a>
            <a href="requests.php" class="<?= $dashboard_active === 'requests' ? 'active' : '' ?>">Mes demandes</a>
            <?php if (in_array($_SESSION['role'], ['etudiant', 'professeur', 'admin'])): ?>
            <a href="create_request.php" class="<?= $dashboard_active === 'create' ? 'active' : '' ?>">Nouvelle demande</a>
            <?php endif; ?>

            <?php if (isAdmin()): ?>
                <div class="pt-4 mt-4 border-t border-slate-100">
                    <h2 class="sidebar-title">Administration</h2>
                    <a href="invitations.php" class="<?= $dashboard_active === 'invitations' ? 'active' : '' ?>">Invitations</a>
                    <a href="instances.php" class="<?= $dashboard_active === 'instances' ? 'active' : '' ?>">Instances (Clubs, etc.)</a>
                </div>
            <?php endif; ?>
        </nav>
    </div>
</aside>
