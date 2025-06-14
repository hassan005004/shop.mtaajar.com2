//Product side category filter
function categories_filter(cat_id, nexturl) {
  $('.scroll-list').hasClass('active');
  $('.actives').removeClass('actives');
  $('#search-keyword').val('');

  if (cat_id == '') {
    $("#cat").addClass('actives');
  }
  $("#cat-" + cat_id).addClass('actives');
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: nexturl,
    method: "get",
    data: {
      id: cat_id
    },
    success: function (data) {
      $("#pos-item").html('');
      $("#cat_id").val();
      $("#pos-item").html(data);
    },
    error: function (data) {
      toastr.error(wrong);
      return false;
    }
  });
}

//Product Search
$('#search-keyword').keyup(function () {
  "use strict";

  var cat_id = $('#cat_id').val();
  var keyword = $('#search-keyword').val();
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: $('#search-url').val(),
    method: "get",
    data: {
      id: cat_id,
      keyword: keyword
    },
    success: function (data) {
      $("#pos-item").html('');
      $("#cat_id").val();
      $("#pos-item").html(data);
    },
    error: function (data) {
      toastr.error(wrong);
      return false;
    }
  });
});

//Product Add to cart
function addtocart(product_id, product_slug, product_name, product_image, product_tax, product_price, addcarturl) {
  "use strict";
  var variation_name = $('#variants_name').val();
  var extras_id = ($('.Checkbox:checked').map(function () {
    return this.value;
  }).get().join('| '));
  var extras_name = ($('.Checkbox:checked').map(function () {
    return $(this).attr('extras_name');
  }).get().join('| '));
  var extras_price = ($('.Checkbox:checked').map(function () {
    return $(this).attr('price');
  }).get().join('| '));
  "use strict";
  $('.addtocart').prop("disabled", true);
  $('.addtocart').html(
    '<span class="loader"></span>');
  setTimeout(function () {
    $('.addtocart').html('Add To Cart');
  }, 3000);

  $.ajax({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    },
    url: addcarturl,
    data: {
      product_id: product_id,
      product_slug: product_slug,
      product_name: product_name,
      product_image: product_image,
      product_tax: product_tax,
      product_price: product_price,
      variation_name: variation_name,
      qty: $('.item_qty_' + product_id).val(),
      extras_id: extras_id,
      extras_name: extras_name,
      extras_price: extras_price
    },
    method: "POST",
    dataType: "json",
    success: function (response) {
      if (response.status == 1) {
        if (response.total_cart_count == 1) {
          location.reload();
        } else {
          $(".cart-count").html(response.total_cart_count);
          toastr.success(response.message);
          $('#viewproduct-over').modal('hide');
        }
      } else {
        $('.addtocart').prop("disabled", false);
        $('.addtocart').html('Add To Cart');
        toastr.error(response.message);
        $('#viewproduct-over').modal('hide');
      }
    },
    error: function () {
      toastr.error(wrong);
      $('#viewproduct-over').modal('hide');
      return false;
    }
  });
}

//Sidebar cart 
function callcartview() {
  $.ajax({
    url: $("#cartViewUrl").val(),
    method: 'GET',
    success: function (response) {

      if (response.status === 1) {
        $('#cartItemsContainer').html(response.output);
        $('#cart-offCanvas').offcanvas('show');
      } else {
        toastr.error(wrong);
        return false;
      }
    },
    error: function () {
      toastr.error(wrong);
      return false;
    }
  });
}

//Product Modal view
function showitems(id) {
  "use strict";
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: $('#showitemurl').val(),
    method: "post",
    data: {
      id: id,
    },
    success: function (response) {
      $('#viewproduct_body').html(response.output);
      $('#viewproduct-over').modal('show');
    },
    error: function () {
      toastr.error(wrong);
      return false;
    }
  });
}

//cart item remove
function RemoveCart(cart_id) {
  "use strict";
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success mx-1',
      cancelButton: 'btn btn-danger bg-danger mx-1'
    },
    buttonsStyling: false
  })
  swalWithBootstrapButtons.fire({
    icon: 'error',
    title: title,
    showCancelButton: true,
    allowOutsideClick: false,
    allowEscapeKey: false,
    confirmButtonText: yes,
    cancelButtonText: no,
    reverseButtons: true,
    showLoaderOnConfirm: true,
    preConfirm: function () {
      return new Promise(function (resolve, reject) {
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: $('#deletecarturl').val(),
          data: {
            cart_id: cart_id
          },
          method: 'POST',
          success: function (response) {
            if (response.status == 1) {
              location.reload();
            } else {
              swal("Cancelled", "{{ trans('messages.wrong') }} :(",
                "error");
            }
          },
          error: function (e) {
            swal("Cancelled", "{{ trans('messages.wrong') }} :(",
              "error");
          }
        });
      });
    },
  }).then((result) => {
    if (!result.isConfirmed) {
      result.dismiss === Swal.DismissReason.cancel
    }
  })
}

