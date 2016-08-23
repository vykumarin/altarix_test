<?php
require_once('models/Model.php');
require_once('views/View.php');

class Controller {
     private $model;
     private $view;

     public function __construct()
     {
          $this->model = new Model();
          $this->view = new View();
     }

     public function invoke($method = null, $get)
     {
       if (! isset($method)) {
         $recordsList = $this->model->today();
         $this->view->render([
           'items' => $recordsList
         ]);
       } else {
         if ($method == 'find') {
           $element = $this->model->find($get['id']);
           $this->view->json($element);
         }
         if ($method == 'filter') {
           if (!empty($get['from']) && !empty($get['to'])) {
             $records = $this->model->filter($get['from'], $get['to']);
           } else {
             $records = $this->model->today();
           }
           $this->view->json($records);
        }
      }
     }
}
