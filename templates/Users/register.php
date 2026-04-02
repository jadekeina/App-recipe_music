<div class="signup-container">
    <div class="signup-header">

                <div class="logo-container">
             <?= $this->Html->image('logo.png', ['alt' => 'Let Me Cook', 'class' => 'main-logo']) ?>
                </div>
    </div>

    <div class="form-card">

    <div class="form-perso-title"> 
                        <div class="logo-container"> <?= $this->Html->image('perso.png', ['alt' => 'Let Me Cook', 'class' => 'perso-logo']) ?>
                </div>

        <div class="form-title"> <h2>S'inscrire</h2> </div>

    </div>

        <?= $this->Form->create($user) ?>
            <?= $this->Form->control('username', ['label' => 'Nom d\'utilisateur', 'placeholder' => 'Username']) ?>
            
            <?= $this->Form->control('nom', ['label' => 'Nom', 'placeholder' => 'Nom']) ?>
            <?= $this->Form->control('prenom', ['label' => 'Prénom', 'placeholder' => 'Prénom']) ?>
            <?= $this->Form->control('email', ['label' => 'Adresse mail', 'placeholder' => 'Mail']) ?>
            
            <?= $this->Form->control('password', ['label' => 'Mot de passe', 'placeholder' => 'Créez un mot de passe']) ?>
            
            <div class="form-footer">
                <?= $this->Form->button(__('S\'inscrire'), ['class' => 'btn-confirm']) ?>
            </div>
        <?= $this->Form->end() ?>
        
        <p class="form-link">
            Déjà un compte ? <?= $this->Html->link('Se connecter', [
        'prefix' => false,    
        'controller' => 'Users', 
        'action' => 'login'
    ]) ?>
    </div>
</div>