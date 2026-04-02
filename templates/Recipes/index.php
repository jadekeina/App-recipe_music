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

            <td>
                <?= $recipe->has('user') ? h($recipe->user->username) : '<span class="badge">Anonyme</span>' ?>
            </td>

        </div>
    <?php endforeach; ?>
<?php endif; ?>
