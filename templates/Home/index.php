<div class="page">
    <h2 class="titre">Nos dernières recettes :</h2>

    <div class="grille">
        <?php foreach ($recipes as $recipe): ?>
            <div class="carte">
                <div class="img-box">
                    <span class="tag temps"><?= h($recipe->duration) ?> min</span>
                    <span class="tag regime">Sans restriction</span>

                    

                    <?php 
        $photoName = !empty($recipe->image) ? $recipe->image : 'default.jpg';?>
    
    <?= $this->Html->image('recipes/' . $photoName, [
        'alt' => h($recipe->title), 
        'class' => 'photo'
    ]) ?>
                    <div class="likes">
                        <i class="fa-regular fa-heart"></i>
                        <span>110</span>
                    </div>
                </div>

                <div class="infos">
                    <h3 class="nom"><?= h($recipe->title) ?></h3>

                    <div class="auteur">
                        <img src="https://via.placeholder.com/30" class="avatar">
                        <span><?= $recipe->hasValue('user') ? h($recipe->user->username) : 'Auteur inconnu' ?></span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="bas-page">
        <?= $this->Html->link('Se déconnecter',
            ['controller' => 'Users', 'action' => 'logout'],
            ['class' => 'btn-deco']
        ) ?>
    </div>
</div>