$('.select2').select2();
function arrayToQueryString(array_in){
    var out = new Array();

    for(var key in array_in){
        out.push(key + '=' + encodeURIComponent(array_in[key]));
    }

    return out.join('&');
}

var ozeldersData = {};
if($('#status').val() != 'false' && $('#status').val() != 'null'){ ozeldersData.status = $('#status').val() }
if($('#date').val() != 'false' && $('#date').val() != 'null'){ ozeldersData.date = $('#date').val() }

$('#kt_search').on('click', function(e) {
    e.preventDefault();
    var params = {};
    $('.datatable-input').each(function() {
        var i = $(this).data('col-index');
        if (params[i]) {
            params[i] += '|' + $(this).val();
        } else {
            params[i] = $(this).val();
        }
    });

    window.location.href = '/tavsiocms/teachers/questions?' + arrayToQueryString(params);
});
$('#kt_reset').on('click', function(e) {
    e.preventDefault();
    window.location.href = '/tavsiocms/teachers/questions';
});

var ozeldersDatatable = true;
var ozeldersUrl       = '/tavsiocms/teachers/questions/ajax';
var ozeldersColumns   = [
    {data: 'created_at', name: 'created_at'},
    {data: 'author', name: 'author'},
    {data: 'userid', name: 'userid'},
    {data: 'questions', name: 'questions'},
    {data: 'status', name: 'status'},
    {data: 'reply_status', name: 'reply_status'},
    {data: 'actions', name: 'actions'}
];
