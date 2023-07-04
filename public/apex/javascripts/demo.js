(function() {
  $(document).ready(function() {
    if (localStorage.getItem("content") !== null) {
      $("#color-settings-body-color").attr("href", localStorage.getItem("content"));
    }
    if ((localStorage.getItem("contrast") !== null) && !$("body").hasClass("contrast-background")) {
      $("body")[0].className = $("body")[0].className.replace(/(^|\s)contrast.*?(\s|$)/g, " ").replace(/\s\s+/g, " ").replace(/(^\s|\s$)/g, "");
      $("body").addClass(localStorage.getItem("contrast"));
    }
    $(".color-settings-body-color > a").hover(function() {
      $("#color-settings-body-color").attr("href", $(this).data("change-to"));
      return localStorage.setItem("content", $(this).data("change-to"));
    });
    return $(".color-settings-contrast-color > a").hover(function() {
      $('body')[0].className = $('body')[0].className.replace(/(^|\s)contrast.*?(\s|$)/g, ' ').replace(/\s\s+/g, ' ').replace(/(^\s|\s$)/g, '');
      $('body').addClass($(this).data("change-to"));
      return localStorage.setItem("contrast", $(this).data("change-to"));
    });



  });

}).call(this);

$(document).ready(function() {

    $('[data-toggle="popover"]').popover({

    });

});

function ajaxError(xhr, status, error) {
    if(xhr.status ==401){
        return "You are not logged in. please login and try again";
    }else if(xhr.status == 403){
        return "You have not permission for perform this operations";
    }else if(xhr.responseJSON && xhr.responseJSON.message!=""){
        return xhr.responseJSON.message;
    }else{
        return"Something went wrong , Please try again later.";
    }
}


/*
$(document).ready(function() {
    $('.datatable').DataTable( {
        "scrollX": true
    } );
});*/