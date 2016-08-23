<?php
require_once('libs/Validator.php');
require_once('models/Model.php');

$validator = new Validator('ем33377');
$result = $validator->checkService();

$model = new Model();
$model->add($result['status'], $result['date_request'], $result['date_response'], $result['latency'], $result['header'], $result['body']);
