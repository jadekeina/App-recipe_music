<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Service\SpotifyService;

class RecipesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->Authentication->allowUnauthenticated(['index', 'view']);
    }

    public function index()
    {
        $recipes = $this->Recipes->find('all')->contain(['Users']);

        $this->set(compact('recipes'));
    }

    public function view($id = null)
    {
        // 1. On récupère la recette
        $recipe = $this->Recipes->get($id, [
            'contain' => ['Users']
        ]);

        // 2. On initialise la variable à null par défaut
        $playlistId = null;

        // 3. Si un lien ou un ID existe en base de données
        if (!empty($recipe->spotify_playlist_id)) {
            $spotify = new SpotifyService();

            // On laisse le service extraire l'ID, qu'il s'agisse d'une URL ou déjà d'un ID
            $playlistId = $spotify->extractPlaylistId($recipe->spotify_playlist_id);
        }

        $isFavorite = false;
        $identity = $this->Authentication->getIdentity();
        if ($identity) {
            $isFavorite = $this->getTableLocator()->get('Favorites')->exists([
                'user_id' => $identity->get('id'),
                'recipe_id' => $recipe->id
            ]);
        }

        // 4. On envoie les variables à la vue
        // 'playlistId' sera soit l'ID propre, soit null.
        $this->set(compact('recipe', 'playlistId', 'isFavorite'));
    }

    public function add()
    {
        $recipe = $this->Recipes->newEmptyEntity();
        if ($this->request->is('post')) {
            // On récupère les données du formulaire
            $data = $this->request->getData();
            
            // On AJOUTE l'ID de l'utilisateur directement dans le tableau de données
            // avant même de créer l'entité. C'est la méthode la plus sûre.
            $data['user_id'] = $this->Authentication->getIdentity()->get('id');

            $recipe = $this->Recipes->patchEntity($recipe, $data);

            if ($this->Recipes->save($recipe)) {
                $this->Flash->success(__('La recette a été sauvegardée.'));
                return $this->redirect(['action' => 'index']);
            }
            // Si ça échoue, on regarde pourquoi (affiche les erreurs de validation)
            $this->Flash->error(__('Erreur : ' . json_encode($recipe->getErrors())));
        }
        $this->set(compact('recipe'));
    }
}