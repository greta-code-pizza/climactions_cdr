// -----------------------------------------------------------------------------
// les catégories dans le formulaire de création d'article
// -----------------------------------------------------------------------------

jQuery(document).ready(function($){
    $(".format-game").hide();
    $(".name-author").hide();   
    $(".format-expo").hide();
    $(".name-public").hide();
});


$("#select-block").change(function() {

    if ( $("#select-block").val() == "1" ){
        
        $(".format-expo").hide();
        $(".format-game").show();
        $(".name-public").show();    
        $(".name-author").show();    
    }
    
    if ( $("#select-block").val() == "3" ){ 
        
        $(".name-author").show();
        $(".format-expo").hide();
        $(".format-game").hide();   
        $(".name-public").show();
    }
   
    if ( $("#select-block").val() == "2" ){
        
        
        $(".format-flyer").hide();
        $(".format-game").hide();
        $(".format-expo").hide();
        $(".name-author").show();
        $(".name-public").show();

    }

    if ( $("#select-block").val() == "4" ){
        
        $(".format-game").hide();
        $(".name-public").hide();
        $(".name-author").hide();

        $(".format-expo").show();

    }

});
