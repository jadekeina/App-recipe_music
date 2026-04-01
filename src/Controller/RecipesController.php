<?php

namespace App\Controller;

use App\Controller\AppController;

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
        $recipe = $this->Recipes->get($id, ['contain' => ['Users']]);

        $this->set(compact('recipe'));
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