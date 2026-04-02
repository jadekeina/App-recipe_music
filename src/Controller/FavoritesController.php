<?php
namespace App\Controller;

class FavoritesController extends AppController
{
    public function toggle($recipeId)
    {
        $this->request->allowMethod(['post']);
        $userId = $this->Authentication->getIdentity()->get('id');

        $existing = $this->Favorites->find()
            ->where(['user_id' => $userId, 'recipe_id' => $recipeId])
            ->first();

        if ($existing) {
            $this->Favorites->delete($existing);
            $this->Flash->success('Retiré des favoris');
        } else {
            $favorite = $this->Favorites->newEmptyEntity();
            $favorite->user_id = $userId;
            $favorite->recipe_id = $recipeId;
            $this->Favorites->save($favorite);
            $this->Flash->success('Ajouté aux favoris !');
        }

        return $this->redirect($this->referer([
            'controller' => 'Recipes',
            'action' => 'view',
            $recipeId
        ]));
    }

    public function index()
    {
        $user = $this->Authentication->getIdentity();
        
        $favorites = $this->Favorites->find()
            // On précise "Favorites.user_id" pour lever l'ambiguïté
            ->where(['Favorites.user_id' => $user->get('id')]) 
            ->contain(['Recipes']) 
            ->all();

        $this->set(compact('favorites'));
    }
}