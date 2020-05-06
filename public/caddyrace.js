/* eslint-env jquery */
/* global $ */
/* global alert */
/* global document */
/* global navigator */
"use strict";

//**************************************************************************************
// => Stop Carousel automatic on mobile       
//**************************************************************************************

var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};


//**************************************************************************************
// => Carousel slider use mobile left/right
//**************************************************************************************

// => to hide a warning message with "touchstart"   
jQuery.event.special.touchstart = 
{
  setup: function( _, ns, handle )
  {
    if ( ns.includes("noPreventDefault") ) 
    {
      this.addEventListener("touchstart", handle, { passive: false });
    } 
    else 
    {
      this.addEventListener("touchstart", handle, { passive: true });
    }
  }
};

$(".carousel").on("touchstart", function(event){
        var xClick = event.originalEvent.touches[0].pageX;
    $(this).one("touchmove", function(event){
        var xMove = event.originalEvent.touches[0].pageX;
        if( Math.floor(xClick - xMove) > 5 ){
            $(this).carousel('next');
        }
        else if( Math.floor(xClick - xMove) < -5 ){
            $(this).carousel('prev');
        }
    });
    $(".carousel").on("touchend", function(){
            $(this).off("touchmove");
    });
});

/* $('.carousel').carousel ({
    interval: isMobile.any() ? false : 5000
});
*/

//**************************************************************************************
// => listView - Tabs / jQuery Accordion        
//**************************************************************************************
$(function () {
$('a[aria-expanded="true"]').removeClass("refresh-btn");
});

$(function () {
    $("#tabs").tabs();
});

    // Accordéon de la liste
$(function () {
    $("#accordion-list").accordion({
        heightStyle: "content"
    });
    $("#accordion-list").accordion({
        collapsible: true,
        active: false, // placer après le collapsible true pour fermer tous les accordéons par défaut
    });
});

    // Accordéon du shop
$(function () {
    $("#accordion-items").accordion({
        heightStyle: "content"
    });
    $("#accordion-items").accordion({
        collapsible: true,
        active: false
    });
});

//**************************************************************************************
// => ADMIN shopView - Tabs / jQuery Accordion        
//**************************************************************************************

$(function () {
    $("#tabs-Admin").tabs();
});

    // Accordéon du magasin général
$(function () {
    $("#accordion-Admin").accordion({
        heightStyle: "content"
    });
    $("#accordion-Admin").accordion({
        collapsible: true
    });
});

//**************************************************************************************
// => ADMIN: shopView/Rayons / jQuery Sortable        
//**************************************************************************************

$(function () {
    $("#sortable-admin").sortable({
        opacity: 0.8, // réduit l'opacité lors du déplacement
        grid: [10, 10], // magnétise le déplacement sur une grille de 10*10
        placeholder: '.ui-state-highlight',
        forcePlaceholderSize: true, // force le redimensionnement du placeholder
        revert: true,
        stop: function (event, ui) {
            var aisleNewPos = ui.item.index() + 1; // récupère la position d'arrivée du seul rayon sorti
            // var aisleGeneId = ui.item.attr('id'); // récupèrerait son id
            var order = $(this).sortable('serialize'); // récupère sous forme de tableau tous les id des rayons classés dans le nouvel ordre. Attention pour serialize les id doivent avoir un préfixe textuel => id="aisleId_" + indice php // sinon faire un 'toArray'

            /* var ids = [];
            for (var i = 0, c = order.length; i < c; i++) { // idem récupère les id classés dans le nouvel ordre
                ids.push($('#sortable-admin li:eq(' + i + ')').attr('id'));
            }  */

            $.ajax({
                dataType: "html",
                type: 'POST',
                url: 'public/ajax.php?action=orderAisleGene',
                data: order,
                success: function () {
                    /*alert("La nouvelle position du rayon : " + aisleGeneId + " est " + aisleGeneOrder + " et le nouvel ordre est : " + order);*/
                    alert("Ce rayon a bien été déplacé en position n° " + aisleNewPos);
                },
                error: function () {
                    alert('failed');
                }
            });
        }
    });
    $("#sortable-admin").disableSelection();
    /* $('#sortable-admin').sortable({
        cancel: '#newAisleGene' // désactive la fonction sortable sur ce rayon mais désactive l'input sur les atres !
    }); */
});


