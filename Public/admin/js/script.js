// -----------------------------------------------------------------------------
// SOMMAIRE
// -----------------------------------------------------------------------------

// la classe active
// les catégories dans le formulaire de création d'article
// la barre de recherche d'une ressource

// -----------------------------------------------------------------------------
// la classe active
// -----------------------------------------------------------------------------

$(".block-link")
.filter(function () {
    return location.href == this.href;
})
.addClass("active");

// -----------------------------------------------------------------------------
// les catégories dans le formulaire de création d'article
// -----------------------------------------------------------------------------

jQuery(document).ready(function($){
    $(".name-producer").hide();
    $(".name-director").hide();
    $(".format-flyer").hide();
    $(".name-editor").hide();
    $(".name-author").hide();  
    $(".name-creator").hide();
    $(".format-game").hide();  
    $(".name-public").hide();  
});


$("#select-block").change(function() {

    if ( $("#select-block").val() == "game" ){
        
        $(".name-producer").hide();
        $(".name-director").hide();
        $(".format-flyer").hide();
        $(".name-editor").hide();
        $(".name-author").hide();
        
        $(".name-creator").show();
        $(".format-game").show();
        $(".name-public").show();
        
    }
    
    if ( $("#select-block").val() == "movie" ){ 
        
        $(".name-editor").hide();
        $(".name-author").hide();
        $(".format-flyer").hide();
        $(".name-creator").hide();
        $(".format-game").hide();
        
        $(".name-producer").show();
        $(".name-director").show();
        $(".name-public").show();
    }
   
    if ( $("#select-block").val() == "book" ){
        
        $(".name-producer").hide();
        $(".name-director").hide();
        $(".format-flyer").hide();
        $(".name-creator").hide();
        $(".format-game").hide();

        $(".name-editor").show();
        $(".name-author").show();
        $(".name-public").show();

    }

    if ( $("#select-block").val() == "flyer" ){
        
        $(".name-producer").hide();
        $(".name-director").hide();
        $(".format-flyer").hide();
        $(".name-creator").hide();
        $(".format-game").hide();
        $(".name-editor").hide();
        $(".name-author").hide();
        $(".name-public").hide();

        $(".format-flyer").show();

    }

});
