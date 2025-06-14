$(window).on("load", function () {

    "use strict";

    $('#preloader').fadeOut('slow')

    if ($(".multimenu").find(".active")) {

        $(".multimenu").find(".active").parent().parent().addClass("show");

        $(".multimenu").find(".active").parent().parent().parent().attr("aria-expanded", true);

    }

});

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))

var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {

    "use strict";

    return new bootstrap.Tooltip(tooltipTriggerEl)

})

$(document).ready(function () {

    "use strict";

    $('.zero-configuration').DataTable({
        dom: 'lBfrtip',
        lengthMenu: [[10, 25, 50, 100, 500, -1], [10, 25, 50, 100, 500, "All"]],
        buttons: [
            { extend: 'pdfHtml5' },
            { extend: 'excelHtml5' },
        ],
    });

    $('form').on('submit', function () {

        "use strict";

        if (env == 'sandbox') {

            myFunction();

            return false;

        }

    });



});
// <!-- functions -->

$(function () {
    $("#tabledetails").sortable({
        items: "tr",
        cursor: 'move',
        opacity: 0.6,
        update: function () {
            sendOrderToServer();
        }
    });

    function sendOrderToServer() {
        var order = [];
        $('tr.row1').each(function (index, element) {
            order.push({
                id: $(this).attr('data-id'),
                position: index + 1
            });
        });

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            dataType: "json",
            url: $('#tabledetails').attr('data-url'),
            data: {
                order: order,
            },
            success: function (response) {
                if (response.status == 1) {
                    // new bootstrap.Toast(document.querySelector('#liveToast')).show(response.msg);
                    toastr.success(response.msg);
                } else {
                    console.log(response);
                }
            }
        });
    }
});


function myFunction() {

    "use strict";

    toastr.error("This operation was not performed due to demo mode");

    return false;

}

function statusupdate(nexturl) {

    "use strict";

    manegedata(nexturl);

}

function deletedata(nexturl) {

    "use strict";
    manegedata(nexturl);

}

function manegedata(nexturl) {

    "use strict";




    const swalWithBootstrapButtons = Swal.mixin({

        customClass: {

            confirmButton: 'btn btn-success mx-1',

            cancelButton: 'btn btn-danger mx-1'

        },

        buttonsStyling: false

    })

    swalWithBootstrapButtons.fire({

        title: are_you_sure,

        icon: 'warning',

        showCancelButton: true,

        confirmButtonText: yes,

        cancelButtonText: no,

        reverseButtons: true

    }).then((result) => {

        if (result.isConfirmed) {

            $('#preloader').show();

            location.href = nexturl;

        } else {

            result.dismiss === Swal.DismissReason.cancel

        }

    })

}

$('.numbers_only').on('keyup', function () {

    "use strict";

    var val = $(this).val();

    if (isNaN(val)) {

        val = val.replace(/[^0-9\.]/g, '');

        if (val.split('.').length > 2) {

            val = val.replace(/\.+$/, "");

        }

    }

    $(this).val(val);

});
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31
        && (charCode < 48 || charCode > 57))
        return false;

    return true;
}
$('.mobile-number').on('keyup', function () {
    "use strict";
    var val = $(this).val();
    if (isNaN(val)) {
        val = val.replace(/[^0-9\.+.-]/g, '');
        if (val.split('.').length > 2) {
            val = val.replace(/\.+$/, "");
        }
    }
    $(this).val(val);
});

