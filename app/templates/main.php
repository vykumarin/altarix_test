<div class="container">
  <div class="row">
    <div class="col s5 records-list">
      From: <input type="date" class="datepicker" id="date-from">
      To: <input type="date" class="datepicker" id="date-to">
      <a class="waves-effect waves-light btn" id="clear">Clear</a>
      <a class="waves-effect waves-light btn" id="filter">Filter</a>
      <div class="collection records">
        <?php foreach ($data['items'] as $item): ?>
          <a href="#!" class="collection-item one-record" rel="<?=$item['id']?>">
            <?=$item['id']?> | <?php echo date('Y-m-d H:i:s', strtotime($item['date_request'])) ?> | <?php echo $item['status'] ? 'OK' : 'Fail'; ?>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="col s7 records-detail">
      <h5>ID</h5>
      <p id="id"></p>
      <h5>Status</h5>
      <p id="status"></p>
      <h5>Latency (s)</h5>
      <p id="latency"></p>
      <h5>Date request</h5>
      <p id="request"></p>
      <h5>Date response</h5>
      <p id="response"></p>
      <h5>Headers</h5>
      <p id="headers"></p>
      <h5>Body</h5>
      <p id="body"></p>
    </div>
  </div>
</div>
