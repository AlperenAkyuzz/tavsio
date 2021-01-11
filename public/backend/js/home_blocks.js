$('.select2').select2();

function addCategories(){
    $('.showCategory').css('display','inherit');
    $('#selected').val(0);
}
function getItem(id,selectedId){
    $('#categories option').removeAttr('selected').filter('[value='+ id +']').attr('selected', true);
    $('#selected').val(selectedId);
    $('.showCategory').show();
    $('.select2').select2();
}
function changeCategory(e){
    let selected = $('#selected').val();
    let text = e.options[e.selectedIndex].text;

    if(selected == '0'){
        $.ajax({
            type: "POST",
            url: '/tavsiocms/home-management/home-lessons/add-category',
            data: {lessonid: e.value},
            success: function (result) {
                responseMessage(result.status,result.message);
                setTimeout(() => {
                    window.location.reload();
                },1000)
            }
        });
    }else{
        $.ajax({
            type: "POST",
            url: '/tavsiocms/home-management/home-lessons/change-category',
            data: {lessonid: e.value,id: selected},
            success: function (result) {
                responseMessage(result.status,result.message);

                if(result.status == 'success'){
                    let rp = '<a class="edit-button" id="editItem'+selected+'" onclick="getItem('+e.value+','+ selected +')">' +
                        '<i class="fas fa-pencil-alt icon-nmo icon-color-gray"></i></a>' +
                        '<a class="del-button" id="deleteItem'+selected+'" onclick="deleteItem('+selected+')">' +
                        '<i class="fas fa-trash-alt icon-nmo icon-color-gray"></i></a>';

                    $('.categoryButtonChange').empty().append(rp);
                    $('#title').empty().append(text);
                }
            }
        });
    }
}
function deleteItem(id){
    $.ajax({
        type: "POST",
        url: '/tavsiocms/home-management/home-lessons/delete-category',
        data: {id: id},
        success: function (result) {
            responseMessage(result.status,result.message);
            $('.item'+id).remove();
        }
    });
}
$(document).ready(function () {
    var updateOutput = function (e) {
        var list = e.length ? e : $(e.target),
            listData = list.nestable('serialize');

        $.ajax({
            type: "POST",
            url: '/tavsiocms/home-management/home-lessons/ordering-category',
            data: {listData: listData},
            success: function (result) {
                responseMessage('success','Güncelleme İşleminiz Başarılı Olmuştur.')
            }
        });
    };

    $('#nestable3').nestable().on('change', updateOutput).nestable('collapseAll');
});
