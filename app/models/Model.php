<?php
require_once(dirname(__FILE__) . '/../libs/Db.php');

class Model
{
  private $database;

  public function __construct()
  {
    $this->database = new Db();
  }
  public function all()
  {
    $records = [];

    $stmt = $this->database->query('SELECT `date_request`, `status`, `id` FROM `monitoring`');

    foreach ($stmt as $row) {
      $records[$row['id']] = $row;
    }

    return $records;

  }
  public function today()
  {
    $records = [];
    $stmt = $this->database->query('SELECT `date_request`, `status`, `id` FROM `monitoring` WHERE `date_request` >= CURDATE()');
    
    foreach ($stmt as $row) {
      $records[$row['id']] = $row;
    }

    return $records;
  }
  public function find($recordId)
  {
    $stmt = $this->database->prepare('SELECT * FROM `monitoring` WHERE `id` = :id LIMIT 1');

    $stmt->execute([
      'id' => $recordId,
    ]);

    $record = $stmt->fetch();

    return $record;
  }

  public function filter($fromDate, $toDate)
  {
    $stmt = $this->database->prepare('SELECT `date_request`, `status`, `id` FROM `monitoring` WHERE `date_request` BETWEEN :from_date AND :to_date');

    $stmt->execute([
      'from_date' => date('Y-m-d H:i:s', strtotime($fromDate)),
      'to_date'   => date('Y-m-d H:i:s', strtotime($toDate)),
    ]);

    $records = [];
    foreach ($stmt as $row) {
      $records[$row['id']] = $row;
    }
    return $records;
  }

  public function add($status, $dateRequest, $dateResponse, $latency, $header = null, $body = null)
  {
    $stmt = $this->database->prepare('INSERT INTO
      `monitoring` (
      `status`, `header`, `body`, `date_request`, `date_response`, `latency`)
      VALUES (:status, :header, :body, :date_request, :date_response, :latency)');
    $stmt->execute([
      'status'        => $status,
      'header'        => $header,
      'body'          => $body,
      'date_request'  => $dateRequest,
      'date_response' => $dateResponse,
      'latency'       => $latency,
    ]);
  }
}
