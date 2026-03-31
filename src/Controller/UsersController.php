<?php

namespace App\Controller;

use Cake\Http\Exception\NotFoundException;

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

        debug($result);
        die();

        if ($result->isValid()) {

            $redirect = $this->request->getQuery('redirect', ['controller' => 'Recipes', 'action' => 'index']);

            return $this->redirect($redirect);
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
}