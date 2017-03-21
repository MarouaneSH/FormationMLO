$(document).ready(function(){
    closeEXIT();
    ShowNotification();
    CalculNotification(0);
})

function CalculNotification(substract)
{
    var count =0;
    $("#notification-card a").each(function(){
       count += 1;
    })
    $(".notification p").html(count-substract);

}
function ShowNotification()
{
    $(".notification").click(function(){
        $(".notification p").toggle();
        $("#notification-card").slideToggle();
    })
}
function closeEXIT()
{
    $(".exit").click(function(){
        $(this).parent().fadeOut();
        $(".back-hide").hide();
    })
}

function GetAjaxData(ROUTEurl,divToSubmit,TypeMethod,divToClose)
{
   $(divToSubmit).submit(function(e)
        {
            $(".alert").html("");
            e.preventDefault();
            $.ajax({
                url:ROUTEurl,
                type:TypeMethod,
                beforeSend:function()
                {
                    $(".loading").show();
                },
                data:$(this).serialize(),
                success:function(data)
                {
                   $(".loading").hide();
                        if(data.success==true)
                        {
                            $(".alert").hide();
                            $(".success").show();
                            $(divToClose).hide();
                        }
                        else
                        {
                            $(".alert").show();
                            $.each(data.errors,function(i,error){
                                $(".alert").append("<li>"+error+"</li>")
                            });
                        }
                },
                error:function()
                {
                    $(".loading").hide();
                    alert("Something Wrong Please Contact Developer to Reseolve This problem");
                }
            })
    })
}
