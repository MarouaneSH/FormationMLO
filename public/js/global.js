$(document).ready(function(){
    closeEXIT();
})

function closeEXIT()
{
    $(".exit").click(function(){
        $(this).parent().fadeOut();
        $(".back-hide").hide();
    })
}


// function ShowerrorOrSuccess(data,divToClose)
// {
//     $(".loading").hide();
//     if(data.success==true)
//     {
//         $(".alert").hide();
//         $(".success").show();
//         $(divToClose).hide();
//     }
//     else
//     {
//         $(".alert").show();
//         $.each(data.errors,function(i,error){
//             $(".alert").append("<li>"+error+"</li>")
//         });
//     }
// }


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
                    alert("Something Wrong Please Contact Developer to Reseolve This problem");
                }
            })
    })
}
