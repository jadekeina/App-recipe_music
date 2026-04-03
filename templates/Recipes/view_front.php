<div class="app-container">
    <div class="view-header">
        <?= $this->Html->link('<i class="fa-solid fa-chevron-left"></i>', ['controller' => 'Home', 'action' => 'index'], ['escape' => false, 'class' => 'back-btn']) ?>
    </div>

    <div class="spotify-hero">

  
<?= $this->Html->image('playlist.webp', ['class' => 'img-playlist', 'alt' => 'Image de la playlist']) ?>

<?php if (!empty($recipe->spotify_playlist_id)): ?>
    <?php 

        $embedUrl = str_replace('playlist/', 'embed/playlist/', $recipe->spotify_playlist_id);
    ?>
    <div id="spotify-player" style="display:none;">
        <iframe id="spotify-iframe"
            src="<?= h($embedUrl) ?>" 
            width="120%" 
            height="80" 
            frameBorder="0" 
            allow="encrypted-media; autoplay">
        </iframe>
    </div>
<?php endif; ?>
        
<div class="playlist-meta">
        <h2 class="playlist-name">Chill et gourmand</h2>
        <p class="brand-name">Let me Cook</p>
        <button id="play-button" class="btn-play">
            <i class="fa-solid fa-play"></i> <span class="btn-text">Écouter</span>
        </button>
    </div>
    </div>

    <div class="recipe-card-black">
        <div class="pull-bar"></div>
        
        <div class="recipe-top-info">
            <h1 class="recipe-title-front"><?= h($recipe->title) ?></h1>
            
            <div class="recipe-stats">
                <p>Ingrédients (pour ~12 cookies)</p>
            </div>
        </div>

<div class="recipe-details">
            <h3 class="section-title">Ingrédients</h3>
            
            <ul class="ingredients-list">
                <?php 
                $lignes = explode("\n", $recipe->ingredients);
                foreach ($lignes as $ligne): 
                    if (trim($ligne) !== ''): 
                ?>
                    <li><?= h(trim($ligne, "-* ")) ?></li>
                <?php 
                    endif;
                endforeach; 
                ?>
            </ul>

            <h3 class="section-title">Étapes de préparation</h3>
            <div class="steps-content">
                <?= nl2br(h($recipe->steps)) ?>
            </div>
        </div>
        

    </div>
</div>