if (window.location.href.indexOf("http://localhost:8888/caddyrace/CaddyRace_local/index.php?action=aislesList") > -1) {
    
    //**************************************************************************************
    // => aislesView : Focus sur article à modifier au click sur icone "pencil"         
    //**************************************************************************************

    var list = document.getElementById("liste");
    var items = document.querySelectorAll(".item-check");

    if (list) {
        var icons = list.querySelectorAll(".item-modif");
        for (var i = 0, c = icons.length; i < c; i++) {
            items[i].onclick = function () {
                var itemName = this.innerText;
                var input = document.createElement('input');
                input.value = itemName;
                input.type = "text";
                input.className = "right";
                this.appendChild(input);
                input.focus();
                input.onblur = function () {
                this.parentNode.innerText = this.value;
                }
            }
        }
    }

    //**************************************************************************************
    // => ailsesView - Rayons / jQuery Sortable (uniquement sur ordi)   
    //**************************************************************************************

    if (!(isMobile.any())) { // détecte si pas sur mobile */

    $(function () {
        $("#sortable").sortable({
            opacity: 0.8, // réduit l'opacité lors du déplacement
            grid: [10, 10], // magnétise le déplacement sur une grille de 10*10
            placeholder: '.ui-state-highlight',
            forcePlaceholderSize: true, // force le redimensionnement du placeholder
            revert: true,
            stop: function (event, ui) {
                var aisleNewPos = ui.item.index() + 1; // récupère la position d'arrivée du seul rayon sorti
                // var aisleGeneId = ui.item.attr('id'); // récupèrerait son id
                var order = $(this).sortable('serialize'); // récupère sous forme de tableau tous les id des rayons classés dans le nouvel ordre. Attention pour serialize les id doivent avoir un préfixe textuel => id="aisleId_" + indice php // sinon faire un 'toArray'

                /* var ids = [];
                for (var i = 0, c = order.length; i < c; i++) { // idem récupère les id classés dans le nouvel ordre
                    ids.push($('#sortable-admin li:eq(' + i + ')').attr('id'));
                }  */
                $.ajax({
                    dataType: "html",
                    type: 'POST',
                    url: 'public/ajax.php?action=orderAisle',
                    data: order,
                    success: function () {
                        /*alert("La nouvelle position du rayon : " + aisleGeneId + " est " + aisleGeneOrder + " et le nouvel ordre est : " + order);*/
                        alert("Ce rayon a bien été déplacé en position n° " + aisleNewPos);
                    },
                    error: function () {
                        alert('failed');
                    }
                });
            }
        });
        $("#sortable").disableSelection();
        /* $('#sortable-admin').sortable({
            cancel: '#newAisleGene' // désactive la fonction sortable sur ce rayon mais désactive l'input sur les atres !
        }); */
    });

    } else { // Message conseil sur smartphone pour basculer sur ordi   
        alert('Attention, la modification de l\'ordre de vos rayons par glisser-déposer n\'est disponible que sur ordinateur pour des raisons ergonomiques...');
        /*
        if (confirm('Attention, la modification de l\'ordre de vos rayons par glisser-déposer n\'est disponible que sur ordinateur pour des raisons ergonomiques...')) {  
            $("#new-order").on('click', function() {
            var order = Array.from($('input[name="newaisleposition"]'), e => "aislesId[]=" + e.id,).join('&');
         /* var order = Array.from($('input[name="newaisleposition"]'), e => e.id + "=" + e.value).join('&'); */
           /*    alert(order);
                    $.ajax({
                        dataType: "html",
                        type: 'POST',
                        url: 'public/ajax.php?action=newAislesOrder',
                        data: order,
                        success: function () {
                            alert("Votre nouveau circuit est bien mémorisé !");
                        },
                        error: function () {
                            alert('failed');
                        }
                    });

            });
        }*/
    }
}

