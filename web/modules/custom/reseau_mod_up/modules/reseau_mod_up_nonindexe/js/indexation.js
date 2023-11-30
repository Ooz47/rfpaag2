(function ($, Drupal, window, document) {

    'use strict';
  
    // To understand behaviors, see https://drupal.org/node/756722#behaviors
    Drupal.behaviors.indexation = {
      attach: function (context, settings) {
        // console.log("hello");

var inputsSitemap =  $( 'input[name="simple_sitemap[default][index]"]' );
var inputMenu =  $( 'input[name="menu[enabled]"]' );
var detailsMenu =  $( 'details[id="edit-menu"]' );

$(context).find(".field--name-field-contenu-indexation").once("form-item-field-contenu-indexation").each(function () {
    

    var inputName = $(this).find("input").first().attr("name");
    var value = $( 'input[name="'+inputName+'"]:checked' ).val();
    console.log(value);
   //Au chargement de l'entité on vérifie sur un choix est selectionnée
    if(value === undefined) {
        // si undefined on coche le deuxièmre : "oui"
        $( 'input[name="'+inputName+'"]' )[1].checked= true;
        // $( 'input[name="'+inputName+'"]' )[1].val(1);
    }

    $('input[name="'+inputName+'"]').change(function(){
        var value = $( 'input[name="'+inputName+'"]:checked' ).val();
        // var champFonction = $(this).closest(".field--name-field-ctc-ref-handicap").siblings(".field--name-field-ctc-fonction").find("input");
        
        // console.log(inputsSitemap);
        // console.log(this);
        // console.log($(this));
        // console.log($(this).val());
        //Indexation autorisé
        if(value == 1) {
            // console.log(value);
          
            // console.log(champFonction);
            // console.log(champFonction.val());
            // if(champFonction.val() === '' ) {
                // champFonction.val("Référent Handicap");
                // test[0].checked= true;
                console.log(inputMenu);
                console.log(detailsMenu);
                inputsSitemap[1].checked= true;
                detailsMenu.show(100);
                // inputMenu[0].checked= true;
                // // console.log($( '#edit-simple-sitemap-default-index-0' ));
                // // console.log(test);
                // test.val(0);
            // }
        }
        else {
            //Indexation non autorisé
            inputMenu[0].checked= false;
            // inputMenu[0].val(0);
            detailsMenu.hide(100);
            inputsSitemap[0].checked= true;
            // test.val(1);
        }

        });

// console.log(this);
  });


    }
};

})(jQuery, Drupal, this, this.document);