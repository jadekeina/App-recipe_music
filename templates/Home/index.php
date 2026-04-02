<h2>test</h2>

<?= $this->Html->link('Se déconnecter', 
    ['controller' => 'Users', 'action' => 'logout'], 
    ['class' => 'btn-logout', 'style' => 'color: red; font-weight: bold;']
) ?>