/*
function bgOpacitymax(){

    var btnAdmin=document.getElementById('btnAdmin');
    btnAdmin.style.opacity='1';
    btnAdmin.style.cursor='pointer';
}

function bgOpacitymin(){

    var btnAdmin=document.getElementById('btnAdmin');
    btnAdmin.style.opacity='0.7';
    btnAdmin.style.cursor='pointer';
}

function showAdminAcces(){

   var accesAdmin=document.getElementById('accesAdmin');
   if (accesAdmin.style.visibility==='hidden') {
       accesAdmin.style.visibility='visible';
       accesAdmin.style.display='block';
   }else{
       accesAdmin.style.visibility='hidden';
       accesAdmin.style.display='none';
   }

}
*/

/*  Jquery pour les fade in et fade out    */
function showAlert() {
    $(".alert").addClass("in");
}
function hideAlert() {
    $(".alert").addClass("out");
}

window.setTimeout(function () {
    showAlert();
}, 100);

window.setTimeout(function () {
    hideAlert();
}, 3000);

/*************************************************
 *
 *           FONCTION DE CONFIRMATION DE SUPPRESSION
 *
 ***************************************************/


