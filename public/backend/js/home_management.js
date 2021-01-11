function changeLessonData(uuid,value){
    $.ajax({
        type: "POST",
        url: '/tavsiocms/home-management/block-change-lessons-ajax',
        data: {uuid:uuid,value:value},
        dataType: "json",
        success: function(result){
            responseMessage(result.status,result.message);
        }
    });
}
$(() => {
    const wrapper = $("#wrapper")[0];
    Sortable.create(wrapper, {
        draggable: ".box",
        onEnd: function (evt) {
            let uuid     = evt.item.dataset.uuid;
            let oldIndex = evt.oldIndex;
            let newIndex = evt.newIndex;

            $.ajax({
                type: "POST",
                url: '/tavsiocms/home-management/block-lessons-ajax',
                data: {oldIndex:oldIndex,newIndex:newIndex,uuid:uuid},
                dataType: "json",
                success: function(result){
                    responseMessage(result.status,result.message);
                }
            });
        }
    });

    $('.select2').select2();
});
