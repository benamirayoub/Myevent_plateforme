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
