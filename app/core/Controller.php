<?php

class Controller
{
    protected function model($model)
    {
        require_once 'app/models/' . $model . '.php';
        return new $model();
    }

    protected function view($view, $data = [])
    {
        require_once 'app/views/' . $view . '.php';
    }

    protected function renderView($view, $data = [])
    {
        ob_start();
        include('app/views/' . $view . '.php');
        $var=ob_get_contents();
        ob_end_clean();
        return $var;
    }

    protected function successJsonAnswer(array $data = [])
    {
        $data['success'] = true;
        echo json_encode($data);
    }


    protected function errorJsonAnswer($massage = '')
    {
        $data['success'] = false;
        $data['errorMassage'] = $massage;
        echo json_encode($data);
    }

    /**
     * @param $name
     * @return string
     */
    protected function getPost($name) :string
    {
        return trim(filter_var($_POST[$name], FILTER_SANITIZE_STRING)) ?? '';
    }
}