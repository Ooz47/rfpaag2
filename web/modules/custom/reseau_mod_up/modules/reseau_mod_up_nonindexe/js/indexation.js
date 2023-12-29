(function ($, Drupal, window, document) {

<<<<<<< HEAD
  'use strict';

  // To understand behaviors, see https://drupal.org/node/756722#behaviors
  Drupal.behaviors.indexation = {
    attach: function (context, settings) {
      // console.log("hello");

      var inputsSitemap = $('input[name="simple_sitemap[default][index]"]');
      var inputMenu = $('input[name="menu[enabled]"]');
      var detailsMenu = $('details[id="edit-menu"]');

      $(context).find(".field--name-field-contenu-indexation").once("form-item-field-contenu-indexation").each(function () {


        var inputName = $(this).find("input").first().attr("name");
        var value = $('input[name="' + inputName + '"]:checked').val();
        console.log(value);
        //Au chargement de l'entité on vérifie sur un choix est selectionnée
        if (value === undefined) {
          // si undefined on coche le deuxièmre : "oui"
          $('input[name="' + inputName + '"]')[1].checked = true;
          // $( 'input[name="'+inputName+'"]' )[1].val(1);
        }

        if (value == false) {
          // si est sur non, on cache option du menu
          detailsMenu.hide(1);
        }

        $('input[name="' + inputName + '"]').change(function () {
          var value = $('input[name="' + inputName + '"]:checked').val();

          //Indexation autorisé
          if (value == 1) {
            // console.log(value);
            // console.log(inputMenu);
            // console.log(detailsMenu);
            inputsSitemap[1].checked = true;
            detailsMenu.show(100);

            // }
          } else {
            //Indexation non autorisé
            inputMenu[0].checked = false;
            detailsMenu.hide(100);
            inputsSitemap[0].checked = true;
          }

        });

        // console.log(this);
      });


    }
  };

})(jQuery, Drupal, this, this.document);
=======
    'use strict';
  
    // To understand behaviors, see https://drupal.org/node/756722#behaviors
    Drupal.behaviors.indexation = {
      attach: function (context, settings) {
        // console.log("hello");

var test =  $( 'input[name="simple_sitemap[default][index]"]' );

$(context).find(".form-item-field-contenu-indexation").once("form-item-field-contenu-indexation").each(function () {
    // console.log($(this).find("input").first().attr("name"));

    var inputName = $(this).find("input").first().attr("name");
    var value = $( 'input[name="'+inputName+'"]:checked' ).val();

   //Au chargement de l'entité on vérifie sur un choix est selectionnée
    if(value === undefined) {
        // si undefined on coche le premier
        $( 'input[name="'+inputName+'"]' )[0].checked= true;
        $( 'input[name="'+inputName+'"]' ).val(0);
    }

    $('input[name="'+inputName+'"]').change(function(){
        var value = $( 'input[name="'+inputName+'"]:checked' ).val();
        // var champFonction = $(this).closest(".field--name-field-ctc-ref-handicap").siblings(".field--name-field-ctc-fonction").find("input");
        
        // console.log(test);

        if(value == 1) {
            // console.log(value);
          
            // console.log(champFonction);
            // console.log(champFonction.val());
            // if(champFonction.val() === '' ) {
                // champFonction.val("Référent Handicap");
                test[0].checked= true;
                console.log($( '#edit-simple-sitemap-default-index-0' ));
                // console.log(test);
                test.val(0);
            // }
        }
        else {
       
            test[1].checked= true;
            test.val(1);
        }

        });

// console.log(this);
  });


    }
};

})(jQuery, Drupal, this, this.document);
>>>>>>> e5782c0467488c4ed9583877bea24221f86fafc6
