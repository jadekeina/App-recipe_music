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
        $search = $this->request->getQuery('q');

        $query = $this->Recipes->find('all')->contain(['Users']);

        if (!empty($search)) {
            $query = $query->where([
                'OR' => [
                    'Recipes.title LIKE' => '%' . $search . '%',
                    'Recipes.ingredients LIKE' => '%' . $search . '%',
                ]
            ]);
        }

        $recipes = $query->all();

        $this->set(compact('recipes', 'search'));
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
    $identity = $this->Authentication->getIdentity();

    if ($this->request->is('post')) {
        $data = $this->request->getData();
        $data['user_id'] = $identity->get('id');
        
        if ($identity->get('role') === 'admin' && isset($data['is_published'])) {
            $data['is_published'] = $data['is_published'];
        } else {
            $data['is_published'] = 0;
        }

        $recipe = $this->Recipes->patchEntity($recipe, $data);
        if ($this->Recipes->save($recipe)) {
            $this->Flash->success(__('Opération réussie.'));
            return $this->redirect(['action' => 'add']); 
        }
    }

    $pending = [];
    if ($identity->get('role') === 'admin') {
        $pending = $this->Recipes->find()
            ->where(['is_published' => 0])
            ->contain(['Users'])
            ->all();
    }

    $this->set(compact('recipe', 'pending'));
}

public function publish($id = null)
{
    $this->request->allowMethod(['post']);

    $recipe = $this->Recipes->get($id);

    $recipe->is_published = 1;

    if ($this->Recipes->save($recipe)) {
        $this->Flash->success(__('La recette a été validée et est maintenant en ligne !'));
    } else {
        $this->Flash->error(__('Impossible de valider la recette.'));
    }


    return $this->redirect(['action' => 'add']);
}


}