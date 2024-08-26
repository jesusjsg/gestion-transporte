export function getPlaca(field, url){
    $(field).autocomplete({
        source: function(request, response){
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                data:{
                    term: request.term
                },
                success: function(data){
                    console.log(data)
                    response(data)
                }
            })
        }
    })
}