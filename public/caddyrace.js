 //**************************************************************************************
 // => listView/Tris jQuery - Accordion         
 //**************************************************************************************

 $(function () {
     $("#accordion").accordion();
 });

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
    "Draggable",
    "Droppable",
    "Resizable",
    "Selectable",
    "Sortable"
];

 $('#recherche').autocomplete({
     source: liste
 });


 /* TODO: LE JS SUIVANT SUR LOGINVIEW MARCHE MAIS BLOQUE LA SUITE...? A VOIR...

 //**************************************************************************************
 // => loginView Log In - Interactions pour les input formulaires  
 //**************************************************************************************

 var pseudoLogin = document.getElementById('pseudo_login');
 var passwordLogin = document.getElementById('password_login');

 pseudoLogin.addEventListener("input", function (event) {
     pseudoLogin.className = "input_value"; // on change l'apparence du champ
 }, false);
 passwordLogin.addEventListener("input", function (event) {
     passwordLogin.className = "input_value"; // on change l'apparence du champ
 }, false);

 // TODO: LE JS SUIVANT SUR LOGINVIEW NE MARCHE PAS ET BLOQUE LA SUITE !? A VOIR AUSSI...

 //**************************************************************************************
 // => loginView Create Account - Interactions pour les input formulaires  
 //**************************************************************************************

 var name = document.getElementById('name_create');
 var firstName = document.getElementById('first_name_create');
 var pseudo = document.getElementById('pseudo_create');
 var email = document.getElementById('email_create');
 var emailConfirm = document.getElementById('email_create_confirm');
 var password = document.getElementById('password_create');
 var passwordConfirm = document.getElementById('password_create_confirm');

 name.setCustomValidity("");
 firstName.setCustomValidity("");
 pseudo.setCustomValidity("");
 email.setCustomValidity("");
 emailConfirm.setCustomValidity("");
 password.setCustomValidity("");
 passwordConfirm.setCustomValidity("");

 name.addEventListener("input", function (event) {
     name.className = "input_value"; // on change l'apparence du champ
 }, false);
 firstName.addEventListener("input", function (event) {
     firstName.className = "input_value"; // on change l'apparence du champ
 }, false);
 pseudo.addEventListener("input", function (event) {
     pseudo.className = "input_value"; // on change l'apparence du champ
 }, false);
 email.addEventListener("input", function (event) {
     email.className = "input_value"; // on change l'apparence du champ
     emailConfirm.setAttribute("required", ""); // on rend le 2nd champ obligatoire
     if (!email.value) { // si le champ est vide.
         emailConfirm.removeAttribute("required"); // on désactive le 2nd champ obligatoire
     }
 }, false);
 emailConfirm.addEventListener("input", function (event) {
     emailConfirm.className = "input_value"; // on change l'apparence du champ
 }, false);
 password.addEventListener("input", function (event) {
     password.className = "input_value"; // on change l'apparence du champ
     passwordConfirm.setAttribute("required", ""); // on rend le 2nd champ obligatoire
     if (!password.value) { // si le champ est vide.
         passwordConfirm.removeAttribute("required"); // on désactive le 2nd champ obligatoire
     }
 }, false);
 passwordConfirm.addEventListener("input", function (event) {
     passwordConfirm.className = "input_value"; // on change l'apparence du champ
 }, false);

 // FIN DES TODO */

 //**************************************************************************************
 // => profilView - Interactions pour les input formulaires        
 //**************************************************************************************

 var form = document.getElementById('form_modif');
 var champ = document.getElementById('champ');
 var missChamp = document.getElementById('modif_champ');
 var missChampConfirm = document.getElementById('modif_champ_confirm');
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

 champ.addEventListener("input", function (event) {
     champ.className = "input_value"; // on change l'apparence du champ
 }, false);

 missChamp.addEventListener("input", function (event) {
     // Chaque fois que l'utilisateur saisit quelque chose dans le 1er champ
     // S'il y a un message d'erreur affiché et que le champ est valide, on retire l'erreur
     missChamp.className = "input_value"; // on change l'apparence du champ
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
