<?php

$this->assign('title', 'Les recettes');
?>

<h1>Les recettes</h1>

<?php

$identity = $this->request->getAttribute('identity');
if ($identity) :
    echo $this->Html->link(
        'Ajouter une recette',
        ['action' => 'add']
    );
endif;
?>

<?php

if (empty($recipes)) :
?>

    <p>Aucune recette pour le moment, ajoutez-en une !</p>

<?php

else :
?>

    <?php
    foreach ($recipes as $recipe) :
    ?>

        <div>
            <?php

            echo $this->Html->link(
                h($recipe->title),
                ['action' => 'view', $recipe->id]
            );
            ?>

            <p>Durée : <?= h($recipe->duration) ?> minutes</p>

            <p>Ajoutée par : <?= h($recipe->user->username) ?></p>

        </div>
    <?php endforeach; ?>
<?php endif; ?>
