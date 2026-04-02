<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <?php
    // Génère automatiquement la balise <meta charset="utf-8">
    echo $this->Html->charset();
    ?>

  
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php

    echo $this->Html->tag('title', $this->fetch('title') ?? 'Let Us Cook');
    ?>

    <?php

    echo $this->Html->css('main');
    ?>

</head>

<body>

    <header>

        <?php

        $controller = $this->request->getParam('controller');
        $action = $this->request->getParam('action');
        $pass = $this->request->getParam('pass');

        $isHomePage = ($controller === 'Pages' && $action === 'display' && ($pass[0] ?? '') === 'home');
        $isAuthPage = ($controller === 'Users' && ($action === 'login' || $action === 'add'));

        ?>

        <?php if (!$isHomePage && !$isAuthPage): ?>

        <nav>
            <?php
            $identity = $this->request->getAttribute('identity');
            ?>

            <?php if ($identity) : ?>

                <?php
                // ✅ Espace ajouté après "Bonjour,"
                //echo 'Bonjour, ' . h($identity->username);
                ?>

                <?php
                // ✅ Lien de déconnexion ajouté
                //echo $this->Html->link('Se déconnecter', ['controller' => 'Users', 'action' => 'logout']);
                ?>

            <?php else : ?>

                <?php
                //echo $this->Html->link('Se connecter', ['controller' => 'Users', 'action' => 'login']);
                ?>

                <?php
                //echo $this->Html->link('S\'inscrire', ['controller' => 'Users', 'action' => 'register']);
                ?>

            <?php endif; ?>

            <div class="top-nav-title">
                <a href="<?= $this->Url->build('/home') ?>"><span>Let's</span>Cook</a>
            </div>
            <div class="top-nav-links">
                <?= $this->Html->link('Accueil', '/home') ?>
                
                <?= $this->Html->link('Recettes', ['controller' => 'Recipes', 'action' => 'index']) ?>
                
                <?php if ($this->request->getAttribute('identity')): ?>
                    <?= $this->Html->link('Mes Favoris', ['controller' => 'Favorites', 'action' => 'index']) ?>
                <?php endif; ?>
            </div>
        </nav>

        <?php endif; ?>
    </header>

    <?php

    echo $this->Flash->render();
    ?>

    <main>
        <?php

        echo $this->fetch('content');
        ?>
    </main>

    <footer>

<nav class="menu">
    <?= $this->Html->link('<i class="fa-solid fa-house"></i>', ['controller' => 'Home', 'action' => 'index'], ['escape' => false, 'class' => 'menu-item']) ?>
    
    <?= $this->Html->link('<i class="fa-solid fa-magnifying-glass"></i>', ['controller' => 'Recipes', 'action' => 'index'], ['escape' => false, 'class' => 'menu-item']) ?>
    
    <?php 
  
    $user = $this->request->getAttribute('identity'); 
    
    if ($user): ?>
        <?= $this->Html->link('<i class="fa-solid fa-heart"></i>', ['controller' => 'Favorites', 'action' => 'index'], ['escape' => false, 'class' => 'menu-item']) ?>
        
        <?= $this->Html->link('<i class="fa-solid fa-circle-plus"></i>', ['controller' => 'Recipes', 'action' => 'add'], ['escape' => false, 'class' => 'menu-item add-btn']) ?>
        
        <?= $this->Html->link('<i class="fa-solid fa-user"></i>', ['controller' => 'Users', 'action' => 'view', $user->get('id')], ['escape' => false, 'class' => 'menu-item']) ?>
    <?php else: ?>
        <?= $this->Html->link('<i class="fa-solid fa-user-lock"></i>', ['controller' => 'Users', 'action' => 'login'], ['escape' => false, 'class' => 'menu-item']) ?>
    <?php endif; ?>
</nav>

    </footer>

    <?php

    echo $this->Html->script('main');
    ?>

</body>
</html>

