if (document.getElementById("stripekey") && $("#stripekey").val() !== "") {
  var stripe = Stripe($("#stripekey").val());

  var card = stripe.elements().create("card", {
    style: {
      base: {
        fontSize: "16px",

        color: "#32325D"
      }
    }
  });

  card.mount("#card-element");

  $(".__PrivateStripeElement iframe").css({
    height: "50px",

    width: "100%",

    border: "1px solid #e5e5e5",

    "border-radius": "6px",

    display: "block",

    padding: "15px",

    "box-shadow": "0 0 6px rgba(0, 0, 0654, .3)"
  });
}

// TO-MANAGE-PAYMENT-TYPE

$("input:radio[name=transaction_type]").on("click", function (event) {
  "use strict";
  if ($(this).val() == "3") {
    $("#card-element").removeClass("d-none");
  } else {
    $("#card-element").addClass("d-none");
  }
});

setTimeout(function () {
  "use strict";
  $("input:radio[name=transaction_type]:checked").on("click", function () {
    if ($(this).val() == "3") {
      $("#card-element").removeClass("d-none");
    } else {
      $("#card-element").addClass("d-none");
    }
  }).click();
}, 2000);

function randomdata() {
  "use strict";

  $("#user_name").val("James Carter");

  $("#user_email").val("james@yopmail.com");

  $("#user_mobile").val("(912) 756-2208");

  $("#shipping_address , #billing_address").val("9878 Ford Ave");

  $("#shipping_landmark , #billing_landmark").val("Hill");

  $("#shipping_postal_code , #billing_postal_code").val("31324");

  $("#shipping_city , #billing_city").val("Richmond");

  $("#shipping_state , #billing_state").val("Georgia");

  $("#shipping_country , #billing_country").val("United States");
}

$(function () {
  "use strict";

  if (env == "sandbox") {
    randomdata();
  }
});

function copy_billing_data() {
  "use strict";

  $("#shipping_address").val($("#billing_address").val());

  $("#shipping_landmark").val($("#billing_landmark").val());

  $("#shipping_postal_code").val($("#billing_postal_code").val());

  $("#shipping_city").val($("#billing_city").val());

  $("#shipping_state").val($("#billing_state").val());

  $("#shipping_country").val($("#billing_country").val());
}

function check_data_empty() {
  "use strict";

  let check = 0;

  $(".personal-info .form-control, .billing-info .form-control").each(function (index) {
    if ($(this).val() == "") {
      $(this).addClass("is-invalid").focus();
      check = 0;
      return false;
    } else if ($(this).attr("type") == "email") {
      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

      if (regex.test($(this).val()) == false) {
        $(this).addClass("is-invalid").focus();

        check = 0;

        return false;
      } else {
        $(this).removeClass("is-invalid").addClass("is-valid");
      }
    } else {
      $(this).removeClass("is-invalid").addClass("is-valid");

      check = 1;
    }
  });
  if (check == 1 && $(".shipping-area-info .form-select").find(":selected").val() == "") {
    $(".shipping-area-info .form-select").addClass("is-invalid").focus();

    check = 0;

    return false;
  }

  return check;
}

