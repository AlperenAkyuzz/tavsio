var ozeldersData = {};
if($('#status').val() != 'false' && $('#status').val() != 'null'){ ozeldersData.status = $('#status').val() }
if($('#date').val() != 'false' && $('#date').val() != 'null'){ ozeldersData.date = $('#date').val() }

var ozeldersDatatable = true;
var ozeldersUrl       = '/tavsiocms/customers/parents-ajax';
var ozeldersColumns   = [
    {data: 'firstname', name: 'firstname'},
    {data: 'created_at', name: 'created_at'},
    {data: 'email', name: 'email'},
    {data: 'mobile', name: 'mobile'},
    {data: 'statusid', name: 'statusid'},
    {data: 'actions', name: 'actions'}
];

function arrayToQueryString(array_in){
    var out = new Array();

    for(var key in array_in){
        out.push(key + '=' + encodeURIComponent(array_in[key]));
    }

    return out.join('&');
}
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

    window.location.href = '/tavsiocms/customers/parents?' + arrayToQueryString(params);
});
$('#kt_reset').on('click', function(e) {
    e.preventDefault();
    window.location.href = '/tavsiocms/customers/parents';
});
$('.select2').select2();
$('#kt_datepicker').datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy',
    templates: {
        leftArrow: '<i class="la la-angle-left"></i>',
        rightArrow: '<i class="la la-angle-right"></i>',
    },
});
function userApproved(uuid){
    Swal.fire({
        title: 'Onaylamak istediğinizden emin misiniz?',
        text: "Kullanıcıyı onaylıyorsunuz.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Evet Onayla',
        cancelButtonText: 'Hayır İptal Et',
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: '/tavsiocms/customers/parents/approved',
                data: {uuid:uuid},
                dataType: "json",
                success: function(result){
                    if(result.status === 'success') {
                        responseMessage('success',result.message);
                        $('#kt_datatable').DataTable().draw(false);
                    }else{
                        responseMessage('error',result.message);
                    }
                }
            });
        }
    })
}
function userRollback(uuid,url){
    Swal.fire({
        title: 'Geri Eklemek İstediğinizden Emin misiniz?',
        text: "Kullanıcı geri ekleniyor.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Evet Ekle',
        cancelButtonText: 'Hayır İptal Et',
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: url,
                data: {uuid:uuid},
                dataType: "json",
                success: function(result){
                    if(result.status === 'success') {
                        responseMessage('success',result.message);
                        $('#kt_datatable').DataTable().draw(false);
                    }else{
                        responseMessage('error',result.message);
                    }
                }
            });
        }
    })
}
function userShowTeachers(uuid){
    $.ajax({
        type: "POST",
        url: '/tavsiocms/customers/parents/show-teachers',
        data: {uuid:uuid},
        dataType: "json",
        success: function(result){
            if(result.status === 'success') {
                let name  = result.user.firstname + ' ' + result.user.lastname;
                let table = '<table class="table table-sm table-striped table-bordered"><thead class="thead-dark">' +
                    '<tr>' +
                    '<th>Tarih</th>' +
                    '<th>Öğretmen</th>' +
                    '<th>E-posta</th>' +
                    '<th>Ip Adres</th>' +
                    '</tr>' +
                    '</thead><tbody>';

                if(result.data.length == 0){
                    table += '<tr>' +
                        '<td colspan="4" class="text-center">Veri bulunamadı</td>' +
                        '</tr>';
                }else{
                    for(const [index,item] of Object.entries(result.data)){
                        table += '<tr>' +
                            '<td>'+ moment(item.created_at).format('DD-MM-YYYY H:m') +'</td>' +
                            '<td>'+ item.firstname + ' ' + item.lastname +'</td>' +
                            '<td>'+ result.user.email +'</td>' +
                            '<td>'+ item.ip_address +'</td>' +
                            '</tr>';
                    }
                }

                table += '</tbody></table>';

                $('#showTeachersContent').empty().append(table);
                $('#showTeachersTitle').empty().append(name + ' Adlı Kullanıcının Numarasına Baktığı Öğretmenler');
                $('#showTeachers').modal('show');
            }else{
                responseMessage('error',result.message);
            }
        }
    });
}