//Cart Qty upadate
function qtyupdate(id, type, qtyurl, item_id, variant_id, cart_qty) {
  "use strict";
  $.ajax({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    },
    url: qtyurl,
    data: {
      id: id,
      type: type,
      item_id: item_id,
      variant_id: variant_id,
      qty: cart_qty
    },
    method: "POST",
    success: function (response) {
      // console.log(response);

      if (response.status === 1) {
        $("#cartItemsContainer").html(response.output);
        var cartOffCanvas = new bootstrap.Offcanvas(
          document.getElementById("cart-offCanvas")
        );
        cartOffCanvas.show();
      } else {
        console.error("Unexpected response status: " + response.status);
        toastr.error(response.message);
      }
    },
    error: function (e) {
      $("#preload").hide();
      $(".err" + id).html(e.message);
      return false;
    }
  });
}

//Apply discount
$("#apply-discount").on("click", function () {
  var discountValue =
    parseFloat(document.getElementById("discount-input").value) || 0;
  if (discountValue == 0) {
    toastr.error("Please enter discount amount");
    return false;
  }
  var subtotal1 =
    parseFloat($(".sub_total1").text().replace(/[^0-9.-]+/g, "")) || 0;

  if (discountValue <= subtotal1) {
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
      },
      url: discounturl, // Ensure this is the correct URL for your endpoint
      data: {
        discount: discountValue
      },
      method: "POST",
      success: function (response) {
        var discount = parseFloat(response.discount) || 0;
        $("#discount_amount").text(`${currency_formate(discount)}`);
        var subtotal1 =
          parseFloat($(".sub_total1").text().replace(/[^0-9.-]+/g, "")) || 0;
        var taxTotal =
          parseFloat(
            $(".tax-rate").toArray().reduce(function (total, element) {
              return (
                total + parseFloat($(element).text().replace(/[^0-9.-]+/g, ""))
              );
            }, 0)
          ) || 0;

        var grandTotal = subtotal1 + taxTotal - discount;

        $(".grand_total").text(currency_formate(grandTotal));

        $("#apply-discount").addClass("d-none");
        $("#remove-discount").removeClass("d-none");
        $("#discount_sec").removeClass("d-none");
        $("#discount-input").prop("disabled", true);
        toastr.success(response.message);
      },
      error: function (xhr) {
        console.error("An error occurred:", xhr.responseText);
      }
    });
  } else {
    toastr.error("Please enter a valid discount amount");
  }
});

//Remove discount
$(document).ready(function () {
  $("#remove-discount").on("click", function () {
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
      },
      url: removediscounturl, // Ensure this is the correct URL for your endpoint
      method: "POST",
      success: function (response) {
        // Update UI to reflect discount removal
        $("#discount_amount").text(currency_formate(0)); // Set discount amount to 0

        // Recalculate totals assuming no discount
        var subtotal1 =
          parseFloat($(".sub_total1").text().replace(/[^0-9.-]+/g, "")) || 0;
        var taxTotal =
          parseFloat(
            $(".tax-rate").toArray().reduce(function (total, element) {
              return (
                total + parseFloat($(element).text().replace(/[^0-9.-]+/g, ""))
              );
            }, 0)
          ) || 0;

        var grandTotal = subtotal1 + taxTotal;
        $(".grand_total").text(currency_formate(grandTotal));
        $("#discount-input").val('');

        // Show Apply Discount button and hide Remove Discount button
        $("#apply-discount").removeClass("d-none");
        $("#remove-discount").addClass("d-none");
        $("#discount_sec").addClass("d-none");
        $("#discount-input").prop("disabled", false);
        toastr.success(response.message);
      },
      error: function (xhr) {
        console.error("An error occurred:", xhr.responseText);
      }
    });
  });
});

