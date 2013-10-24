(function($){

    $.jAvatarUploadable = function(){
          var jau = {
             animated: true,
             toggleOverlay: function(){
                if($('#over_x').css('display') == 'none') {
                   $('#over_x').css('display',"block");
                   $('#over_y').css('display',"block");
                   $('#mybutt').css('display',"block");
                }else{
                   $('#over_x').css('display',"none");
                   $('#over_y').css('display',"none");
                   $('.prv').css('display','none');
                }
             },
             doLoad: function(){
                   //document.getElementById("mybutt").style.display='none';
                   var form = new FormData(document.getElementById("upload_form"));
                   var oFile = document.getElementById('image').files[0];
                   var oImage = document.getElementById('preview');
                   var upload_info = document.getElementById('upload_info');
                   var oReader = new FileReader();
                   oReader.onload = function(e){
                       // e.target.result contains the DataURL which we will use as a source of the image
                       oImage.src = e.target.result;
                       $('.prv').css('display','block');

                   };

                   oReader.readAsDataURL(oFile);
                   form.append("userfile",oFile);
                   var oReq = new XMLHttpRequest();
                   oReq.open("POST","/user/avatar/upload",true);
                   oReq.onload=function(oEvent){
                       //alert(oReq.response);
                   }
                    oReq.send(form); 
               }              
             };
          
          return {
                    toggleOverlay: jau.toggleOverlay,
                    doLoad: jau.doLoad
          };
    }

    $.tsSearchable = function(){
        var tss = {
            doWork: function(){
                var text = $("#ts_input").val();
                if(text=='') {
                    $('#ts_content_wrap').css('display','none');
                    return;
                }
                else{
                    $.post('/ts_work',{txt:text},function(response){
                        var users = response.names;
                        var photos = response.photos;

                        var names2 = response.names2;
                        var photos2 = response.photos2;

                        var t = '';

                        for(var i=0;i<photos.length;i++)
                        if(photos[i]=='default')
                            photos[i] = '/bundles/needyou/images/camera_a.gif';

                        for(var i=0;i<photos.length;i++){
                        t = t+ '<a href=\"'+users[i]+'\"><div  class=\"ts_content\" id=\"contact_'+i+'\" onmouseover = \"tss.isActive(this,this,this);\" onmouseout=\"tss.deselect(this)\">' +
                            '<span class=\"ts_contact_photo fl_l\"><img src=\"'+photos[i]+'\" /></span>' +
                            '<span class=\"ts_contact_name fl_l\">'+users[i]+
                            '<div class=\"ts_contact_info\"> 26 лет, Алматы </div>'+
                            '</span></div></a>';
                        }

                        if(users.length > 0 & names2.length>0)
                          t= t + '<div id=\"ts_search_sep\">Результаты поиска</div>';

                        $('#ts_content_list').html(t);
                        $('#ts_content_guide').css('display','block');
                        $('#ts_word').text(text);
                    },"json");
                    $("#ts_content_wrap").css('display','block');
                }
            },
            finishWork: function(event){
                var target = $(event.target);

                if (!target.attr('id') || !target.attr('id').match('ts_input')){
                    $('#ts_content_wrap').css('display','none');
                }
            },
            isActive: function(a,b,c){
               var id = a.id;
               $('#'+id).addClass('active');
            },
            isNotActive: function(a){
                var id = a.id;
                $('#'+id).removeClass('active');

            },
            doRequest: function(){
                $.post('/friends/list',{name:'Bauka'},function(response){
                    alert(response.success);
                },"json");

            }
        };

        var n = $.documentClick.listeners.length;
        $.documentClick.listeners[n] = tss.finishWork;

        return {
            toggleBar: tss.doWork,
            isActive: tss.isActive,
            deselect: tss.isNotActive,
            doRequest: tss.doRequest
        }
    }

    $.documentClick={
        'listeners': []
    }

    $(document).ready(function(){

       $("#login").submit(function(event){
           this.form.submit();
            event.preventDefault();
       });
       $("#login").each(function(){
           $('input').keypress(function(e){
               if(e.which ==10 || e.which==13){
                   this.form.submit();
               }
           });
       });
        $('#friends').keydown(function(){
                showFriends();
        });

        $(document).click(function(event) {
            for(var i = 0; i< $.documentClick.listeners.length;i++)
                $.documentClick.listeners[i](event);
        });
        
});


})(jQuery);


