<div class="page">
    <h2 class="titre">Nos dernières recettes :</h2>

    <div class="grille">
        <?php foreach ($recipes as $recipe): ?>
            <?= $this->Html->link('
                <div class="carte">
                    <div class="img-box">
                        <span class="tag temps">' . h($recipe->duration) . ' min</span>

                        ' . $this->Html->image("recipes/" . (!empty($recipe->image) ? $recipe->image : "default.jpg"), [
                            "alt" => h($recipe->title), 
                            "class" => "photo"
                        ]) . '
                        
                        <div class="likes">
                            <i class="fa-regular fa-heart"></i>
                            <span>110</span>
                        </div>
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
        <?php endforeach; ?>
    </div>

    <div class="bas-page">
        <?= $this->Html->link('Se déconnecter',
            ['controller' => 'Users', 'action' => 'logout'],
            ['class' => 'btn-deco']
        ) ?>
    </div>
</div>