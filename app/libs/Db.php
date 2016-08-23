<?php
class Db extends PDO {
  public function __construct() {
    $options = [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    parent::__construct('mysql:host=localhost;dbname=altarix', 'root', '1q2w3e4r', $options);
  }
}
