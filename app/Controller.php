<?php

namespace App;

final class Controller extends Helper{
    
    public function home($request, $response)
    {   
        $vars = [
            'page' => 'home',              
        ];
        return $this->view->render($response, 'index.phtml', $vars);
    }

    public function teste($request, $response)
    {
        $vars = [
            'page' => 'teste',
        ];
        return $this->view->render($response, 'index.phtml', $vars);
    }
}