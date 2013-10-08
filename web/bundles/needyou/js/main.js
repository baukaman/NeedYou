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
        
});


})(jQuery);


