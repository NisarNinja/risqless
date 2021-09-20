// image validation code
        // $('button[type="submit"]').prop("disabled", true);
        var a=0;
        //binds to onchange event of your input field
        $("input[name='photo']").bind('change', function() {
        if ($('button:submit').attr('disabled',false)){
             $('button:submit').attr('disabled',true);
             }
            var ext = $("input[name='photo']").val().split('.').pop().toLowerCase();
            if ($.inArray(ext, ['gif','png','jpg','jpeg']) == -1){

	             $('#error1').slideDown("slow");
	             $('#error2').slideUp("slow");
	             a=0;

             }
             else{
             	
	             var picsize = (this.files[0].size);
	             if (picsize > 5000000){
	             $('#error2').slideDown("slow");
	             a=0;
	             }else{
	             a=1;
	             $('#error2').slideUp("slow");
	             }
	             $('#error1').slideUp("slow");

                 

	             if (a==1){
	             $('button:submit').attr('disabled',false);
             }

            }

        });

        //binds to onchange event of your input field
        $("input[name='reference']").bind('change', function() {
            
            let ext = $("input[name='reference']").val().split('.').pop().toLowerCase();
            if ($.inArray(ext, ['gif','pdf']) == -1){

                 $('#reference-error1').slideDown("slow");
                 $('#reference-error2').slideUp("slow");
                 a=0;

             }
             else{
                
                 let picsize = (this.files[0].size);
                 if (picsize > 5000000){
                 $('#reference-error2').slideDown("slow");
                 a=0;
                 }else{
                 a=1;
                 $('#reference-error2').slideUp("slow");
                 }
                 $('#reference-error1').slideUp("slow");
                 if (a==1){
                 $('button:submit').attr('disabled',false);
             }
            }
        });

        // Resume validation code

        //binds to onchange event of your input field
        $("input[name='resume']").bind('change', function() {
            
            let ext = $("input[name='resume']").val().split('.').pop().toLowerCase();
            if ($.inArray(ext, ['gif','pdf']) == -1){

                 $('#error1').slideDown("slow");
                 $('#error2').slideUp("slow");
                 $('#resume-required').slideUp("slow");
                 a=0;

             }
             else{
                
                 let picsize = (this.files[0].size);
                 if (picsize > 5000000){
                 $('#error2').slideDown("slow");
                 $('#resume-required').slideUp("slow");
                 a=0;
                 }else{
                 a=1;
                 $('#error2').slideUp("slow");
                 $('#resume-required').slideUp("slow");
                 }
                 $('#error1').slideUp("slow");
                 $('#resume-required').slideUp("slow");
                 if (a==1){
                 $('button:submit').attr('disabled',false);
             }
            }
        });

        // Audio validation code

        //binds to onchange event of your input field
        $("input[name='audio']").bind('change', function() {
        if ($('button:submit').attr('disabled',false)){
             $('button:submit').attr('disabled',true);
             }
            let ext = $("input[name='audio']").val().split('.').pop().toLowerCase();
            if ($.inArray(ext, ['mp3','3gp','wav']) == -1){

                 $('#error1').slideDown("slow");
                 $('#error2').slideUp("slow");
                 a=0;

             }
             else{
                
                 let picsize = (this.files[0].size);
                 if (picsize > 500000000){
                 $('#error2').slideDown("slow");
                 a=0;
                 }else{
                 a=1;
                 $('#error2').slideUp("slow");
                 }
                 $('#error1').slideUp("slow");
                 if (a==1){
                 $('button:submit').attr('disabled',false);
             }
            }
        });

        // Video validation code

        //binds to onchange event of your input field
        $("input[name='video']").bind('change', function() {
        if ($('button:submit').attr('disabled',false)){
             $('button:submit').attr('disabled',true);
             }
            var ext = $("input[name='video']").val().split('.').pop().toLowerCase();
            if ($.inArray(ext, ['mp4','webm','flv']) == -1){

                 $('#videoerror1').slideDown("slow");
                 $('#videoerror2').slideUp("slow");
                 a=0;

             }
             else{
                
                 var picsize = (this.files[0].size);
                 if (picsize > 2000000000){
                 $('#videoerror2').slideDown("slow");
                 a=0;
                 }else{
                 a=1;
                 $('#videoerror2').slideUp("slow");
                 }
                 $('#videoerror1').slideUp("slow");
                 if (a==1){
                 $('button:submit').attr('disabled',false);
             }
            }
        });

////////////////// Front End Image Validate Code

        //binds to onchange event of your input field
        $("input.image").change( function(event) {

        if ($('button:submit').attr('disabled',false)){
             $('button:submit').attr('disabled',true);
             }
            var ext = $(this).val().split('.').pop().toLowerCase();
            if ($.inArray(ext, ['gif','png','jpg','jpeg']) == -1){

                 $(this).next('p.error1').slideDown("slow");
                 $(this).parents('div.card').css({'border':'1px solid rgb(184, 17, 17)','background-color':'rgb(255, 223, 223)'})
                 $(this).next('p.error2').slideUp("slow");
                 a=0;

             }
             else{
                
                 var picsize = (this.files[0].size);
                 if (picsize > 5000000){
                 $(this).next('p.error2').slideDown("slow");
                 $(this).parents('div.card').css({'border':'1px solid rgb(184, 17, 17)','background-color':'rgb(255, 223, 223)'})
                 a=0;
                 }else{
                 a=1;
                 $(this).next('p.error2').slideUp("slow");
                 $(this).parents('div.card').css({'border':'1px solid rgba(0,0,0,.125)','background-color':'#fff'})
                 }
                 $(this).next('p.error1').slideUp("slow");
                 $(this).parents('div.card').css({'border':'1px solid rgba(0,0,0,.125)','background-color':'#fff'})

                 if (a==1){
                 $('button:submit').attr('disabled',false);
             }
            }
        });