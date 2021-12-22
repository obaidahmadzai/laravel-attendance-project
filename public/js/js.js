function errors(jqXHR, exception) {
    var msg = "";
    if (jqXHR.status === 0) {
        msg = 'Connection Problem';
        $("#app").html("<h3 align='center'>Internet connection lost</h3>");
    } else if (jqXHR.status == 404) {
        msg = 'Requested page not found. [404]';
    } else if (jqXHR.status == 500) {
        /*msg = 'Internal Server Error [500].';*/
        var responseText2 = jQuery.parseJSON(jqXHR.responseText);
        msg = 'Error (500): ' + responseText2.message + "<br>";
        msg += 'Line: ' + responseText2.line + "<br>";
        $.each(responseText2.errors, function (value, index) {
            var errorarray = eval('responseText.errors.' + value);
            $.each(errorarray, function (value1, index1) {
                msg += value + ": " + index1 + "<br>";
                $('input[name="' + value + '"]').addClass('invalid').parent('.input-field').find('.helper-text').attr('data-error', index1);
            })
        });
    } else if (exception === 'parsererror') {
        msg = 'Requested JSON parse failed.';
    } else if (exception === 'timeout') {
        msg = 'Time out error.';
    } else if (exception === 'abort') {
        msg = 'Ajax request aborted.';
    } else {
        var responseText = jQuery.parseJSON(jqXHR.responseText);
        var num = 1;
        $.each(responseText.errors, function (value, index) {
            var errorarray = eval('responseText.errors.' + value);
            $.each(errorarray, function (value1, index1) {
                msg += num++ + " . " + index1 + "\n";
                $('input[name="' + value + '"], select[name="' + value + '"], textarea[name="' + value + '"]').addClass('invalid').parents('.input-parent').addClass('invalid-border').find('.validation-message').html('<small class="red-text py-3">' + index1 + '</small>');
            });
        });
        try {
            var scroll = $('.invalid').offset();
            window.scrollTo(0, Math.round(scroll.top) - 100);
        } catch (e) {
        }
    }
    return msg;
}
var aem = {
    loading(size='m'){
        switch (size){
            case 'l':
            size = 'big'
            break;
            case 'm':
            size = '';
            break;
            case 's':
            size = 'small';
            break;
        }
        return `
        <center>
        <div class="preloader-wrapper ${size} active">
        <div class="spinner-layer spinner-blue">
        <div class="circle-clipper left">
        <div class="circle"></div>
        </div><div class="gap-patch">
        <div class="circle"></div>
        </div><div class="circle-clipper right">
        <div class="circle"></div>
        </div>
        </div>

        <div class="spinner-layer spinner-red">
        <div class="circle-clipper left">
        <div class="circle"></div>
        </div><div class="gap-patch">
        <div class="circle"></div>
        </div><div class="circle-clipper right">
        <div class="circle"></div>
        </div>
        </div>

        <div class="spinner-layer spinner-yellow">
        <div class="circle-clipper left">
        <div class="circle"></div>
        </div><div class="gap-patch">
        <div class="circle"></div>
        </div><div class="circle-clipper right">
        <div class="circle"></div>
        </div>
        </div>

        <div class="spinner-layer spinner-green">
        <div class="circle-clipper left">
        <div class="circle"></div>
        </div><div class="gap-patch">
        <div class="circle"></div>
        </div><div class="circle-clipper right">
        <div class="circle"></div>
        </div>
        </div>
        </div>
        </center>
        `;
    },

    request: function (url, effect,target ,method, loading, modal= false,data=null, form=false) {
        var pre_html = $(effect).html();
        if (modal){
            if (form){
                $(effect).html(loading).prop('disabled',true);
            }else{
                $(effect).html(`<div class="modal-content py-4">${loading}</div>`)
            }
        }else{
            $(effect).html(loading);
        }
        $.ajax({
            url: url,
            method: method,
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (form){
                    $(effect).html(pre_html).removeAttr('disabled');
                }
                if (data.result) {
                    if (form){
                        swal({
                            icon: 'success',
                            title: data.message
                        });
                    }
                    if (form){
                        $('.modal').attr("style","display:none");
                        $(`.modal-overlay`).attr("style","display:none");
                        $('#list').html(data.view);
                    }
                    $(target).html(data.view);
                } else {
                    if (modal){
                        var instance = M.Modal.getInstance($("#modal"));
                        instance.close();
                    }

                    M.toast({
                        html: data.message,
                        classes: 'red rounded'
                    });
                }
            },
            error: function (xhr, secondError) {
                if (modal){
                    if (xhr.status === 500){
                        var instance = M.Modal.getInstance($("#modal"));
                        instance.close();
                    }else if(xhr.status === 404){
                        var instance = M.Modal.getInstance($("#modal"));
                        instance.close();
                    }
                }
                if (form){
                    $(effect).html(pre_html).removeAttr('disabled');
                }
                swal({
                    icon: 'error',
                    title: 'Something went wrong',
                    text: errors(xhr, secondError)
                });
            }
        });
    },
    modal: function (url) {
        var modal = $("#modal");
        var instance = M.Modal.getInstance(modal);
        $("#modal").modal();
        instance.open();
        aem.request(url,'#modal','#modal','GET', aem.loading('s'),true,true,false);
    },
    formRequest: function(event){
        event.preventDefault();
        var form_data = new FormData(document.getElementById($(event.target).attr('id')));

        var url = $(event.target).attr('action');
        var effect = $(event.target).data('effect');
        aem.request(url, '.form_button',effect,'POST', '<span class="spinner-border spinner-border-sm"></span>',true,form_data,true);
    },
    todoRead: function(event,url,token){
        var parenet = $(event.target).parents('p').find('.text');
        var text = parenet.text();
        var status = null;
        if ($(event.target).is(':checked')){
            var del = `<del>${text}</del>`;
            parenet.html(del);
            status = false;
        }else{
            parenet.html(text);
            status = true;
        }
        $.ajax({
            method: 'PATCH',
            url: url,
            data: {
                status: status,
                '_token': token
            }
        });
    },
    _delete: function(event,url,target,type="ajax"){
        var pre_data = $(event.target).html();
        swal({
            title: "Are you sure?",
            icon: "warning",
            buttons: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var btn = $(event.target).attr('class').split(' ')[0]=="fa"?$(event.target).parent('button'):$(event.target);
                var html = btn.html();
                btn.html('<span class="spinner-border spinner-border-sm"></span>').prop('disabled',true);
                $.ajax({
                    url: url,
                    method: 'DELETE',
                    data: {'_token': $('input[name="_token"]').val()},
                    success: function(data){
                        btn.html(html).removeAttr('disabled');
                        if (type=="http"){
                            if (data.status){
                                swal({
                                    title: 'success',
                                    icon: 'success',
                                    text: data.message
                                });
                                setTimeout(function(){
                                    window.location.href = data.url
                                },1000);
                            }
                        }else if(type=="ajax"){
                            if (data.status){
                                swal({
                                    title: 'success',
                                    icon: 'success',
                                    text: data.message
                                });

                                $(target).html(data.body);
                            }else {
                                if (data.show_type === "notify") {
                                    $.notify(data.message, {type: 'info', position: 'top center'});
                                } else if (data.show_type == "swal") {
                                    swal({
                                        icon: 'error',
                                        title: 'Error',
                                        text: data.message
                                    });
                                }
                            }
                        }
                    },

                    error: function(){
                        alert('Connection Error');
                        btn.html(html).removeAttr('disabled');
                    }
                });
            }
        });
    },
    loadAjaxFromSelect: function(event,url, target, loadings, history=false, request=false){
        var isTargetArray = false;
        $(target).resize();
        if(Array.isArray(target)){
            $.each(target, function (one,two) {
                $(two).html(loadings[one]);
            });
            isTargetArray = true;
        }else{
            $(target).html(loadings);
        }
        if(!request){
            var parameter_name = $(event.target).attr('name');
            url = url+"&"+parameter_name+"="+$(event.target).val()+"&is_result_array="+isTargetArray;
        }
        $.ajax({
            url: url,
            method: 'GET',
            success: function (data) {
                if(data.result){
                    if(history){
                        window.history.pushState('','',url.replace('ajax','http'));
                    }
                    if(isTargetArray){
                        $.each(data.views, function (one,element) {
                            $(target[one]).html(element);
                        });
                    }
                    else{
                        $(target).html(data.view);
                    }
                }
            },
            error: function (one) {
                if (isTargetArray){
                    $.each(target, function (one,element) {
                        $(element).html('<p class="text-danger" align="center">internet problem</p>');
                    });
                }else{
                    $(target).html('<p class="text-danger" align="center">internet problem</p>');
                }
            }
        });
    },
    toggleElement: function(element){
        $(element).slideToggle();
    },
    toggleElementHide: function(element){
        $(element).slideUp(element);
    },

    changeImage: function (input){
        if(input.files && input.files[0] ){
            var reader = new FileReader();
            reader.onload = function(e){

                $('#profile_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);

        }
    }


};



$(document).ready(function() {
    setTimeout( () =>{
        M.updateTextFields();
    },500);
    var data  = $("#sidenav").find('.active').html();
    $("#logo").html(data);
});






