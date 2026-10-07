<?php
$base_url = '/PHP/evensa_php';
require_once 'config/database.php';
require_once 'includes/header.php';

$stmt = $pdo->query("SELECT er.*, u.name as organisateur, i.nom as instance_nom 
                     FROM event_requests er 
                     JOIN users u ON er.user_id = u.id 
                     JOIN instances i ON er.instance_id = i.id 
                     WHERE er.statut = 'commission_validated' AND er.date_fin >= NOW() 
                     ORDER BY er.date_debut DESC");
$events = $stmt->fetchAll();

$typeBadge = [
    'scientifique' => 'badge-type-scientifique',
    'culturel'     => 'badge-type-culturel',
    'sportif'      => 'badge-type-sportif',
];
$cardStripes = ['event-card__stripe--blue', 'event-card__stripe--green', 'event-card__stripe--yellow', 'event-card__stripe--purple', 'event-card__stripe--orange', 'event-card__stripe--red'];
?>

<header class="page-hero-compact">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="section-eyebrow">Vitrine publique</span>
        <h1>Événements à venir</h1>
        <p class="text-slate-600 max-w-2xl text-lg">Découvrez les événements scientifiques, culturels et sportifs validés par l'ISGI Khouribga.</p>
    </div>
</header>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <?php if (empty($events)): ?>
        <div class="myevent-empty">
            <div class="myevent-empty__icon">📅</div>
            <h3 class="text-lg font-semibold text-slate-900">Aucun événement à venir</h3>
            <p class="mt-2 text-slate-500">Revenez plus tard pour découvrir de nouveaux événements.</p>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($events as $i => $event):
                $type = strtolower($event['type'] ?? '');
                $badgeClass = $typeBadge[$type] ?? 'badge-type-autre';
                $stripe = $cardStripes[$i % count($cardStripes)];
            ?>
                <article class="event-card">
                    <div class="event-card__stripe <?= $stripe ?>"></div>
                    <div class="p-6 flex-grow">
                        <div class="flex justify-between items-start mb-4">
                            <span class="badge <?= $badgeClass ?>"><?= htmlspecialchars(ucfirst($event['type'])) ?></span>
                            <span class="text-sm text-slate-500 font-medium">
                                <?= date('d/m/Y', strtotime($event['date_debut'])) ?>
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2"><?= htmlspecialchars($event['titre']) ?></h3>
                        <p class="text-slate-600 text-sm mb-4 line-clamp-3"><?= nl2br(htmlspecialchars($event['description'])) ?></p>
                        <p class="text-sm text-slate-500 mb-1">📍 <?= htmlspecialchars($event['lieu']) ?></p>
                        <p class="text-sm text-slate-500">🏛️ <?= htmlspecialchars($event['instance_nom']) ?></p>
                    </div>
                    <div class="event-card__footer">
                        <p class="text-xs text-slate-500">Organisé par <span class="font-semibold text-slate-700"><?= htmlspecialchars($event['organisateur']) ?></span></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>
