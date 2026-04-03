<?php

namespace App\Controller;

class HomeController extends AppController{
    public function index()
    {
    $this->loadModel('Recipes'); 
   $recipes = $this->Recipes->find()
        ->where(['Recipes.is_published' => 1]) 
        ->contain(['Users'])
        ->order(['Recipes.created' => 'DESC'])
        ->all();
    $this->set(compact('recipes'));
    }

    public function display()
    {
    }

    public function initialize(): void
    {
        parent::initialize();

        $this->Authentication->allowUnauthenticated(['display']);
    }
}