function copyToClipboard(element) {
  "use strict";
  $.ajax({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    },
    url: $("#copycodeurl").val(),
    type: "post",
    dataType: "json",
    data: {
      code: element
    },
    success: function (response) {
      if (response.status == 1) {
        $("#couponcode").val("");
        $("#couponcode").val(response.element);
        $("#offerslabel").offcanvas("hide");
      } else {
        toastr.error(response.message);
      }
    }
  });
}
$("#shipping_area").on("change", function () {
  "use strict";

  $(".delivery-charge-section").removeClass("d-none");

  let delivery_charge = parseFloat(
    $(this).find(":selected").attr("data-delivery-charge")
  );

  $(".delivery_charge").html(currency_formate(delivery_charge));
  let sub_total = parseFloat($("#sub_total").val());

  let offer_amount = parseFloat($("#discount_amount").val());

  let tax_amount = parseFloat($("#totaltax").val());

  let grand_total = sub_total - offer_amount + tax_amount + delivery_charge;

  $("#delivery_charge").val(delivery_charge);

  $("#grand_total").val(grand_total);

  $("#total_amount").text(currency_formate(grand_total));
});
// payment_type = COD : 1,RazorPay : 2, Stripe : 3, Flutterwave : 4, Paystack : 5, Mercado Pago : 7, PayPal : 8, MyFatoorah : 9, toyyibpay : 10
function placeorder() {
  if (min_order_amount != null && min_order_amount != "") {
    if (parseInt(min_order_amount) > parseInt($("#sub_total").val())) {
      showtoast("error", min_order_amount_msg + ' ' + min_order_amount);
      return false;
    }
  }
  "use strict";
  $('.placeorder').prop("disabled", true);
  $('.placeorder').html('<span class="loader"></span>');
  if (check_data_empty() == 0) {
    $('.placeorder').prop("disabled", false);
    $('.placeorder').html('Proceed To Pay');
    return false;
  }
  showloader();

  $.ajax({
    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },

    url: orderlimit_url,

    data: {
      vendor_id: $("#vendor_id").val()
    },
    method: "POST",

    success: function (response) {
      if (response.status == 0) {
        hideloader();
        $('.placeorder').prop("disabled", false);
        $('.placeorder').html('Proceed To Pay');
        showtoast("error", response.message);

        return false;
      } else {
        var transaction_type = $(
          "input:radio[name=transaction_type]:checked"
        ).val();

        var transaction_currency = $(
          "input:radio[name=transaction_type]:checked"
        ).attr("data-currency");

        var grand_total = $("#grand_total").val();

        var user_name = $("#user_name").val();

        var user_email = $("#user_email").val();

        var user_mobile = $("#user_mobile").val();

        // -------------------- COD ----------------------

        if (transaction_type == "1") {
          callplaceorder(1, "");
        }

        // -------------------- Wallet ----------------------
        if (transaction_type == "16") {
          callplaceorder(16, "");
        }

        // ------------------ Razorpay -------------------

        if (transaction_type == "2") {
          var options = {
            "key": $('#razorpaykey').val(),
            "amount": parseInt(grand_total * 100),
            "name": title,
            "description": description,
            "image": 'https://badges.razorpay.com/badge-light.png',
            "handler": function (response) {
              callplaceorder(2, response.razorpay_payment_id);
            },
            "modal": {
              "ondismiss": function () {
                $('.placeorder').prop("disabled", false);
                $('.placeorder').html('Proceed To Pay');
              }
            },
            "prefill": {
              name: user_name,

              email: user_email,

              contact: user_mobile
            },
            "theme": {
              "color": "#366ed4"
            }
          };

          var rzp1 = new Razorpay(options);

          rzp1.open();
        }

        // ------------------ Stripe ---------------------

        if (transaction_type == "3") {
          stripe.createToken(card).then(function (result) {
            "use strict";

            if (result.error) {
              $('.placeorder').prop("disabled", false);
              $('.placeorder').html('Proceed To Pay');
              showtoast("error", result.error.message);

              return false;
            } else {
              callplaceorder(3, result.token.id);
            }
          });
        }

        // ------------------ Flutterwave ----------------

        if (transaction_type == "4") {
          FlutterwaveCheckout({
            public_key: $("#flutterwavekey").val(),

            tx_ref: user_name,

            amount: grand_total,

            currency: transaction_currency,

            payment_options: "",

            customer: {
              name: user_name,

              email: user_email,

              phone_number: user_mobile
            },

            callback: function (response) {
              callplaceorder(4, response.flw_ref);
            },

            onclose: function () {
              $('.placeorder').prop("disabled", false);
              $('.placeorder').html('Proceed To Pay');
            },

            customizations: {
              title: title,

              description: description,

              logo: "https://flutterwave.com/images/logo/logo-mark/full.svg"
            }
          });
        }

        // ------------------ Paystack -------------------

        if (transaction_type == "5") {
          let handler = PaystackPop.setup({
            key: $("#paystackkey").val(),

            email: user_email,

            amount: parseFloat(grand_total * 100),

            currency: transaction_currency, // Use USD for US Dollars OR GHS for Ghana Cedis

            ref: "trx_" + Math.random().toString(16).slice(2),

            label: "Paystack Order payment",

            onClose: function () {
              $('.placeorder').prop("disabled", false);
              $('.placeorder').html('Proceed To Pay');
            },

            callback: function (response) {
              callplaceorder(5, response.trxref);
            }
          });

          handler.openIframe();
        }

        // ----------------- Mercado pago ----------------

        if (transaction_type == "7") {
          callplaceorder(7, "");
        }

        // ----------------- PayPal ----------------
        if (transaction_type == "8") {
          callplaceorder(8, "");
        }

        // ----------------- My Fatoorah ----------------
        if (transaction_type == "9") {
          callplaceorder(9, "");
        }

        // ----------------- toyyibpay ----------------
        if (transaction_type == "10") {
          callplaceorder(10, "");
        }

        // ----------------- phonepe ----------------
        if (transaction_type == "11") {
          callplaceorder(11, "");
        }

        // ----------------- paytab ----------------
        if (transaction_type == "12") {
          callplaceorder(12, "");
        }

        // ----------------- mollie ----------------
        if (transaction_type == "13") {
          callplaceorder(13, "");
        }

        // ----------------- khalti ----------------
        if (transaction_type == "14") {
          callplaceorder(14, "");
        }

        // ----------------- xendit ----------------
        if (transaction_type == "15") {
          callplaceorder(15, "");
        }

        // Banktransfer
        if (transaction_type == "6") {
          $("#modalbankdetails").modal("show");
          $('#modal_payment_description').html($('#payment_description').val())
          $("#modal_vendor_slug").val(vendorslug);
          $("#modal_user_name").val($("#user_name").val());
          $("#modal_user_name").val($("#user_name").val());
          $("#modal_user_email").val($("#user_email").val());
          $("#modal_user_mobile").val($("#user_mobile").val());
          $("#modal_billing_address").val($("#billing_address").val());
          $("#modal_billing_landmark").val($("#billing_landmark").val());
          $("#modal_billing_postal_code").val($("#billing_postal_code").val());
          $("#modal_billing_city").val($("#billing_city").val());
          $("#modal_billing_state").val($("#billing_state").val());
          $("#modal_billing_country").val($("#billing_country").val());
          $("#modal_shipping_address").val($("#shipping_address").val());
          $("#modal_shipping_landmark").val($("#shipping_landmark").val());
          $("#modal_postal_code").val($("#shipping_postal_code").val());
          $("#modal_shipping_city").val($("#shipping_city").val());
          $("#modal_shipping_state").val($("#shipping_state").val());
          $("#modal_shipping_country").val($("#shipping_country").val());
          $("#modal_shipping_area").val($("#shipping_area").find(":selected").attr("data-area-name"));
          $("#modal_delivery_charge").val($("#delivery_charge").val());
          $("#modal_grand_total").val($("#grand_total").val());
          $("#modal_sub_total").val($("#sub_total").val());
          $("#modal_tax").val($("#tax_amount").val());
          $("#modal_tax_name").val($("#tax_name").val());
          $("#modal_notes").val($("#order_notes").val());
          $("#modal_offer_code").val($("#couponcode").val());
          $("#modal_offer_amount").val($("#discount_amount").val());
          $("#modal_transaction_type").val(transaction_type);
          $("#modal_product_price").val($('#product_price').val());
          $("#modalbankdetails").on('hidden.bs.modal', function (e) {
            $('.placeorder').prop("disabled", false);
            $('.placeorder').html('Proceed To Pay');
          });
        }
      }

    },
    error: function (error) {
      hideloader();
      $('.placeorder').prop("disabled", false);
      $('.placeorder').html('Proceed To Pay');
      "error", wrong;

      return false;
    }
  });
}

