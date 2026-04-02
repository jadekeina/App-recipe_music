<?php

$this->assign('title', 'Ajouter une recette');
?>

<h1>Ajouter une recette</h1>

<?php

echo $this->Form->create($recipe);
?>

    <?php

    echo $this->Form->control('title', [
        'label' => 'Titre de la recette',
    ]);
    ?>

    <?php

    echo $this->Form->control('image', ['type' => 'file', 'label' => 'Photo de la recette']);
    ?>

  <?php
    echo $this->Form->control('ingredients', [
        'label' => 'Ingrédients',
        'type' => 'textarea',
    ]);
    ?>

    <?php

    echo $this->Form->control('steps', [
        'label' => 'Étapes de préparation',
        'type' => 'textarea',
    ]);
    ?>

    <?php

    echo $this->Form->control('duration', [
        'label' => 'Durée en minutes',
        'type' => 'number',
    ]);
    ?>

    <?php

    echo $this->Form->control('spotify_playlist_id',[
        'label' => 'Lien Spotify (optionnel)',
        'type' => 'text',
    ]);
    ?>

    <?php

    echo $this->Form->button('Ajouter la recette');
    ?>

<?php

echo $this->Form->end();
?>

<?php

echo $this->Html->link(
    'Annuler',
    ['action' => 'index']
);
?>

