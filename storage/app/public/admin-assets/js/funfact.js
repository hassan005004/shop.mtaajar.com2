
function show_funfact_icon(x){

    "use strict";

    $(x).next().html($(x).val())

}

var id = 1;

function add_funfact(icon, title, description) {

    "use strict";

    var html = '<div class="col-12 remove' + id + '"><div class="row"><div class="col-md-4 form-group"><div class="input-group"><input type="text" class="form-control feature_icon" onkeyup="show_funfact_icon(this)" name="funfact_icon[]" placeholder="' + icon + '" required><p class="input-group-text"></p></div></div><div class="col-md-4 form-group"><input type="text" class="form-control" name="funfact_title[]" placeholder="' + title + '" required></div><div class="col-md-4 d-flex gap-2 form-group"><input type="text" class="form-control" name="funfact_subtitle[]" placeholder="' + description + '" required><button class="btn btn-danger" type="button" onclick="remove_funfcat(' + id + ')"><i class="fa fa-trash"></i></button></div></div></div>';

    $('.extra_footer_features').append(html);

    $(".feature_required").prop('required',true);

    id++;

}

function remove_funfcat(id) {

    "use strict";

    $('.remove' + id).remove();

    if ($('.extra_footer_features .row').length == 0) {

        $(".feature_required").prop('required',false);

    }

}

$('#start_date').on('change',function() {
    "use strict";
    if($('#start_date').val() <  new Date().toISOString().slice(0, 10))
    {
        $('#start_date').val('');
        toastr.error('select correct date !!');
    }
    if (new Date($('#start_date').val()) > new Date($('#end_date').val())) {
        $('#start_date').val('');
        toastr.error('start date must be less then end date !!');
    }
    if ($('#start_date').val() ==  $('#end_date').val()) {
        if($('#start_time').val() > $('#end_time').val())
        {
            toastr.error('start time must be less then end time !!');
            $('#start_time').val('');
        }
    }
});
$('#end_date').on('change',function() {
    "use strict";
    if (new Date($('#start_date').val()) > new Date($('#end_date').val())) {
        $('#end_date').val('');
        toastr.error('start date must be less then end date !!');
    }
    if ($('#start_date').val() ==  $('#end_date').val()) {
        if($('#start_time').val() > $('#end_time').val())
        {
            toastr.error('start time must be less then end time !!');
            $('#start_time').val('');
        }
    }
});

$('#start_time').on('change',function() {
    "use strict";
    if ($('#start_date').val() ==  $('#end_date').val()) {
        if($('#start_time').val() > $('#end_time').val())
        {
            toastr.error('start time must be less then end time !!');
            $('#start_time').val('');
        }
    }
   
});
$('#end_time').on('change',function() {
    "use strict";
    if ($('#start_date').val() ==  $('#end_date').val()) {
        if($('#start_time').val() > $('#end_time').val())
        {
            toastr.error('start time must be less then end time !!');
            $('#end_time').val('');
        }
       
    }
});