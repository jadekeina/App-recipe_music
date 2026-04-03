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
    
        $recipe = $this->Recipes->get($id, [
            'contain' => ['Users']
        ]);

        $playlistId = null;

    
        if (!empty($recipe->spotify_playlist_id)) {
            $spotify = new SpotifyService();

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

        $this->set(compact('recipe', 'playlistId', 'isFavorite'));
        $identity = $this->Authentication->getIdentity();
    

    if ($identity && $identity->get('role') === 'admin') {
        return $this->render('view'); 
    }

    return $this->render('view_front');
    }

    public function add()
    {
        $recipe = $this->Recipes->newEmptyEntity();
        
        if ($this->request->is('post')) {
            $recipe = $this->Recipes->patchEntity($recipe, $this->request->getData());

            $recipe->user_id = $this->Authentication->getIdentity()->get('id');

            if ($this->Recipes->save($recipe)) {
                $this->Flash->success('Recette ajoutée !');

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error('Une erreur est survenue, veuillez réessayer.');
        }

        $this->set(compact('recipe'));
    }
}