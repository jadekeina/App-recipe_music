<?php
namespace App\Controller;

use App\Controller\AppController;

class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->allowUnauthenticated(['login', 'register']);
    }

    public function register()
    {
        $user = $this->Users->newEmptyEntity();

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            if ($this->Users->save($user)) {
                $this->Flash->success('Inscription réussie');
                return $this->redirect(['action' => 'login']);
            }

            $this->Flash->error('Une erreur est survenue');
        }

        $this->set(compact('user'));
    }

    public function login()
    {
        $result = $this->Authentication->getResult();

        if ($result->isValid()) {
            $target = $this->Authentication->getLoginRedirect() ?? ['controller' => 'Home'];
            return $this->redirect($target);
        }

        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error('Nom ou mot de passe incorrect');
        }
    }

    public function logout()
    {
        $result = $this->Authentication->getResult();

        if ($result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['action' => 'login']);
        }
    }

    public function profile()
    {
        $identity = $this->Authentication->getIdentity();

        $user = $this->Users->get($identity->get('id'), [
            'contain' => [
                'Favorites' => [
                    'Recipes'
                ]
            ]
        ]);

        $this->set(compact('user'));
    }
}