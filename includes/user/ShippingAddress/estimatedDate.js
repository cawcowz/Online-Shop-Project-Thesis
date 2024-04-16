

$("document").ready(function(){
    
    $.ajax({
    
        url  : "EstimatedDate.php",
        method  : "POST",
        data  : {
            data : "true"
        },
        success : function(response){
            $("#estimatedDate").html(response)
        }
    })
})