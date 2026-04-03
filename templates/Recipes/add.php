<?php
$this->assign('title', 'Ajouter une recette');
$identity = $this->request->getAttribute('identity');
$isAdmin = ($identity && $identity->get('role') === 'admin'); 
?>

<div class="page">
    <h1 class="titre">Ajouter une recette</h1>

    <?= $this->Form->create($recipe, ['type' => 'file', 'class' => 'form-container']) ?>
    
    <div class="form-group">
        <?= $this->Form->control('title', ['label' => 'Titre de la recette', 'placeholder' => 'Ex: Carbonara à ma façon']) ?>
    </div>

    <div class="form-group">
        <?= $this->Form->control('image', ['type' => 'file', 'label' => 'Photo de la recette', 'class' => 'input-file']) ?>
    </div>

    <div class="form-row">
        <div class="form-group">
            <?= $this->Form->control('duration', ['label' => 'Durée (min)', 'type' => 'number']) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('spotify_playlist_id', ['label' => 'Lien Spotify', 'type' => 'text', 'placeholder' => 'https://open.spotify...']) ?>
        </div>
    </div>

    <div class="form-group">
        <?= $this->Form->control('ingredients', ['label' => 'Ingrédients', 'type' => 'textarea', 'rows' => '5']) ?>
    </div>

    <div class="form-group">
        <?= $this->Form->control('steps', ['label' => 'Étapes', 'type' => 'textarea', 'rows' => '5']) ?>
    </div>


    <div class="form-actions">
        <?= $this->Form->button($isAdmin ? 'Créer et Valider' : 'Envoyer pour validation', ['class' => 'btn-play', 'style' => 'width: 100%;']) ?>
        <?= $this->Html->link('Annuler', ['action' => 'index'], ['class' => 'btn-cancel']) ?>
    </div>

    <?= $this->Form->end() ?>

    <div class="grille">
            <?php if (empty($pending)): ?>
                <p>Aucune recette à valider pour le moment.</p>
            <?php else: ?>
                <?php foreach ($pending as $p): ?>
                    <div class="carte" style="background: #fff; padding: 15px; border-radius: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                        <h4 style="margin:0;"><?= h($p->title) ?></h4>
                        <small>Par : <?= h($p->user->username) ?></small>
                        
                        <div style="display: flex; gap: 10px; margin-top: 10px;">
                            <?= $this->Form->postLink('Valider', 
                                ['action' => 'publish', $p->id], 
                                ['class' => 'btn-small-valid', 'style' => 'background: #1DB954; color: white; padding: 5px 10px; border-radius: 5px; text-decoration:none;']) 
                            ?>
                            
                            <?= $this->Form->postLink('Refuser', 
                                ['action' => 'delete', $p->id], 
                                ['confirm' => 'Supprimer cette proposition ?', 'style' => 'color: #e74c3c; font-size: 0.9rem;']) 
                            ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
</div>