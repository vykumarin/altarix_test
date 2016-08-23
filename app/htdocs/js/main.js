$(function(){
  // datepicker init
  $('.datepicker').pickadate({
    selectMonths: true,
    selectYears: 15,
    format: 'yyyy-mm-dd'
  });

  // clear fields
  $('#clear').on('click', function() {
    $('#date-from').val('');
    $('#date-to').val('');
  });

  // filter left column
  $('#filter').on('click', function() {
    $.get('/', {'method': 'filter', 'from': $('#date-from').val(), 'to': $('#date-to').val()}).done(function(data) {
      var list = '';
      $.each(data, function(key, value) {
        list += '<a href="#!" class="collection-item one-record" rel="' + key + '">'
        + key + ' | ' + value.date_request + ' | ' + (value.status ? 'OK' : 'Fail')
        +'</a>';
      });
      $('.records').html(list);
    });
  });

  // get detail info, ajax
  $('body').on('click', '.one-record', function(ev) {
    ev.preventDefault();
    var recordId = $(this).attr('rel');
    $.get('/', {'method': 'find', 'id': recordId}).done(function(data) {
      $('#id').text(data.id);
      $('#status').text(data.status ? 'OK' : 'Fail');
      $('#request').text(data.date_request);
      $('#response').text(data.date_response);
      $('#latency').text(data.latency);
      $('#headers').text(data.header);
      $('#body').text(data.body);
    });
  });
});
