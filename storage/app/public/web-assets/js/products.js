$('input[name="size"]:checked').on("click", function () {
  "use strict";
  $(".product-variation").html($(this).val());

  showprice($(this).attr("data-price"), $(this).attr("data-original-price"));
}).click();

$('input[name="size"]').on("click", function () {
  "use strict";
  $(".product-variation").html($(this).val());

  showprice($(this).attr("data-price"), $(this).attr("data-original-price"));
});

function showprice(price, original_price) {
  "use strict";

  $(".product-price").html(currency_formate(price));

  if (original_price > 0) {
    $(".product-original-price").html(currency_formate(original_price));

    $(".product-price-off-box").show();

    var off = 100 - price * 100 / original_price;

    $(".price-off").show().html(off.toFixed(formate));
  } else {
    $(".product-original-price").html("");

    $(".product-price-off-box").hide();
  }
}

if (document.getElementById("slider-range")) {
  $(function () {
    "use strict";

    $("#slider-range").slider({
      range: true,

      min: 0,

      max: max_price,

      values: [set_min_price, set_max_price],

      slide: function (event, ui) {
        $("#from").val(ui.values[0]);

        $("#to").val(ui.values[1]);
      }
    });

    $("#from").val($("#slider-range").slider("values", 0));

    $("#to").val($("#slider-range").slider("values", 1));
  });
}
$('.relatedPro').owlCarousel({

  loop: false,

  margin: 10,

  nav: false,

  dots: false,

  autoplay: true,

  autoplayTimeout: 5000,

  responsive: {

    0: {

      items: 1

    },

    600: {

      items: 3
    },

    1000: {

      items: 5

    }
  }
})

function changeqty(item_id, type) {

  var qtys = parseInt($('.item_qty_' + item_id).val());
  if (type == "minus") {
    qty = qtys - 1;
  } else {
    qty = qtys + 1;
  }
  if (qty >= "1") {
    $('.item_qty_btn').prop('disabled', true);
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: $('#qtyurl').val(),
      data: {
        item_id: item_id,
        type: type,
        qty: qty,
        vendor_id: $('#overview_vendor').val(),
        variants_name: $('#variants_name').val(),
        stock_management: $('#stock_management').val(),
      },
      method: 'POST',
      success: function (response) {
        if (response.status == 1) {
          $('.item_qty_btn').prop('disabled', false);
          $('.item_qty_' + item_id).val(response.qty);
        } else {
          $('.item_qty_btn').prop('disabled', false);
          $('.item_qty_' + item_id).val(response.qty);
          showtoast("error", response.message);
          $('#viewproduct-over').modal('hide');

        }
      },
      error: function () {
        $('.item_qty_btn').prop('disabled', false);
        showtoast("error", wrong);
      }
    });
  }

}

function qtyupdate(cart_id, item_id, variants_id, price, type) {

  var qtys = parseInt($("#number_" + cart_id).val());
  var item_id = item_id;
  var cart_id = cart_id;
  var variants_id = variants_id;
  if (type == "decreaseValue") {
    qty = qtys - 1;
  } else {
    qty = qtys + 1;
  }

  if (qty >= "1") {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: qtycheckurl,
      data: {
        cart_id: cart_id,
        item_id: item_id,
        type: type,
        qty: qty,
        variants_id: variants_id,
        price: price * qty
      },
      method: 'POST',
      success: function (response) {
        if (response.status == 1) {
          $("#cart-plus").removeClass('disabled');
          location.reload();
        } else {
          $("#cart-plus").addClass('disabled');
          $("#number_" + cart_id).val(response.qty);
          showtoast("error", response.message);

          setTimeout(function () {
            location.reload();
          }, 5000);
        }
      },
      error: function (error) { }
    });
  }

}