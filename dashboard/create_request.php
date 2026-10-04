<?php $dashboard_active = 'create'; ?>
<div class="myevent-dashboard flex-grow flex">
    <?php require_once '../includes/dashboard_sidebar.php'; ?>

    <!-- Main Content -->
    <div class="flex-1 p-8">
        <div class="max-w-3xl">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Nouvelle Demande d'Événement</h1>
            <p class="text-gray-500 mb-8">Remplissez ce formulaire pour proposer un nouvel événement.</p>

            <?php if ($error): ?>
                <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($success) ?>
                    <div class="mt-2">
                        <a href="requests.php" class="text-sm font-medium underline hover:text-green-800">Voir mes demandes</a>
                    </div>
                </div>
            <?php else: ?>

            <form action="create_request.php" method="POST" enctype="multipart/form-data" class="myevent-card p-8">
                <div class="space-y-6">
                    <div>
                        <label class="myevent-label">Titre de l'événement <span class="text-red-500">*</span></label>
                        <input type="text" name="titre" required class="myevent-input">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="myevent-label">Type <span class="text-red-500">*</span></label>
                            <select name="type" required class="myevent-input">
                                <option value="scientifique">Scientifique</option>
                                <option value="culturel">Culturel</option>
                                <option value="sportif">Sportif</option>
                                <option value="social">Social</option>
                            </select>
                        </div>
                        <div>
                            <label class="myevent-label">Instance organisatrice <span class="text-red-500">*</span></label>
                            <select name="instance_id" required class="myevent-input">
                                <option value="">Sélectionner une instance</option>
                                <?php foreach($instances as $inst): ?>
                                    <option value="<?= $inst['id'] ?>" <?= (isset($_SESSION['instance_id']) && $_SESSION['instance_id'] == $inst['id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($inst['nom']) ?> (<?= htmlspecialchars($inst['type']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="myevent-label">Date de début <span class="text-red-500">*</span></label>
                            <input type="datetime-local" name="date_debut" required class="myevent-input">
                        </div>
                        <div>
                            <label class="myevent-label">Date de fin <span class="text-red-500">*</span></label>
                            <input type="datetime-local" name="date_fin" required class="myevent-input">
                        </div>
                    </div>

                    <div>
                        <label class="myevent-label">Lieu <span class="text-red-500">*</span></label>
                        <input type="text" name="lieu" required placeholder="Amphi A, Salle 12..." class="myevent-input">
                    </div>

                    <div>
                        <label class="myevent-label">Description <span class="text-red-500">*</span></label>
                        <textarea name="description" rows="4" required class="myevent-input"></textarea>
                    </div>
                    
                    <div>
                        <label class="myevent-label">Pièce jointe (PDF, Image...)</label>
                        <input type="file" name="attachment" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-isgi/10 file:text-isgi hover:file:bg-isgi/20">
                    </div>
                </div>

                <div class="mt-8 flex gap-4">
                    <button type="submit" name="action" value="draft" class="btn-secondary">
                        Sauvegarder brouillon
                    </button>
                    <button type="submit" name="action" value="submit" class="btn-primary">
                        Soumettre la demande
                    </button>
                </div>
            </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
