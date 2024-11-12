$(function(){

    const request = (url,params) => {
        $.post(url,params,function(result){
            if(JSON.parse(result).type == 'success'){
                window.location.href = JSON.parse(result).url
            }
            console.log(JSON.parse(result))
        })
    }

    $(".signin").on("click",function(evt){
        evt.preventDefault()
        let params = {username: $(".username").val().trim(),password: $(".password").val().trim()};
        let isEmpty = Object.values(params).some(param => param === "");
        !isEmpty ? request('../admin/signin',params) : console.log("One or more fields are empty");
    })

})