//**************************************************************************************
// => listView/Articles jQuery - Mise en liste
//**************************************************************************************

$(function () {
    $(".add-list").on('click', function(){
        var itemId = $(this).val(); // l'id de l'article récupérée 
        var itemName = $(this).attr("data-value"); // le nom de l'article récupéré placé dans une data-value et qui correspond à l'id de l'input à changer
        var inlistInput = document.getElementById(itemName);
        if ($(this).hasClass('bg-white')) { // on change la couleur du bouton d'ajout en liste
            $(this).removeClass('bg-white');
            $(this).addClass('bg-orange');
            $(this.firstChild).removeClass('fa-th');
            $(this.firstChild).removeClass('blue');
            $(this.firstChild).addClass('fa-scroll');
            $(this.firstChild).addClass('white');
            inlistInput.classList.add('to-buy'); // on modifie l'aspect de l'input article mis en liste
        } else {
            $(this).removeClass('bg-orange');
            $(this).addClass('bg-white');  
            $(this.firstChild).addClass('fa-th');
            $(this.firstChild).addClass('blue');
            $(this.firstChild).removeClass('fa-scroll');
            $(this.firstChild).removeClass('white');
            inlistInput.classList.remove('to-buy'); // on modifie l'aspect de l'input article mis en liste
        }
        $.ajax({
            type: "POST",
            url: 'public/ajax.php?action=itemToBuy',
            data: {
                myFunction: 'changeItemCheckAjax', // fonction à appeler dans le signature.php passé en data
                myParams: itemId, // l'id de l'article récupérée 
            },
            success: function () {
                var messages = document.getElementById('messages');
                messages.setAttribute('itemId', 'coucou'); 
                alert("Cet article a bien été ajouté dans votre panier");
            },
            error: function () {
                alert('failed');
            }
        }); 
    }); 
});

//**************************************************************************************
// => Passage de mousse a touch sur mobile (complément touch-punch) 
//**************************************************************************************

/iPad|iPhone/.test(navigator.userAgent) && (function ($) {

    var proto = $.ui.mouse.prototype,
        _mouseInit = proto._mouseInit;

    $.extend(proto, {
        _mouseInit: function () {
            this.element
                .bind("touchstart." + this.widgetName, $.proxy(this, "_touchStart"));

            _mouseInit.apply(this, arguments);
        },

        _touchStart: function (event) {
            if (event.originalEvent.targetTouches.length != 1) {
                return false;
            }

            this.element
                .bind("touchmove." + this.widgetName, $.proxy(this, "_touchMove"))
                .bind("touchend." + this.widgetName, $.proxy(this, "_touchEnd"));

            this._modifyEvent(event);

            this._mouseDown(event);

            return false;
        },

        _touchMove: function (event) {
            this._modifyEvent(event);
            this._mouseMove(event);
        },

        _touchEnd: function (event) {
            this.element
                .unbind("touchmove." + this.widgetName)
                .unbind("touchend." + this.widgetName);
            this._mouseUp(event);
        },

        _modifyEvent: function (event) {
            event.which = 1;
            var target = event.originalEvent.targetTouches[0];
            event.pageX = target.clientX;
            event.pageY = target.clientY;
        }

    });

})(jQuery);

//**************************************************************************************
// => listView/Rayons jQuery - Selectmenu        
//**************************************************************************************

$(function () {
    $.widget("custom.iconselectmenu", $.ui.selectmenu, {
        _renderItem: function (ul, item) {
            var li = $("<li>"),
                wrapper = $("<div>", {
                    text: item.label
                });

            if (item.disabled) {
                li.addClass("ui-state-disabled");
            }

            $("<span>", {
                    style: item.element.attr("data-style"),
                    "class": "ui-icon " + item.element.attr("data-class")
                })
                .appendTo(wrapper);

            return li.append(wrapper).appendTo(ul);
        }
    });

    $("#rayon")
        .iconselectmenu()
        .iconselectmenu("menuWidget")
        .addClass("ui-menu-icons customicons");
});

