<?php
class Controller
{
    public function model($model)
    {
        $modelFile = __DIR__ . '/../models/' . $model . '.php';
        if (file_exists($modelFile)) {
            require_once $modelFile;
            if (class_exists($model)) {
                return new $model();
            }
        }
        throw new Exception("Model $model tidak ditemukan.");
    }

    public function view($view, $data = [])
    {
        extract($data);
        $viewFile = __DIR__ . '/../views/' . $view . '.php';
        if (file_exists($viewFile)) {
            require $viewFile;
        } else {
            echo "View <b>$viewFile</b> tidak ditemukan.";
        }
    }
}