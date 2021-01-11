var ozeldersData = {};
if($('#status').val() != 'false' && $('#status').val() != 'null'){ ozeldersData.status = $('#status').val() }
if($('#date').val() != 'false' && $('#date').val() != 'null'){ ozeldersData.date = $('#date').val() }

var ozeldersDatatable = true;
var ozeldersUrl       = '/tavsiocms/customers/teachers-ajax';
var ozeldersColumns   = [
    {data: 'firstname', name: 'firstname',width: '350px'},
    {data: 'email', name: 'email'},
    {data: 'mobile', name: 'mobile'},
    {data: 'statusid', name: 'statusid',width: '90px'},
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

    window.location.href = '/tavsiocms/customers/teachers?' + arrayToQueryString(params);
});
$('#kt_reset').on('click', function(e) {
    e.preventDefault();
    window.location.href = '/tavsiocms/customers/teachers';
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
        text: "Öğretmeni onaylıyorsunuz.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Evet Onayla',
        cancelButtonText: 'Hayır İptal Et',
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: '/tavsiocms/customers/teachers/approved',
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
function userChangeCity(uuid,status){
    Swal.fire({
        title: 'Öğretmen ayarını değiştirmek istediğinizden emin misiniz?',
        text: "Öğretmeni ayarı değiştiriliyor.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Evet Değiştir',
        cancelButtonText: 'Hayır İptal Et',
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: '/tavsiocms/customers/teachers/change-city',
                data: {uuid:uuid,status:status},
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
function userRemoveApproved(uuid){
    Swal.fire({
        title: 'Onayı kaldırmak istediğinizden emin misiniz?',
        text: "Öğtermen onayını kaldrıyorsunuz",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Evet Onay Kaldır',
        cancelButtonText: 'Hayır İptal Et',
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: '/tavsiocms/customers/teachers/remove-approved',
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
function userShowHit(uuid){
    $.ajax({
        type: "POST",
        url: '/tavsiocms/customers/teachers/show-teacher-hit',
        data: {uuid:uuid},
        dataType: "json",
        success: function(result){
            if(result.status === 'success') {
                let name  = result.user.firstname + ' ' + result.user.lastname;
                let table = '<table class="table table-sm table-striped table-bordered"><thead class="thead-dark">' +
                    '<tr>' +
                    '<th>Tarih</th>' +
                    '<th>Veli</th>' +
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
                            '<td>'+ item.email +'</td>' +
                            '<td>'+ item.ip_address +'</td>' +
                            '</tr>';
                    }
                }

                table += '</tbody></table>';

                $('#showTeachersContent').empty().append(table);
                $('#showTeachersTitle').empty().append(name + ' Adlı Öğretmenin Numarasına Bakan Veliler');
                $('#showTeachers').modal('show');
            }else{
                responseMessage('error',result.message);
            }
        }
    });
}
function userPointUpdate(uuid,url){
    getUserPoint(uuid);
    $('#pointUrl').val(url);
    $('#pointUuid').val(uuid);
}
function saveUserPoint(){
    $.ajax({
        type: "POST",
        url: $('#pointUrl').val(),
        data: {uuid:$('#pointUuid').val(),value: $('#point').val()},
        dataType: "json",
        success: function(result){
            if(result.status === 'success') {
                responseMessage('success',result.message);
                $('#kt_datatable').DataTable().draw(false);
                $('#pointUpdate').modal('hide');
            }else{
                responseMessage('error',result.message);
            }
        }
    });
}
function getUserPoint(uuid){
    $.ajax({
        type: "POST",
        url: '/tavsiocms/customers/teachers/get-point',
        data: {uuid:uuid},
        dataType: "json",
        success: function(result){
            if(result.status === 'success') {
                $('#point').val(result.point);
                $('#pointUpdate').modal('show');
            }else{
                responseMessage('error',result.message);
            }
        }
    });
}
