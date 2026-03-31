<?php

namespace App\Controller;

class HomeController extends AppController{
    public function index()
    {
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