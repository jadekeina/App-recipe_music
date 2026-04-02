<div class="welcome-screen">
    <div class="welcome-content">

        <div>  <p class="tagline">Come for the brew, stay for the vibes.</p> </div> 

        <div class="logo-container">
             <?= $this->Html->image('logo.png', ['alt' => 'Let Me Cook', 'class' => 'main-logo']) ?>
        </div>

       
<div class="button-group">
            <?php ?>
            <?= $this->Html->link('S\'inscrire', 
                ['controller' => 'Users', 'action' => 'register'], 
                ['class' => 'btn btn-primary']) 
            ?>
            
            <?= $this->Html->link('Se connecter', 
                ['controller' => 'Users', 'action' => 'login'], 
                ['class' => 'btn btn-outline']) 
            ?>
        </div>
    </div>
</div>