//**************************************************************************************
// => nav dropdown automatique au hover         
//**************************************************************************************

$('ul.nav li.dropdown').hover(function () {
    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
}, function () {
    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
});

//**************************************************************************************
// => listView nav search autocomplete         
//**************************************************************************************

$(function(){  
    $("#itemDescription").on('input', function() { 
        $("#itemDescription").autocomplete({
            placeholder: 'Que vous manque-t-il ?',
            source: 'public/autocomplete.php?sessionId='+$("#sessionId").val()+'&req='+$("#itemDescription").val(),
            select: function( event, ui ) {
                var selectedItem = ui.item;
                if (selectedItem.value !== '') {
                    $(".tohide").removeClass("tohide");
                }
                $("#itemDescription").val(ui.item.item_priv_name);
                $("#itemId").val(ui.item.id);
            } 
        }); 
    }); 
}); 

//**************************************************************************************
//                                ACCUEIL & SHOPLIST
//**************************************************************************************

    //                            ACCUEIL & SHOPLIST
    //                  Spin loader de chargement de la page
    // ============================================================================= //

if (window.location.href.indexOf("http://localhost:8888/caddyrace/CaddyRace_local/index.php?action=home") > -1) {
    
 /*   if (!(isMobile.any())) { // supprimé sur tous mobiles car ne fonctionne pas sur iphone (voir autres mobiles ?) */
    
    jQuery(function($) {
        $('body').append('<div id="loadingDiv" class="d-flex justify-content-center align-items-center"><div class="loader">Loading...</div></div>');
        $(window).ready(function(){
        setTimeout(function() {
            $( "#loadingDiv" ).fadeOut(500, function() {
            // fadeOut complete. Remove the loading div
            $( "#loadingDiv" ).remove(); //makes page more lightweight 
        });  
        },2000)
    });
    });    

}
    //                            SOCIAL LINKS FOOTER
    //                  Spin loader de chargement des  social links
    // ============================================================================= //
    
    jQuery(function($) {
        $("#social-link_1").on('click', function(e){ // insertion du loader pour Facebook
            $('#social-link_1').html('<div id="loadingDiv-footer" class="d-flex justify-content-center align-items-center"><div class="loader-footer"><span><i class="fab fa-facebook-f fa-lg"></i></span></div></div>');
            $(window).ready(function(){
            setTimeout(function() {
                $( "#loadingDiv-footer" ).fadeOut(500, function() { // fadeOut complete. Remove the loading div
                    $( "#loadingDiv-footer" ).remove();  // suppression du loader
                    $('#social-link_1').html('<span><i class="fab fa-facebook-f fa-lg"></i></span>');  // insertion de l'icône sociale
                }); 
                document.getElementById('link_1').click();
            },2000)
        });
        });  
    });
    jQuery(function($) {
        $("#social-link_2").on('click', function(e){ // insertion du loader pour Twitter
            $('#social-link_2').html('<div id="loadingDiv-footer2" class="d-flex justify-content-center align-items-center"><div class="loader-footer">Loading...</div></div>');
            $(window).ready(function(){
            setTimeout(function() {
                $( "#loadingDiv-footer2" ).fadeOut(500, function() {
                    $( "#loadingDiv-footer2" ).remove(); 
                    $('#social-link_2').html('<span><i class="fab fa-twitter fa-lg"></i></span>');
                }); 
                document.getElementById('link_2').click();
            },2000)
        });
        });  
    });
    jQuery(function($) {
        $("#social-link_3").on('click', function(e){ // insertion du loader pour Instagram
            $('#social-link_3').html('<div id="loadingDiv-footer3" class="d-flex justify-content-center align-items-center"><div class="loader-footer">Loading...</div></div>');
            $(window).ready(function(){
            setTimeout(function() {
                $( "#loadingDiv-footer3" ).fadeOut(500, function() {
                    $( "#loadingDiv-footer3" ).remove();
                    $('#social-link_3').html('<span><i class="fab fa-instagram fa-lg"></i></span>');
                }); 
                document.getElementById('link_3').click();
            },2000)
        });
        });  
    });
    jQuery(function($) {
        $("#social-link_4").on('click', function(e){ // insertion du loader pour LinkedIn
            $('#social-link_4').html('<div id="loadingDiv-footer4" class="d-flex justify-content-center align-items-center"><div class="loader-footer">Loading...</div></div>');
            $(window).ready(function(){
            setTimeout(function() {
                $( "#loadingDiv-footer4" ).fadeOut(500, function() {
                    $( "#loadingDiv-footer4" ).remove();
                    $('#social-link_4').html('<span><i class="fab fa-linkedin-in fa-lg"></i></span>');
                }); 
                document.getElementById('link_4').click();
            },2000)
        });
        });  
    });
    jQuery(function($) {
        $("#social-link_5").on('click', function(e){ // insertion du loader pour GitHub
            $('#social-link_5').html('<div id="loadingDiv-footer5" class="d-flex justify-content-center align-items-center"><div class="loader-footer">Loading...</div></div>');
            $(window).ready(function(){
            setTimeout(function() {
                $( "#loadingDiv-footer5" ).fadeOut(500, function() {
                    $( "#loadingDiv-footer5" ).remove();
                    $('#social-link_5').html('<span><i class="fab fa-github fa-lg"></i></span>');
                }); 
                document.getElementById('link_5').click();
            },2000)
        });
        });  
    });
    


    //                                ACCUEIL
    //                  FullPage Scrolling section/section
    // ============================================================================= //
