jQuery(document).ready(function($){
    
    /** Home Reent Blog Category Exclude **/
   $('.exclude-cat-wrap input:checkbox').on('change', function (e) {
    
       e.preventDefault();
       var chkbox = $(this).parents('.exclude-cat-wrap').find('input:checkbox');
       var id = '';
       $.each( chkbox, function () {
        
           var oid = $(this).val();
           if($(this).attr('checked')) {
               id += oid;
               id += ','; 
           }
       });
       $(this).parents('.exclude-cat-wrap').next('input:hidden').val(id).change();
       
   });
   
});

( function( api ) {
    // Extends our custom "example-1" section.
    api.sectionConstructor['bloggerbuz-pro'] = api.Section.extend( {
        // No events for this type of section.
        attachEvents: function () {},
        // Always make the section active.
        isContextuallyActive: function () {
            return true;
        }
    } );
} )( wp.customize );