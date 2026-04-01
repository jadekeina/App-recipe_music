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
        echo $this->Html->link('Let Us Cook', ['controller' => 'Home', 'action' => 'display']);
        ?>

        <nav>
            <?php
            $identity = $this->request->getAttribute('identity');
            ?>

            <?php if ($identity) : ?>

                <?php
                // ✅ Espace ajouté après "Bonjour,"
                echo 'Bonjour, ' . h($identity->username);
                ?>

                <?php
                // ✅ Lien de déconnexion ajouté
                echo $this->Html->link('Se déconnecter', ['controller' => 'Users', 'action' => 'logout']);
                ?>

            <?php else : ?>

                <?php
                echo $this->Html->link('Se connecter', ['controller' => 'Users', 'action' => 'login']);
                ?>

                <?php
                echo $this->Html->link('S\'inscrire', ['controller' => 'Users', 'action' => 'register']);
                ?>

            <?php endif; ?>

        </nav>
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