//Order now modal open
function OrderNow(ordernowurl) {
  "use strict";
  var customerid = $('#customer').val();
  var sub_total = $('.sub_total').text();
  // Retrieve and concatenate tax names and rates
  var tax_names = [];
  var tax_rates = [];

  $('.tax_name').each(function () {
    tax_names.push($(this).text().trim());
  });

  $('.tax-rate').each(function () {
    tax_rates.push($(this).text().trim());
  });

  var tax_names_str = tax_names.join('| ');
  var tax_rates_str = tax_rates.join('| ');

  var discount_amount = $('#discount_amount').text();
  var grand_total = $('.grand_total').text();

  $.ajax({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    },
    data: {
      customerid: customerid,
    },
    url: ordernowurl,
    method: "POST",
    success: function (response) {
      if (response.status === 1) {
        $('#OrderNowContainer').html(response.output);
        $('#orderButton').modal('show');
        $('#orderdiscount_amount').text(discount_amount);
        $('#hiddendiscount_amount').val(discount_amount);
        // Split tax names and rates
        var tax_names_list = tax_names_str.split('| ');
        var tax_rates_list = tax_rates_str.split('| ');

        // Clear previous content
        $('#ordertax_name').empty();
        $('#ordertax_rate').empty();

        // Display each tax name and rate
        tax_names_list.forEach(function (name, index) {
          var rate = tax_rates_list[index] || ''; // Handle case where tax_rates_list is shorter
          $('#ordertax_name').append(`<div>${name}</div>`);
          $('#ordertax_rate').append(`<div>${rate}</div>`);
        });

        $('#hiddentax_name').text(tax_names_str);
        $('#hiddentax_rate').text(tax_rates_str);
        $('#ordersub_total').text(sub_total);
        $('#ordergrand_total').text(grand_total);


      } else {
        toastr.error(wrong);
        return false;
      }
    }
  });
}

//Place order
function placeorder(placeorderurl) {
  var discount_amount = $('#orderdiscount_amount').text().trim();
  var cleaned_amount = discount_amount.replace(/[^0-9.-]/g, '');
  var numeric_amount = parseFloat(cleaned_amount);
  var order_note = $('#cart_order_note').val();
  var numeric_amount_sub = $("#ordersub_total").text().trim();

  var cleaned_amount_sub = numeric_amount_sub.replace(/[^0-9.-]/g, '');
  var sub_total = parseFloat(cleaned_amount_sub);

  var tax_name = $("#hiddentax_name").text();

  var tax_rate = $("#hiddentax_rate").text().trim();
  var tax_rates = tax_rate.replace(/[^\d.-|]/g, '');


  var numeric_amount_grand = $("#ordergrand_total").text().trim();
  var cleaned_amount_grand = numeric_amount_grand.replace(/[^0-9.-]/g, '');
  var grand_total = parseFloat(cleaned_amount_grand);

  var customer_name = $("#customer_name").val();
  var customer_email = $("#customer_email").val();
  var customer_phone = $("#customer_phone").val();


  // Reset previous error messages
  $('#customer_name_required').text("");
  $('#customer_email_required').text("");
  $('#customer_phone_required').text("");
  $('#payment_type_required').text("");

  // Validate customer details
  var valid = true; // Flag to check if all validations pass

  if (customer_name === '') {
    $('#customer_name_required').text("Please enter your name.");
    valid = false;
  }
  if (customer_email === '') {
    $('#customer_email_required').text("Please enter your email address.");
    valid = false;
  }
  if (customer_phone === '') {
    $('#customer_phone_required').text("Please enter your phone number.");
    valid = false;
  }

  var payment_type = $('input[name="payment_type"]:checked').val();
  if (!payment_type) {
    $('#payment_type_required').text("Please select a payment type.");
    valid = false;
  }

  if (!valid) {
    $('#orderButton').modal('show');
    return;
  }


  $.ajax({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    },
    url: placeorderurl,
    data: {
      discount_amount: numeric_amount,
      customer_name: customer_name,
      customer_email: customer_email,
      customer_phone: customer_phone,
      payment_type: payment_type,
      sub_total: sub_total,
      tax_rates: tax_rates,
      tax_names: tax_name,
      grand_total: grand_total,
      order_note: order_note
    },
    method: "POST",
    success: function (response) {
      if (response.status == 1) {
        $('#customer_name_required').text("");
        $('#customer_email_required').text("");
        $('#customer_phone_required').text("");
        $('#payment_type_required').text("");
        $("#cart_btn").addClass('d-none');
        $('#orderButton').modal('hide');

        $('#order_id').attr('href', response.url);
        $('#exampleModalToggle2').modal('show');

      }
    },
    error: function () {
      toastr.error(wrong);
      return false;
    }
  });
}