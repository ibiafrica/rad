$(document).ready(function(){

   // $('div').css('background-color','red');

   $('body').on('click','.am-find-article',function(){

    

   });

   /* SEARCH ALL COLUMNS */

   $('.am-search-article').keyup(
       function()
       {
           var search_article=$(this).val();

  // Hide all table tbody rows
    $('table tbody tr').hide();

    var len = $('table tbody tr:not(.notfound) td:contains("'+search_article+'")').length;

    if(len > 0){
        // Searching text in columns and show match row
        $('table tbody tr:not(.notfound) td:contains("'+search_article+'")').each(function(){
          $(this).closest('tr').show();
        });
      }else{
        $('.notfound').show();
      }

       }
   );


   /** POPUP */

   function deselect(e) {
    $('.pop').slideFadeToggle(function()
    {
    e.removeClass('selected');
    }); 
   }


   


   $('.am-stck-items').click(
     function()
     {
   $('#afficherPopup').css({'display':'block'});
     }
   );


   


});