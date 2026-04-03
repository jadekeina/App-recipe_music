<div class="profile-page">
    <h1 class="main-title">Mon compte</h1>

    <div class="info-card">
        <h2 class="section-subtitle"><i class="fa-solid fa-user-circle"></i> Informations personnelles</h2>
        <div class="info-row">
            <span class="label">Nom d'utilisateur :</span>
            <span class="value"><?= h($user->username) ?></span>
        </div>
        <div class="info-row">
            <span class="label">Membre depuis :</span>
            <span class="value"><?= $user->created->format('d/m/Y') ?></span>
        </div>
        
        <?= $this->Html->link(
            '<i class="fa-solid fa-power-off"></i> Se déconnecter',
            ['controller' => 'Users', 'action' => 'logout'],
            ['class' => 'logout-link', 'escape' => false]
        ) ?>
    </div>

    <div class="info-card">
        <h2 class="section-subtitle"><i class="fa-solid fa-heart"></i> Mes recettes favorites</h2>

        <?php if (empty($user->favorites)) : ?>
            <p class="empty-msg">Vous n'avez pas encore de recettes favorites.</p>
        <?php else : ?>
            <div class="fav-list">
                <?php foreach ($user->favorites as $favorite) : ?>
                    <div class="fav-item">
                        <?= $this->Html->link(
                            h($favorite->recipe->title),
                            ['controller' => 'Recipes', 'action' => 'view', $favorite->recipe->id],
                            ['class' => 'fav-title']
                        ) ?>
                        <span class="fav-duration"><i class="fa-regular fa-clock"></i> <?= h($favorite->recipe->duration) ?> min</span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>