<h1>Connexion</h1>

<?php

echo $this->Form->create();
?>

    <?php

    echo $this->Form->control('username', [
        'label' => 'Nom utilisateur',
        'type' => 'username',
    ]);
    ?>

    <?php

    echo $this->Form->control('password', [
        'label' => 'Mot de passe',
        'type' => 'password',
    ]);
    ?>

    <?php

    echo $this->Form->button('Se connecter');
    ?>

<?php

echo $this->Form->end();
?>

<p>
    Pas encore de compte ?
    <?= $this->Html->link('S\'inscrire', ['action' => 'register']) ?>
</p>