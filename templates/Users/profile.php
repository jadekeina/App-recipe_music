<?php
$this->assign('title', 'Mon profil');
?>

<h1>Mon compte</h1>

<!-- ======= INFORMATIONS PERSONNELLES ======= -->
<section>
    <h2>Informations personnelles</h2>
    <p>Nom d'utilisateur : <?= h($user->username) ?></p>
    <p>Membre depuis : <?= $user->created->format('d/m/Y') ?></p>

    <!-- ✅ Bouton de déconnexion ajouté ici -->
    <?= $this->Html->link(
        'Se déconnecter',
        ['controller' => 'Users', 'action' => 'logout'],
        ['class' => 'btn-logout']
    ) ?>
</section>

<!-- ======= RECETTES FAVORITES ======= -->
<section>
    <h2>Mes recettes favorites</h2>

    <?php if (empty($user->favorites)) : ?>
        <p>Vous n'avez pas encore de recettes favorites.</p>

    <?php else : ?>

        <?php foreach ($user->favorites as $favorite) : ?>
            <div>
                <?= $this->Html->link(
                    h($favorite->recipe->title),
                    ['controller' => 'Recipes', 'action' => 'view', $favorite->recipe->id]
                ) ?>
                <p>Durée : <?= h($favorite->recipe->duration) ?> minutes</p>
            </div>
        <?php endforeach; ?>

    <?php endif; ?>
</section>