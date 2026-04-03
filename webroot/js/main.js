
document.addEventListener('DOMContentLoaded', function() {
    const playBtn = document.getElementById('play-button');
    

    if (playBtn) {
        playBtn.addEventListener('click', function() {
            const iframe = document.getElementById('spotify-iframe');
            

            if (!iframe) {
                alert("Aucune playlist n'est associée à cette recette !");
                return;
            }

            const btnText = this.querySelector('.btn-text');
            const icon = this.querySelector('i');
            const playerDiv = document.getElementById('spotify-player');

            if (iframe.src.indexOf('autoplay=1') === -1) {
                iframe.src += (iframe.src.includes('?') ? '&' : '?') + "autoplay=1";
                
                if(btnText) btnText.innerText = "En lecture...";
                if(icon) icon.classList.replace('fa-play', 'fa-pause');
                if(playerDiv) playerDiv.style.display = 'block';
            } else {
                location.reload(); 
            }
        });
    }
});