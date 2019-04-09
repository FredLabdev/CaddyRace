//**************************************************************************************
// => listView - Créer un nouvel article -> Afficher l'affectation à un rayon        
//**************************************************************************************

$(function () {
    $('#addItem').click(function () {
        $('#raySelect').toggle() // AFFICHE ET CACHE A CHAQUE CLIQUE SUR LE BOUTTON
    });
});

//**************************************************************************************
// => listView/Tris jQuery - Tabs - Accordion        
//**************************************************************************************

$(function () {
    $("#tabs").tabs();
});

$(function () {
    $("#accordion").accordion({
        heightStyle: "content"
    });
    $("#accordion").accordion({
        collapsible: true
    });
});


//**************************************************************************************
// => shopView/Tris jQuery - Tabs - Accordion        
//**************************************************************************************

$(function () {
    $("#tabs-Admin").tabs();
});

$(function () {
    $("#accordion-Admin").accordion({
        heightStyle: "content"
    });
    $("#accordion-Admin").accordion({
        collapsible: true
    });
});

//**************************************************************************************
// => listView/Rayons jQuery - Sortable        
//**************************************************************************************

$(function () {
    $("#sortable").sortable({
        placeholder: "ui-state-highlight"
    });
    $("#sortable").disableSelection();
});

// => Passage de mousse a touch sur mobile (complément touch-punch)

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

var liste = [
    "Abricot Perso",
    "Ananas Perso",
    "Banane Perso",
    "Cacahuètes Perso",
];

$('#recherche').autocomplete({
    source: liste
});

$(".tohide").hide();
$(".tohide2").show();
$('#recherche').autocomplete({
    source: liste,
    select: function (event, ui) {
        var selectedItem = ui.item;
        if (selectedItem.value !== '') {
            $(".tohide").show();
            $(".tohide2").hide();
        }
    }
});

//**************************************************************************************
// => shopView - Ajouter un article dans un rayon      
//**************************************************************************************

$(function () {
    var $list, $newItemGeneForm;
    $list = $('#aisle1');
    $newItemGeneForm = $('#newItemGeneForm');
    $newItemGeneForm.on("submit", function (e) {
        e.preventDefault();
        $itemGeneField = $('#itemGeneField');
        var text = $itemGeneField.val();
        $list.append('<li class="dropdown-item d-flex flex-row justify-content-center align-items-center"><span class="item-delete d-flex p-2"><i class="fas fa-trash"></i></span><input type="text" class="item-gene col-9"  value="' + text + '"/></li>');
        $itemGeneField.val('');
    });
    $list.on('click', 'span', function () {
        var $trash = $(this);
        $trash.parent().remove();
    })
});

//**************************************************************************************
// => listView : Focus sur article à modifier au click sur icone "pencil"         
//**************************************************************************************

var list = document.getElementById("liste");
var items = list.querySelectorAll(".item-check");

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
// => exitView - Interactions pour la déconnexion         
//**************************************************************************************

function deconnect_confirm() {
    if (confirm("Voulez-vous vraiment vous déconnecter ?")) {
        document.location.href = "index.php?action=deconnexion";
        return true;
    } else {
        alert("Je me disais aussi...");
        return false;
    }
}

document.getElementById("deconnexion").addEventListener('click', function (e) {
    e.preventDefault();
    deconnect_confirm();
});

document.getElementById("deconnexion_xs").addEventListener('click', function (e) {
    e.preventDefault();
    deconnect_confirm();
});

//**************************************************************************************
// => Mises en formes des input formulaires  
//**************************************************************************************

var pseudoLogin = document.getElementById('pseudo_login');
pseudoLogin.addEventListener("focus", function (event) {
    if (pseudoLogin.value == "") {
        pseudoLogin.className = "input_focus";
    } else {
        pseudoLogin.className = "input_value";
    }
}, false);
pseudoLogin.addEventListener("blur", function (event) {
    if (pseudoLogin.value == "") {
        pseudoLogin.className = "input_novalue";
    } else {
        pseudoLogin.className = "input_value";
    }
}, false);

var passwordLogin = document.getElementById('password_login');
passwordLogin.addEventListener("focus", function (event) {
    passwordLogin.className = "input_focus"; // on change l'apparence du champ
}, false);
passwordLogin.addEventListener("blur", function (event) {
    if (passwordLogin.value == "") {
        passwordLogin.className = "input_novalue";
    } else {
        passwordLogin.className = "input_value";
    }
}, false);

var nameCreate = document.getElementById('name_create');
nameCreate.addEventListener("focus", function (event) {
    nameCreate.className = "input_focus"; // on change l'apparence du champ
}, false);
nameCreate.addEventListener("blur", function (event) {
    if (nameCreate.value == "") {
        nameCreate.className = "input_novalue";
    } else {
        nameCreate.className = "input_value";
    }
}, false);

