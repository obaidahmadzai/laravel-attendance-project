$(document).ready(function(){
    $('.sidenav').sidenav();
    $('.dropdown-trigger').dropdown({
        'coverTrigger' : false,
        'constrainWidth': false

    });
    $('.tabs').tabs();
    $('.datepicker').datepicker({
        autoClose:true,
        format: 'yyyy/mm/dd'
    });
    $('select').formSelect();
    $('.timepicker').timepicker();
    $('.lazy').lazy();
  });
