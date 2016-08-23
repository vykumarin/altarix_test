<?php
class View
{
  public function render($data)
  {
    include 'templates/header.php';
    include 'templates/main.php';
    include 'templates/footer.php';
  }

  public function json($data)
  {
    header('Content-Type: application/json');
    echo json_encode($data);
  }
}
