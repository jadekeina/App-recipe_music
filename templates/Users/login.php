

<div class="signup-container">
    <div class="signup-header">
        <div class="logo-container">
            <?= $this->Html->image('logo.png', ['alt' => 'Let Me Cook', 'class' => 'main-logo']) ?>
        </div>

                <div class="logo-container">
            <?= $this->Html->image('perso.png', ['alt' => 'Let Me Cook', 'class' => 'perso-login']) ?>
        </div>
    </div>

    <div class="form-card-login">
        <div class="form-perso-title"> 
            <div class="form-title"> 
                <h2>Connexion</h2> 
            </div>
        </div>

        <?= $this->Flash->render() ?> <?= $this->Form->create() ?>
            <?= $this->Form->control('username', [
                'label' => 'Nom d\'utilisateur',
                'placeholder' => 'Username',
                'type' => 'text' 
            ]) ?>
            
            <?= $this->Form->control('password', [
                'label' => 'Mot de passe',
                'placeholder' => 'Votre mot de passe',
                'type' => 'password'
            ]) ?>
            
            <div class="form-footer">
                <?= $this->Form->button(__('Se connecter'), ['class' => 'btn-confirm']) ?>
            </div>
        <?= $this->Form->end() ?>
        
        <p class="form-link">
            Pas encore de compte ? 
            <?= $this->Html->link('S\'inscrire', [
        'prefix' => false,    
        'controller' => 'Users', 
        'action' => 'register'
    ]) ?>
    </div>
</div>