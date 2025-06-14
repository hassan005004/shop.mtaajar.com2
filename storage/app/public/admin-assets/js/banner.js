$('.type').on('change', function() {

    "use strict";

    var optionValue = $(this).find("option:selected").attr("value");

    if (optionValue) {

        $(".gravity").not("." + optionValue).hide();

        $(".gravity").not("." + optionValue).find('select').prop('required', false);

        $("." + optionValue).show();
        if(optionValue == 3)
        { 
            $("." + optionValue).find('input').prop('required', true);
        }else{
            $("." + optionValue).find('select').prop('required', true);
        }
       

    } else {

        $(".gravity").hide();
        if(optionValue == 3)
        { 
            $("." + optionValue).find('input').prop('required', false);
        }else{
            $("." + optionValue).find('select').prop('required', false);
        }
        

    }

}).change();