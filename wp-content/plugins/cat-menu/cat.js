
console.log('cat körs')


jQuery(document).ready(function(){
    /* jQuery(".cat_item").on('click',  ()=> loop()) */
    
    jQuery( ".cat_item" ).each(function( index ) {
        console.log( index + ": " + jQuery( this ).text() );
      });
   
    
});

function loop() {
    
  }
