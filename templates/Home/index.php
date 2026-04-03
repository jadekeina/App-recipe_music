<div class="page">
    <h2 class="titre">Nos dernières recettes :</h2>

    <div class="grille">
        <?php foreach ($recipes as $recipe): ?>
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
                                <span>' . ($recipe->hasValue("user") ? h($recipe->user->username) : "Auteur inconnu") . '</span>
                            </div>
                        </div>
                    </div>
                ', 
                ['controller' => 'Recipes', 'action' => 'view', $recipe->id], 
                ['escape' => false, 'class' => 'card-link'] 
                ) ?>

                <div class="likes">
                    <?php if ($this->request->getAttribute('identity')): ?>
                        <?= $this->Form->postLink(
                            '<i class="fa-solid fa-heart"></i>',
                            ['controller' => 'Favorites', 'action' => 'toggle', $recipe->id],
                            ['escape' => false, 'class' => 'fav-btn']
                        ) ?>
                    <?php else: ?>
                        <?= $this->Html->link('<i class="fa-regular fa-heart"></i>', 
                            ['controller' => 'Users', 'action' => 'login'], 
                            ['escape' => false, 'class' => 'fav-btn']) 
                        ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>