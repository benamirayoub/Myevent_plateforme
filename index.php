<?php
require_once 'includes/header.php';
?>

<section class="hero-premium">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="hero-grid">
            <div class="hero-premium__content animate-fade-in">
                <div class="hero-badge">
                    <span class="hero-badge__dot"></span>
                    Plateforme officielle ISGI
                </div>
                <h1>Gérez vos événements avec excellence</h1>
                <p class="hero-premium__lead">
                    Soumission, validation et publication des événements scientifiques, culturels et sportifs — en un seul endroit, pour toute l'école.
                </p>
                <div class="hero-cta-group">
                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <a href="login.php" class="btn-hero-primary">Se connecter →</a>
                    <?php else: ?>
                        <a href="dashboard/index.php" class="btn-hero-primary">Tableau de bord →</a>
                    <?php endif; ?>
                    <a href="events.php" class="btn-hero-secondary">Voir les événements</a>
                </div>
            </div>

            <div class="hero-visual">
                <div class="hero-mockup animate-fade-in">
                    <div class="hero-mockup__bar">
                        <span></span><span></span><span></span>
                    </div>
                    <div class="hero-mockup__line"></div>
                    <div class="hero-mockup__line hero-mockup__line--short"></div>
                    <div class="hero-mockup__line hero-mockup__line--accent"></div>
                    <div class="hero-mockup__line hero-mockup__line--short"></div>
                    <div class="hero-mockup__tags">
                        <span class="hero-mockup__tag hero-mockup__tag--b">Scientifique</span>
                        <span class="hero-mockup__tag hero-mockup__tag--g">Validé</span>
                        <span class="hero-mockup__tag hero-mockup__tag--y">Culturel</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="stats-strip">
    <div class="stats-strip__inner">
        <div class="stat-pill">
            <div class="stat-pill__value stat-pill__value--blue">3</div>
            <div class="stat-pill__label">Étapes claires</div>
        </div>
        <div class="stat-pill">
            <div class="stat-pill__value stat-pill__value--green">100%</div>
            <div class="stat-pill__label">Traçabilité</div>
        </div>
        <div class="stat-pill">
            <div class="stat-pill__value stat-pill__value--yellow">24/7</div>
            <div class="stat-pill__label">Accès en ligne</div>
        </div>
        <div class="stat-pill">
            <div class="stat-pill__value stat-pill__value--purple">ISGI</div>
            <div class="stat-pill__label">Khouribga</div>
        </div>
    </div>
</div>

<section class="section-premium section-premium--alt">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="section-header-center">
            <span class="section-eyebrow">Processus</span>
            <h2 class="section-title">Comment ça marche ?</h2>
            <p class="section-subtitle">Un workflow transparent, de la soumission à la publication publique.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="step-card">
                <div class="step-number step-number--blue">1</div>
                <h3 class="text-xl font-bold mb-3 text-brand-blue">Soumission</h3>
                <p class="text-slate-600">Formulaire complet, pièces jointes et choix de l'instance organisatrice.</p>
            </div>
            <div class="step-card">
                <div class="step-number step-number--green">2</div>
                <h3 class="text-xl font-bold mb-3 text-brand-green">Validation</h3>
                <p class="text-slate-600">Examen par le directeur puis la commission compétente.</p>
            </div>
            <div class="step-card">
                <div class="step-number step-number--yellow">3</div>
                <h3 class="text-xl font-bold mb-3 text-brand-yellow">Publication</h3>
                <p class="text-slate-600">Événement visible sur la vitrine publique une fois approuvé.</p>
            </div>
        </div>
    </div>
</section>

<section class="section-premium">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="section-header-center">
            <span class="section-eyebrow">Avantages</span>
            <h2 class="section-title">Pourquoi Myevent ?</h2>
            <p class="section-subtitle">Une expérience pensée pour les étudiants, enseignants et administrateurs.</p>
        </div>

        <div class="features-premium">
            <article class="feature-premium">
                <div class="feature-premium__icon feature-premium__icon--blue">📋</div>
                <h3>Demandes simplifiées</h3>
                <p>Créez et suivez vos demandes d'événements en quelques clics, avec historique complet.</p>
            </article>
            <article class="feature-premium">
                <div class="feature-premium__icon feature-premium__icon--green">✓</div>
                <h3>Validation structurée</h3>
                <p>Circuit d'approbation clair : directeur d'instance, puis commission.</p>
            </article>
            <article class="feature-premium">
                <div class="feature-premium__icon feature-premium__icon--purple">📅</div>
                <h3>Vitrine publique</h3>
                <p>Les événements validés sont publiés automatiquement pour toute la communauté.</p>
            </article>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
