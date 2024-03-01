jQuery(document).ready(function($) {
    let customFieldHasBeenvalueSet = false;
    $('#custom_page_title').on('blur',function(e){
        let customFieldVal = $('#custom_page_title').val();
            customFieldHasBeenvalueSet = true; 
            wp.data.dispatch('core/editor').editPost({ title: customFieldVal });
    });

    $("a.cancelModal").click(function(){
        $('#main-section').fadeOut();
        $("#customTitleModal").fadeOut();
    });
});
