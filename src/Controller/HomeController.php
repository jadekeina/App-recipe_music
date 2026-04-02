<?php

namespace App\Controller;

class HomeController extends AppController{
    public function index()
    {
    $this->loadModel('Recipes'); 
    $recipes = $this->Recipes->find()->contain(['Users'])->all();
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