/*
if (window.location.href.indexOf("http://localhost:8888/caddyrace/CaddyRace_local/index.php?action=home") > -1) {

    jQuery(function($) {
        if (($(window).width() < 900) && (window.matchMedia("(orientation: portrait)").matches)) {
            new fullpage('#fullpage', {
                autoScrolling:true,
                scrollHorizontally: true
            });
            $("#footer-std").css("display", "none");
        }
    });

} */

//**************************************************************************************
// => Mises en formes des input formulaires  
//**************************************************************************************

if (window.location.href.indexOf("http://localhost:8888/caddyrace/CaddyRace_local/index.php?action=login") > -1) {
    /*
    remplacer tous les liens par les liens en ligne =>
    "http://localhost:8888/caddyrace/CaddyRace_local/index.php?action=..."
    */
    if (document.getElementById("pseudo_login")) {
        var pseudoLogin = document.getElementById('pseudo_login');
        pseudoLogin.addEventListener("focus", function () {
            if (pseudoLogin.value == "") {
                pseudoLogin.className = "input_focus";
            } else {
                pseudoLogin.className = "input_value";
            }
        }, false);
        pseudoLogin.addEventListener("blur", function () {
            if (pseudoLogin.value == "") {
                pseudoLogin.className = "input_novalue";
            } else {
                pseudoLogin.className = "input_value";
            }
        }, false);
    }
    
    if (document.getElementById("password_login")) {
        var passwordLogin = document.getElementById('password_login');
        passwordLogin.addEventListener("focus", function () {
            passwordLogin.className = "input_focus"; // on change l'apparence du champ
        }, false);
        passwordLogin.addEventListener("blur", function () {
            if (passwordLogin.value == "") {
                passwordLogin.className = "input_novalue";
            } else {
                passwordLogin.className = "input_value";
            }
        }, false);
    }
    
    if (document.getElementById("name_create")) {
        var nameCreate = document.getElementById('name_create');
        nameCreate.addEventListener("focus", function () {
            nameCreate.className = "input_focus"; // on change l'apparence du champ
        }, false);
        nameCreate.addEventListener("blur", function () {
            if (nameCreate.value == "") {
                nameCreate.className = "input_novalue";
            } else {
                nameCreate.className = "input_value";
            }
        }, false);
    }
    
    if (document.getElementById("first_name_create")) {
        var firstNameCreate = document.getElementById('first_name_create');
        firstNameCreate.addEventListener("focus", function () {
            firstNameCreate.className = "input_focus"; // on change l'apparence du champ
        }, false);
        firstNameCreate.addEventListener("blur", function () {
            if (firstNameCreate.value == "") {
                firstNameCreate.className = "input_novalue";
            } else {
                firstNameCreate.className = "input_value";
            }
        }, false);
    }
    
    if (document.getElementById("pseudo_create")) {
        var pseudoCreate = document.getElementById('pseudo_create');
        pseudoCreate.addEventListener("focus", function () {
            pseudoCreate.className = "input_focus"; // on change l'apparence du champ
        }, false);
        pseudoCreate.addEventListener("blur", function () {
            if (pseudoCreate.value == "") {
                pseudoCreate.className = "input_novalue";
            } else {
                pseudoCreate.className = "input_value";
            }
        }, false);
    }

    if (document.getElementById("email_create")) {
        var emailCreate = document.getElementById('email_create');
        emailCreate.addEventListener("focus", function () {
            emailCreate.className = "input_focus"; // on change l'apparence du champ
        }, false);
        emailCreate.addEventListener("blur", function () {
            if (emailCreate.value == "") {
                emailCreate.className = "input_novalue";
            } else {
                emailCreate.className = "input_value";
            }
        }, false);
    }
    
    if (document.getElementById("email_create_confirm")) {
        var email2Create = document.getElementById('email_create_confirm');
        email2Create.addEventListener("focus", function () {
            email2Create.className = "input_focus"; // on change l'apparence du champ
        }, false);
        email2Create.addEventListener("blur", function () {
            if (email2Create.value == "") {
                email2Create.className = "input_novalue";
            } else {
                email2Create.className = "input_value";
            }
        }, false);
    }
    
    if (document.getElementById("password_create")) {
        var passwordCreate = document.getElementById('password_create');
        passwordCreate.addEventListener("focus", function () {
            passwordCreate.className = "input_focus"; // on change l'apparence du champ
        }, false);
        passwordCreate.addEventListener("blur", function () {
            if (passwordCreate.value == "") {
                passwordCreate.className = "input_novalue";
            } else {
                passwordCreate.className = "input_value";
            }
        }, false);
    }
    
    if (document.getElementById("password_create_confirm")) {
        var password2Create = document.getElementById('password_create_confirm');
        password2Create.addEventListener("focus", function () {
            password2Create.className = "input_focus"; // on change l'apparence du champ
        }, false);
        password2Create.addEventListener("blur", function () {
            if (password2Create.value == "") {
                password2Create.className = "input_novalue";
            } else {
                password2Create.className = "input_value";
            }
        }, false);
    }
    
    if (document.getElementById("recherche")) {
        var searchBar = document.getElementById('recherche');
        searchBar.addEventListener("focus", function () {
            searchBar.className = "input_focus"; // on change l'apparence du champ
        }, false);
        searchBar.addEventListener("blur", function () {
            if (searchBar.value == "") {
                searchBar.className = "input_novalue";
            } else {
                searchBar.className = "input_value";
            }
        }, false);
    }
    
    if (document.getElementById("champ")) {
        var champ = document.getElementById('champ');
        champ.addEventListener("focus", function () {
            champ.className = "input_focus"; // on change l'apparence du champ
        }, false);
        champ.addEventListener("blur", function () {
            if (champ.value == "") {
                champ.className = "input_novalue";
            } else {
                champ.className = "input_value";
            }
        }, false);
    }
    
    if (document.getElementById("modif_champ")) {
        var missChamp = document.getElementById('modif_champ');
        missChamp.addEventListener("focus", function () {
            missChamp.className = "input_focus"; // on change l'apparence du champ
        }, false);
        missChamp.addEventListener("blur", function () {
            if (missChamp.value == "") {
                missChamp.className = "input_novalue";
            } else {
                missChamp.className = "input_value";
            }
        }, false);
    }
    
    if (document.getElementById("modif_champ_confirm")) {
        var missChampConfirm = document.getElementById('modif_champ_confirm');
        missChamp.addEventListener("focus", function () {
            missChamp.className = "input_focus"; // on change l'apparence du champ
        }, false);
        missChamp.addEventListener("blur", function () {
            if (missChamp.value == "") {
                missChamp.className = "input_novalue";
            } else {
                missChamp.className = "input_value";
            }
        }, false);
    }

}

