$('.select2').select2();
var ozeldersDatatable = false;

// Nestable Table
$(document).ready(function() {
    var updateOutput = function (e) {
        var list        = e.length ? e : $(e.target),
            listData    = list.nestable('serialize');

        $.ajax({
            type: "GET",
            url: '/tavsiocms/categories/ordering-category',
            data: {listData: listData},
            success: function (result) {
                responseMessage('success','Güncelleme İşleminiz Başarılı Olmuştur.')
            }
        });

    };

    $('.dropify').dropify({
        messages: {
            default: 'Bir dosyayı buraya sürükleyip bırakın veya tıklayın\n',
            replace: 'Bir dosyayı sürükleyip bırakın veya değiştirmek için tıklayın\n',
            remove: 'SİL',
            error: 'Hata'
        }
    });

    $('#nestable3').nestable().on('change', updateOutput).nestable('collapseAll');
});

$("#addForm").submit(function(e) {
    let addForm  = $(this);
    var formData = new FormData(addForm[0]);
    let input    = addForm.serializeArray()[2];

    if(input.value === ''){
        alert('Lütfen Başlık Alanını Doldurunuz!');
        return false;
    }

    if($('#action').val() == 'insert'){
        $.ajax({
            type: "POST",
            url: '/tavsiocms/lessons-categories/add',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (result) {
                if(result.status === 'success'){
                    if(result.category){
                        $('#categories').append('<option value="'+ result.category.id +'" selected>'+ result.category.title +'</option>');
                        $('#category_id').val(result.category.id);
                        $('.select2').select2();
                    }else{
                        window.location.reload();
                    }

                    $('#addForm')[0].reset();

                    if(result.id !== '0'){
                        expand(result.id);
                    }

                    responseMessage('success',"Ders Kategorisi Eklendi.")
                }else{
                    responseMessage('error','Ders kategorisi eklenirken sorun oluştu')
                }
            }
        });

        return false;
    }else{
        $.ajax({
            type: "POST",
            url: '/tavsiocms/lessons-categories/edit',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (result) {
                if(result.status === 'success'){
                    if(result.category){
                        $('#categories option').removeAttr('selected').filter('[value='+ result.category.parent_id +']').attr('selected', true);
                        $('#category_id').val(result.category.id);
                        $('.select2').select2();
                    }

                    $('#addForm')[0].reset();

                    $('#categories option').removeAttr('selected').filter('[value=0]').attr('selected', true)
                    $('.select2').select2();

                    if(result.id !== '0'){
                        expand(result.id);
                    }

                    responseMessage('success',"Ders Kategorisi Düzenlendi.")
                }else{
                    responseMessage('error','Ders kategorisi düzenlenirken sorun oluştu')
                }
            }
        });

        return false;
    }

});
function selectType(type,status = false,param = false) {
    switch (type) {
        case 'add':
            $('#addForm')[0].reset();

            if(status === true){
                $('#categories option').removeAttr('selected').filter('[value='+ param +']').attr('selected', true);
            }else{
                $('#categories option').removeAttr('selected').filter('[value=0]').attr('selected', true);
            }

            $('#action').val('insert');
            $('.select2').select2();
            break;
        case 'edit':
            getItem(param);
            break;
        case 'delete':
            deleteItem(param);
            break;
        default:
            break;
    }
}

