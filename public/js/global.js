$(document).ready(function(){
    closeEXIT();
})

function closeEXIT()
{
    $(".exit").click(function(){
        $(this).parent().fadeOut();
    })
}