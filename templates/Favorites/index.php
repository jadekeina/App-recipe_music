<div class="page">
    <h2 class="titre">Mes Recettes Favorites</h2>

    <div class="grille">
        <?php if ($favorites->isEmpty()): ?>
            <p class="empty-msg">Vous n'avez pas encore de favoris. <br> 
               <?= $this->Html->link('Parcourir les recettes', ['controller' => 'Home', 'action' => 'index']) ?>
            </p>
        <?php else: ?>
            <?php foreach ($favorites as $fav): ?>
                <?php $recipe = $fav->recipe;  ?>
                
                <div class="carte-container" style="position: relative;">
                    <?= $this->Html->link('
                        <div class="carte">
                            <div class="img-box">
                                <span class="tag temps">' . h($recipe->duration) . ' min</span>
                                ' . $this->Html->image("recipes/" . (!empty($recipe->image) ? $recipe->image : "default.jpg"), [
                                    "alt" => h($recipe->title), 
                                    "class" => "photo"
                                ]) . '
                            </div>

                            <div class="infos">
                                <h3 class="nom">' . h($recipe->title) . '</h3>
                                <div class="auteur">
                                    <span>Auteur inconnu</span>
                                </div>
                            </div>
                        </div>
                    ', 
                    ['controller' => 'Recipes', 'action' => 'view', $recipe->id], 
                    ['escape' => false, 'class' => 'card-link'] 
                    ) ?>

                    <div class="likes"">
                        <?= $this->Form->postLink(
                            '<i class="fa-solid fa-heart"></i>',
                            ['controller' => 'Favorites', 'action' => 'toggle', $recipe->id],
                            [
                                'escape' => false, 
                                'class' => 'fav-btn active-fav',
                                'confirm' => 'Voulez-vous vraiment retirer cette recette de vos favoris ?'
                            ]
                        ) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>