(function($){

$(document).ready(function(){

    alert($('#image').val());
       /*$("#login").submit(function(event){
           this.form.submit();
            event.preventDefault();
       });
       $("#login").each(function(){
           $('input').keypress(function(e){
               if(e.which ==10 || e.which==13){
                   this.form.submit();
               }
           });
       });*/
        /*$('#button').on('click',
            function(){
                aButtonPressed();
            }
        );*/
        $('#friends').keydown(function(){
                showFriends();
        });
        $('#photo').on('click',
            function(){
                $('#over_x').css('display',"block");
                $('#over_y').css('display',"block");
            });
        $('#photo_close').on('click',
            function(){
                $('#over_x').css('display',"none");
                $('#over_y').css('display',"none");
            }
        );


//        $('#upload').on('change',
//            function(){
//                var form = new FormData($('#upload'));
//                alert(form);
//                $.ajax({
//                    url: '/upload',
//                    type: 'POST',
//                    success: function (r) {
//                        //$('.container').html(r);
//                        var response = JSON.parse(r);
//                        alert(response.data);
//                    },
//                    data: form,
//                    cache: false,
//                    contentType: false,
//                    processData: false
//                });
//                /*$.post('upload',
//                {data: form},
//                    function(response){
//                        alert(response.data);
//                    }, "json");*/
//            });
//

        $('#image').on('change',function(){
             alert('ok');
            var form = new FormData($('#myform')[0]);
            //alert($("#myform")[2]);
            $.ajax({
                url: '/upload',
                type: 'POST',
                success: function (r) {
                    //$('.container').html(r);
                    var response = JSON.parse(r);
                    alert(response.data);
                },
                data: form,
                cache: false,
                contentType: false,
                processData: false
            });
        });

});
})(jQuery);