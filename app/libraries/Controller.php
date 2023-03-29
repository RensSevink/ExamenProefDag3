<?php 

class Controller 
{
    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    public function view($view, $data = [])
    {
        //include header
        require_once '../app/views/includes/header.php';

        //include sandwich
        if(file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            die('View bestaat niet');
        }
        
        //include footer
        require_once '../app/views/includes/footer.php';
    }
}