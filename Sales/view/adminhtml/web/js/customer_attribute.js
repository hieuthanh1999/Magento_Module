// require([
//     "jquery"
// ], function($) {
//     $(document).ready(function() {
//         // alert('he');
//         $(".admin__table-secondary").click(function(){
//             alert('hi');
//           });
       
//         $('.admin__table-secondary').hide();
//         // $('[name="customer[organization_name]"]').val('');
//         // $().change(function() {

//         //     //alert($('name="customer[company_type]"').val());


//         //     if ($('[name="customer[company_type]"]').val() == 3) {
//         //         $('[name="customer[organization_name]"]').show();
//         //     } else {
//         //         $('[name="customer[organization_name]"]').hide();
//         //         $('[name="customer[organization_name]"]').val('');
//         //     }
//         // });
//     });
// });
require([
    'jquery'
], function ($) {
    var waitForEl = function(selector, callback) {
        if ($(selector).val() || $(selector).val() == '') {
          callback();
        } else {
          setTimeout(function() {
            waitForEl(selector, callback);
          }, 100);
        }
      };
    var selector = '[name="customer[company_type]"]';
    waitForEl(selector, function() {
        console.log('run');
        $('[data-index="organization_name"]').hide();
        $('[name="customer[company_type]"]').change(function() {
            var data = $(this).val();
            if(data == 3){
                $('[data-index="organization_name"]').fadeIn();
            } else {
                $('[data-index="organization_name"]').fadeOut();
                $('[name="customer[organization_name]"]').val('');
          }
        })
        
    });
})