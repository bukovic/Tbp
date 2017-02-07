


function tablicaOstale() {
    
    
    $('#tablicaOstale').dataTable({
        "bPaginate": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": false,
        "bAutoWidth": true
    });

  
}


$(document).ready(function () {

  

   
    if (document.title === "Moji projekti" || document.title === "Moje verzije"  ) {
        tablicaOstale();
    }


});