var firstNameCreate = document.getElementById('first_name_create');
firstNameCreate.addEventListener("focus", function (event) {
    firstNameCreate.className = "input_focus"; // on change l'apparence du champ
}, false);
firstNameCreate.addEventListener("blur", function (event) {
    if (firstNameCreate.value == "") {
        firstNameCreate.className = "input_novalue";
    } else {
        firstNameCreate.className = "input_value";
    }
}, false);

var pseudoCreate = document.getElementById('pseudo_create');
pseudoCreate.addEventListener("focus", function (event) {
    pseudoCreate.className = "input_focus"; // on change l'apparence du champ
}, false);
pseudoCreate.addEventListener("blur", function (event) {
    if (pseudoCreate.value == "") {
        pseudoCreate.className = "input_novalue";
    } else {
        pseudoCreate.className = "input_value";
    }
}, false);

var emailCreate = document.getElementById('email_create');
emailCreate.addEventListener("focus", function (event) {
    emailCreate.className = "input_focus"; // on change l'apparence du champ
}, false);
emailCreate.addEventListener("blur", function (event) {
    if (emailCreate.value == "") {
        emailCreate.className = "input_novalue";
    } else {
        emailCreate.className = "input_value";
    }
}, false);

var email2Create = document.getElementById('email_create_confirm');
email2Create.addEventListener("focus", function (event) {
    email2Create.className = "input_focus"; // on change l'apparence du champ
}, false);
email2Create.addEventListener("blur", function (event) {
    if (email2Create.value == "") {
        email2Create.className = "input_novalue";
    } else {
        email2Create.className = "input_value";
    }
}, false);

var passwordCreate = document.getElementById('password_create');
passwordCreate.addEventListener("focus", function (event) {
    passwordCreate.className = "input_focus"; // on change l'apparence du champ
}, false);
passwordCreate.addEventListener("blur", function (event) {
    if (passwordCreate.value == "") {
        passwordCreate.className = "input_novalue";
    } else {
        passwordCreate.className = "input_value";
    }
}, false);

var password2Create = document.getElementById('password_create_confirm');
password2Create.addEventListener("focus", function (event) {
    password2Create.className = "input_focus"; // on change l'apparence du champ
}, false);
password2Create.addEventListener("blur", function (event) {
    if (password2Create.value == "") {
        password2Create.className = "input_novalue";
    } else {
        password2Create.className = "input_value";
    }
}, false);

var searchBar = document.getElementById('recherche');
searchBar.addEventListener("focus", function (event) {
    searchBar.className = "input_focus"; // on change l'apparence du champ
}, false);
searchBar.addEventListener("blur", function (event) {
    if (searchBar.value == "") {
        searchBar.className = "input_novalue";
    } else {
        searchBar.className = "input_value";
    }
}, false);

var champ = document.getElementById('champ');
champ.addEventListener("focus", function (event) {
    champ.className = "input_focus"; // on change l'apparence du champ
}, false);
champ.addEventListener("blur", function (event) {
    if (champ.value == "") {
        champ.className = "input_novalue";
    } else {
        champ.className = "input_value";
    }
}, false);

var missChamp = document.getElementById('modif_champ');
missChamp.addEventListener("focus", function (event) {
    missChamp.className = "input_focus"; // on change l'apparence du champ
}, false);
missChamp.addEventListener("blur", function (event) {
    if (missChamp.value == "") {
        missChamp.className = "input_novalue";
    } else {
        missChamp.className = "input_value";
    }
}, false);

var missChampConfirm = document.getElementById('modif_champ_confirm');
missChamp.addEventListener("focus", function (event) {
    missChamp.className = "input_focus"; // on change l'apparence du champ
}, false);
missChamp.addEventListener("blur", function (event) {
    if (missChamp.value == "") {
        missChamp.className = "input_novalue";
    } else {
        missChamp.className = "input_value";
    }
}, false);


//**************************************************************************************
// => profilView - Interactions pour les input formulaires        
//**************************************************************************************

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

missChamp.addEventListener("input", function (event) {
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

missChampConfirm.addEventListener("input", function (event) {
    // Chaque fois que l'utilisateur saisit quelque chose dans le 2nd champ
    missChampConfirm.className = "input_value"; // on change l'apparence du champ
    errorChampConfirm.innerHTML = ""; // On réinitialise le contenu
    errorChampConfirm.className = "error"; // On réinitialise l'état visuel du message
}, false);

form.addEventListener("submit", function (event) {
    if (errorChamp.innerHTML !== "") {
        errorChamp.className = "error active";
    }
    if (errorChampConfirm.innerHTML !== "") {
        errorChampConfirm.className = "error active";
    }
}, false);
