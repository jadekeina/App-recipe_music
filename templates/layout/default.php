<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    // Génère automatiquement la balise <meta charset="utf-8">
    echo $this->Html->charset();
    ?>

    <!-- Balise meta pour le responsive design sur mobile -->
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
        // 1. On récupère les informations de la page actuelle
        $controller = $this->request->getParam('controller');
        $action = $this->request->getParam('action');
        $pass = $this->request->getParam('pass');

        // 2. On définit les pages "interdites" de navigation
        $isHomePage = ($controller === 'Pages' && $action === 'display' && ($pass[0] ?? '') === 'home');
        $isAuthPage = ($controller === 'Users' && ($action === 'login' || $action === 'add'));

        // 3. On affiche la NAV uniquement si on n'est NI sur la Home, NI sur Login, NI sur Register
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
    </footer>

    <?php

    echo $this->Html->script('main');
    ?>

</body>
</html>