function callplaceorder(transaction_type, transaction_id) {
  "use strict";

  showloader();
  var data = {};

  data["user_name"] = $("#user_name").val();

  data["user_email"] = $("#user_email").val();

  data["user_mobile"] = $("#user_mobile").val();

  data["billing_address"] = $("#billing_address").val();

  data["billing_landmark"] = $("#billing_landmark").val();

  data["billing_postal_code"] = $("#billing_postal_code").val();

  data["billing_city"] = $("#billing_city").val();

  data["billing_state"] = $("#billing_state").val();

  data["billing_country"] = $("#billing_country").val();

  data["shipping_address"] = $("#shipping_address").val();

  data["shipping_landmark"] = $("#shipping_landmark").val();

  data["shipping_postal_code"] = $("#shipping_postal_code").val();

  data["shipping_city"] = $("#shipping_city").val();

  data["shipping_state"] = $("#shipping_state").val();

  data["shipping_country"] = $("#shipping_country").val();

  data["delivery_charge"] = parseFloat($("#delivery_charge").val());
  
  data["shipping_area"] = $("#shipping_area").find(":selected").attr("data-area-name");

  data["grand_total"] = $("#grand_total").val();

  data["sub_total"] = $("#sub_total").val();

  data["tax_amount"] = $("#tax_amount").val();

  data["tax_name"] = $("#tax_name").val();

  data["notes"] = $("#order_notes").val();

  data["offer_code"] = $("#couponcode").val();

  data["offer_amount"] = $("#discount_amount").val();

  data["transaction_type"] = transaction_type;

  data["transaction_id"] = transaction_id;

  data["successurl"] = successurl;

  data["failure"] = failure;
  data["product_price"] = $('#product_price').val();

  data["return"] = 1;

  var ajaxurl = "";

  var ajaxurl = checkouturl;

  if (transaction_type == "7") {
    ajaxurl = checkouturl + "/mercadopagorequest";
  }
  if (transaction_type == "8") {
    ajaxurl = checkouturl + "/paypalrequest";
  }

  if (transaction_type == "9") {
    ajaxurl = checkouturl + "/myfatoorahrequest";
  }

  if (transaction_type == "10") {
    ajaxurl = checkouturl + "/toyyibpayrequest";
  }

  if (transaction_type == "11") {
    ajaxurl = checkouturl + "/phoneperequest";
  }

  if (transaction_type == "12") {
    ajaxurl = checkouturl + "/paytabrequest";
  }

  if (transaction_type == "13") {
    ajaxurl = checkouturl + "/mollierequest";
  }

  if (transaction_type == "14") {
    ajaxurl = checkouturl + "/khaltirequest";
  }

  if (transaction_type == "15") {
    ajaxurl = checkouturl + "/xenditrequest";
  }
  $.ajax({
    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },

    url: ajaxurl,

    data: data,

    method: "POST",

    success: function (response) {
      if (response.status == 1) {
        if (
          transaction_type != "7" &&
          transaction_type != "8" &&
          transaction_type != "9" &&
          transaction_type != "10" &&
          transaction_type != "11" &&
          transaction_type != "12" &&
          transaction_type != "13" &&
          transaction_type != "14" &&
          transaction_type != "15"
        ) {
          location.href = ordersuccess + response.order_number;
        }
        else {
          if (transaction_type == 8) {
            $(".callpaypal").trigger("click")
          } else {
            location.href = response.redirecturl;
          }
        }

      } else {
        hideloader();
        $('.placeorder').prop("disabled", false);
        $('.placeorder').html('Proceed To Pay');
        showtoast("error", response.message);

        return false;
      }
    },

    error: function (error) {
      hideloader();
      $('.placeorder').prop("disabled", false);
      $('.placeorder').html('Proceed To Pay');
      "error", wrong;

      return false;
    }
  });
}