//**************************************************************************************
// => profilView - Interactions pour les input formulaires        
//**************************************************************************************

if ((window.location.href.indexOf("http://localhost:8888/caddyrace/CaddyRace_local/index.php?action=memberDetail") > -1) || (window.location.href.indexOf("http://localhost:8888/caddyrace/CaddyRace_local/index.php?action=memberModif") > -1) || (window.location.href.indexOf("http://localhost:8888/caddyrace/CaddyRace_local/index.php?action=memberDelete") > -1)) {
    /*
    remplacer tous les liens par les liens en ligne =>
    "http://localhost:8888/caddyrace/CaddyRace_local/index.php?action=..."
    */
    var form = document.getElementById('form_modif');
    var errorChamp = document.getElementById('error1');
    var errorChampConfirm = document.getElementById('error2');

    if (missChamp.validity.valueMissing) {
        if (champ.value == "1") {
            missChamp.setCustomValidity("Veuillez entrer votre nouvelle adresse mail.");
        } else {
            missChamp.setCustomValidity("Veuillez entrer votre nouveau mot de passe.");
        }
    } else {
        missChamp.setCustomValidity("");
        if (missChampConfirm.validity.valueMissing) {
            if (champ.value == "1") {
                missChampConfirm.setCustomValidity("Veuillez confirmer cette nouvelle adresse mail.");
            } else {
                missChampConfirm.setCustomValidity("Veuillez confirmer ce nouveau mot de passe.");
            }
        } else {
            missChampConfirm.setCustomValidity("");
        }
    }

    missChamp.addEventListener("input", function () {
        // Chaque fois que l'utilisateur saisit quelque chose dans le 1er champ
        // S'il y a un message d'erreur affiché et que le champ est valide, on retire l'erreur
        missChamp.addClassclassName = "input_value"; // on change l'apparence du champ
        errorChamp.innerHTML = ""; // On réinitialise le contenu
        errorChamp.className = "error"; // On réinitialise l'état visuel du message
        errorChampConfirm.innerHTML = ""; // On réinitialise le contenu
        errorChampConfirm.className = "error"; // On réinitialise l'état visuel du message
        missChampConfirm.setAttribute("required", ""); // on rend le 2nd champ obligatoire
        if (!missChamp.value) { // si le champ est vide.
            missChampConfirm.removeAttribute("required"); // on désactive le 2nd champ obligatoire
        }
    }, false);

    missChampConfirm.addEventListener("input", function () {
        // Chaque fois que l'utilisateur saisit quelque chose dans le 2nd champ
        missChampConfirm.className = "input_value"; // on change l'apparence du champ
        errorChampConfirm.innerHTML = ""; // On réinitialise le contenu
        errorChampConfirm.className = "error"; // On réinitialise l'état visuel du message
    }, false);

    form.addEventListener("submit", function () {
        if (errorChamp.innerHTML !== "") {
            errorChamp.className = "error active";
        }
        if (errorChampConfirm.innerHTML !== "") {
            errorChampConfirm.className = "error active";
        }
    }, false);

}

//**************************************************************************************
// => exitView - Interactions pour la déconnexion     
//**************************************************************************************
/*
function deconnect_confirm() {
    if (confirm("Voulez-vous vraiment vous déconnecter ?")) {
        document.location.href = "http://localhost:8888/caddyrace/CaddyRace_local/index.php?action=deconnexion";
        return true;
    } else {
        alert("Je me disais aussi...");
        return false;
    }
}

if (document.getElementById("deconnexion")) {
    document.getElementById("deconnexion").addEventListener('click', function (e) {
        e.preventDefault();
        deconnect_confirm();
    });
} else if (document.getElementById("deconnexion-xs")) {
    document.getElementById("deconnexion-xs").addEventListener('click', function (e) {
        e.preventDefault();
        deconnect_confirm();
    });
}
*/