function expand(id){
    let container = '';

    $.ajax({
        type: "POST",
        url: '/tavsiocms/categories/child-category',
        data: {parent_id:id},
        success: function (result) {
            let addContent = $('#add-content');
            addContent.show();

            container = '<ol class="dd-list childs'+id+'">';
            $.each(result,function (index, item) {
                let classType = '';
                if(item.count == 1){
                    classType = 'dd-collapsed';
                }

                container += '<li class="dd-item dd3-item '+classType+' item'+item.id+'" data-id="'+ item.id +'">' +
                    '   <button class="dd-collapse" data-action="collapse" type="button" onclick="collapse(\''+ item.id +'\')">Collapse</button>' +
                    '   <button class="dd-expand" data-action="expand" type="button" onclick="expand(\''+ item.id +'\')">Expand</button>' +
                    '  <div class="dd-handle dd3-handle">Drag</div>' +
                    '     <div class="dd3-content">' +
                    '         <span id="label_show4">'+ item.title +'</span>' +
                    '             <span class="span-right"> &nbsp;&nbsp;' +
                    '             <a class="add-button" id="addItem'+item.id+'" onclick="selectType(\'add\',true,\''+ item.id +'\')" data-name="'+ item.title +'"><i class="fas fa-folder-plus icon-nmo icon-color-gray"></i></a>'+
                    '             <a class="edit-button" id="editItem'+item.id+'" onclick="selectType(\'edit\',true,\''+ item.id +'\')"><i class="fas fa-pencil-alt icon-nmo icon-color-gray"></i></a>' +
                    '             <a class="del-button" id="deleteItem'+item.id+'" onclick="selectType(\'delete\',true,\''+ item.id +'\')"><i class="fas fa-trash-alt icon-nmo icon-color-gray"></i></a></span>' +
                    '     </div>' +
                    '</li>';
            });

            container += '</ol>';
            if(true){
                $('.childs'+id).remove();
                $('.item'+id).append(container);
            }else{
                $('.item'+id).append(container);
            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
        }
    });
}
function collapse(id){
    $('.childs'+id).empty();
}
function deleteItem(id) {
    Swal.fire({
        title: 'Silmek İstediğinizden Emin misiniz?',
        text: "İçerik silindiğinde geri alamazsınız.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Evet Sil',
        cancelButtonText: 'Hayır İptal Et',
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url:  "/tavsiocms/lessons-categories/delete",
                data: {
                    id: id
                },
                dataType: "json",
                success: function (result) {
                    if(result.status === 'error'){
                        responseMessage('error',result.message)
                    }else{
                        responseMessage('success',"Kayıt silindi")
                        $('.item'+id).remove();
                    }
                }
            });
        }
    });
}
function getItem(id) {
    $.ajax({
        type: "POST",
        url: '/tavsiocms/categories/get-category',
        data: {id:id},
        success: function (result) {
            $('#title').val(result.category.title);
            $('#seo_title').val(result.category.seo_title);
            $('#icon').val(result.category.icon);
            $('#description').val(result.category.description);
            $('#id').val(result.category.id);

            $('#categories option').removeAttr('selected').filter('[value='+ result.category.parent_id +']').attr('selected', true);
            $('.select2').select2();

            let categoryPhotoUrl = '/images/categories/' + result.category.photo;
            let drEventt = $('.photo').dropify({
                defaultFile:  categoryPhotoUrl,
                messages: {
                    default: 'Bir dosyayı buraya sürükleyip bırakın veya tıklayın\n',
                    replace: 'Bir dosyayı sürükleyip bırakın veya değiştirmek için tıklayın\n',
                    remove: 'SİL',
                    error: 'Hata'
                }
            });

            drEventt = drEventt.data('dropify');
            drEventt.resetPreview();
            drEventt.clearElement();
            drEventt.settings.defaultFile = categoryPhotoUrl;
            drEventt.destroy();
            drEventt.init();

            let categoryUrl = '/images/categories/' + result.category.requestPhoto;
            let drEvent = $('.requestPhoto').dropify({
                defaultFile:  categoryUrl,
                messages: {
                    default: 'Bir dosyayı buraya sürükleyip bırakın veya tıklayın\n',
                    replace: 'Bir dosyayı sürükleyip bırakın veya değiştirmek için tıklayın\n',
                    remove: 'SİL',
                    error: 'Hata'
                }
            });

            drEvent = drEvent.data('dropify');
            drEvent.resetPreview();
            drEvent.clearElement();
            drEvent.settings.defaultFile = categoryUrl;
            drEvent.destroy();
            drEvent.init();

            let categoryBgUrl = '/images/categories/' + result.category.bg;
            let drBgEvent = $('.requestPhoto').dropify({
                defaultFile:  categoryUrl,
                messages: {
                    default: 'Bir dosyayı buraya sürükleyip bırakın veya tıklayın\n',
                    replace: 'Bir dosyayı sürükleyip bırakın veya değiştirmek için tıklayın\n',
                    remove: 'SİL',
                    error: 'Hata'
                }
            });

            drBgEvent = drBgEvent.data('dropify');
            drBgEvent.resetPreview();
            drBgEvent.clearElement();
            drBgEvent.settings.defaultFile = categoryBgUrl;
            drBgEvent.destroy();
            drBgEvent.init();

            if(result.category.status == '1'){
                $('#status').prop('checked', true);
            }else{
                $('#status').prop('checked', false);
            }

            $('#action').val('update');
        }
    });
}
