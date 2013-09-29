(function($){

$(document).ready(function(){
       $("#login").submit(function(event){
            alert('ok you pressed');
            event.preventDefault();
       });
       $("#login").each(function(){
           $('input').keypress(function(e){
               if(e.which ==10 || e.which==13){
                   this.form.submit();
               }
           });
       });
    });
})(jQuery);