<?php

$this->assign('title', h($recipe->title));
?>

<h1><?= h($recipe->title) ?></h1>

<?php

$identity = $this->request->getAttribute('identity');
if ($identity) :
?>

<div class="favorite-section">
    <?= $this->Form->postLink(
        $isFavorite ? '❤️ Retirer des favoris' : '🤍 Ajouter aux favoris',
        ['controller' => 'Favorites', 'action' => 'toggle', $recipe->id],
        [
            'class' => 'btn-favorite',
            // Optionnel : affiche une petite boîte de dialogue de confirmation
            'confirm' => $isFavorite ? 'Voulez-vous retirer cette recette de vos favoris ?' : null 
        ]
    ) ?>
</div>

<?php else : ?>
    <p>
        <?= $this->Html->link(
            'Connectez-vous',
            [
                'controller' => 'Users',
                'action' => 'login',
                '?' => ['redirect' => $this->request->getRequestTarget()]
            ]
        ) ?>
        pour ajouter cette recette à vos favoris.
    </p>
<?php endif; ?>


<p>Ajoutée par : <?= $recipe->has('user') ? h($recipe->user->username) : 'Anonyme' ?></p>
<p>Durée : <?= h($recipe->duration) ?> minutes</p>

<h2>Ingrédients</h2>
<p><?= h($recipe->ingredients) ?></p>

<h2>Les étapes de préparation</h2>
<p><?= h($recipe->steps) ?></p>

<hr>

<h2>Playlist Spotify</h2>

<?php if (!empty($playlistId)): ?>
    <div class="spotify-container" style="margin: 20px 0;">
        <iframe 
            style="border-radius:12px" 
            src="https://open.spotify.com/embed/playlist/<?= h($playlistId) ?>?utm_source=generator" 
            width="100%" 
            height="352" 
            frameBorder="0" 
            allowfullscreen="" 
            allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" 
            loading="lazy">
        </iframe>
    </div>
<?php else: ?>
    <p>Aucune playlist associée à cette recette.</p>
<?php endif; ?>

<br>
<?= $this->Html->link('Retour aux recettes', ['action' => 'index'], ['class' => 'button']) ?>