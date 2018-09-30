/* Фейковые ссылки */
$(document).delegate("[data-goto]","click", function() {
    if($(this).data('goto'))
    {
        var text_confirm = $(this).data('confirm');
        if(text_confirm){
            if(!confirm(text_confirm)) return;
        }
        var href = $(this).data('goto');
        if($(this).data('target')=="blank") window.open(href, '_blank');
        else window.location = href;
    }
    return false;
});