$('.select2').select2();
$('.summernote').summernote({
    height: 150,
    toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
    ]
});

function addNewContent(){
    let count      = $('#count').val();
    let properties = $('.properties');

    $('.alert-properties').remove();

    count++;
    let country = '<div class="form-group">';

    country += '</div>';

    properties.append('<div class="row" id="content-'+ count +'">' +
        '                      <div class="col-md-3">' +
        '                         <input type="text" id="question-'+ count +'" class="form-control form-control-solid" placeholder="Sss Soru"/>' +
        '                      </div>' +
        '                      <div class="col-md-5">' +
        '                          <div class="form-group">' +
        '                             <div class="summernote" id="answer-'+ count +'"></div>' +
        '                          </div>' +
        '                      </div>' +
        '                      <div class="col-md-2 text-right pr-0">' +
        '                         <a href="javascript:;" class="btn btn-light-success font-weight-bolder btn-sm" onclick="saveProperties(\'' + count + '\')">' +
        '                             <i class="far fa-save"></i> Özelliği Kaydet' +
        '                         </a>' +
        '                      </div>' +
        '                      <div class="col-md-2 text-left">' +
        '                         <a href="javascript:;" class="btn btn-light-danger font-weight-bolder btn-sm" onclick="removeProperties(\'' + count + '\')">' +
        '                            <i class="far fa-times-circle"></i> Özelliği Sil' +
        '                         </a>' +
        '                      </div>' +
        '                    </div>');

    $('#count').val(count);
    $('.select2').select2();
    $('.summernote').summernote({
        height: 150,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
}
function removeProperties(id){
    if($('.properties').children().length <= 1){
        $('.properties').append('<div class="alert alert-custom alert-light-warning fade show alert-properties" role="alert" style="padding: 13px;"> Soru ve Cevap Eklenmedi!</div>');
    }

    let removes = $('#remove').val();
    let cnt     = '';

    if(removes != ''){ cnt += ',' + id }else{ cnt += id }

    $('#remove').val(cnt);
    $('#content-'+id).remove();
    let sssId = $('#sssId').val();

    $.ajax({
        type: "POST",
        url: '/tavsiocms/sss/question-remove-ajax',
        data: {id:id,sssId:sssId},
        dataType: "json",
        success: function(result){ }
    });
}
function saveProperties(id){
    let question = $('#question-' + id).val();
    let answer   = $('#answer-' + id).summernote('code');
    let sssId    = $('#sssId').val();

    $.ajax({
        type: "POST",
        url: '/tavsiocms/sss/question-ajax',
        data: {id:id,answer:answer,sssId:sssId,question:question},
        dataType: "json",
        success: function(result){
            responseMessage(result.status,result.message);
        }
    });
}
