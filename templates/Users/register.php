<h1>Inscription</h1>

<?php

echo $this->Form->create($user);
?>

    <?php

    echo $this->Form->control('username', [
        'label' => 'Nom d\'utilisateur',
    ]);
    ?>

    <?php

    echo $this->Form->control('password', [
        'label' => 'Mot de passe',
        'type' => 'password',
    ]);
    ?>

    <?php

    echo $this->Form->button('S\'inscrire');
    ?>

<?php

echo $this->Form->end();
?>

<p>
    Déjà un compte ?
    <?= $this->Html->link('Se connecter', ['action' => 'login']) ?>
</p>