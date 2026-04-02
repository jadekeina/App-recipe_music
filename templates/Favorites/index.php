<h1>Mes Recettes Favorites</h1>

<div class="recipes-list">
    <?php if ($favorites->isEmpty()): ?>
        <p>Vous n'avez pas encore de favoris.</p>
    <?php else: ?>
        <?php foreach ($favorites as $fav): ?>
            <div class="recipe-card">
                <h3><?= h($fav->recipe->title) ?></h3>
                <?= $this->Html->link('Voir la recette', ['controller' => 'Recipes', 'action' => 'view', $fav->recipe->id]) ?>
                <?= $this->Form->postLink('Supprimer', ['action' => 'toggle', $fav->recipe->id], ['confirm' => 'Retirer ?']) ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>