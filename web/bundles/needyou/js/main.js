(function($){

$(document).ready(function(){
       $("#login").submit(function(event){
            alert('ok you pressed');
            event.preventDefault();
       });
       //$('#loh').submit();
    });
})(jQuery);