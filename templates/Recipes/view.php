<?php

$this->assign('title', h($recipe->title));
?>

<h1><?= h($recipe->title) ?></h1>

<p>Ajoutée par : <?= h($recipe->user->username) ?></p>
<p>Durée : <?= h($recipe->duration) ?> minutes</p>

<h2>Ingrédients</h2>
<p><?= h($recipe->ingredients) ?></p>

<h2>Les étapes de préparation</h2>
<p><?= h($recipe->steps) ?></p>

<?= $this->Html->link('Retour aux recettes', ['action' => 'index']) ?>