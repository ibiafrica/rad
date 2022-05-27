
//Add invocie row field

function addInputField(t) {

    //Variable declaratipn

    var count = 2,

    limits = 500;



    if (count == limits) alert("You have reached the limit of adding " + count + " inputs");

    else {

        var a = "product_name" + count,

            e = document.createElement("tr");

        e.innerHTML = "<td><input type='text' name='product_name' placeholder='Product Name' onkeypress='invoice_productList(" + count + ");' class='form-control productSelection' required='' id='product_name" + count + "' ><input type='hidden' class='autocomplete_hidden_value product_id_" + count + "' name='product_id[]' id='SchoolHiddenId'/></td><td><input type='text' name='available_quantity[]' id='' class='form-control text-right available_quantity_" + count + "' placeholder='0' readonly='' /></td><td><input type='text' class='form-control text-right unit_" + count + "' placeholder='None' readonly='' /></td><td><input type='number' name='product_quantity[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' id='total_qntt_" + count + "' class='form-control text-right' value='1' min='1' /></td><td><input type='number' name='product_rate[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' placeholder='0.00' min='0' id='price_item_" + count + "' class='price_item" + count + " form-control text-right' required='' /></td><td><input type='number' name='discount[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' id='discount_" + count + "' class='form-control text-right' placeholder='0.00' min='0' /></td><td><input class='total_price form-control text-right' type='text' name='total_price[]' id='total_price_" + count + "' placeholder='0.00' tabindex='' readonly='readonly' /></td><td><input type='hidden' id='cgst_" + count + "' class='cgst'/> <input type='hidden' id='sgst_" + count + "' class='sgst'/><input type='hidden' id='igst_" + count + "' class='igst'/><input type='hidden' id='total_cgst_" + count + "' class='total_cgst' name='cgst[]' /><input type='hidden' id='total_sgst_" + count + "' class='total_sgst' name='sgst[]'/><input type='hidden' id='total_igst_" + count + "' class='total_igst' name='igst[]'/><input type='hidden' name='cgst_id[]' id='cgst_id_" + count + "'><input type='hidden' name='sgst_id[]' id='sgst_id_" + count + "'><input type='hidden' name='igst_id[]' id='igst_id_" + count + "'><input type='hidden' name='variant_id[]' id='variant_" + count + "'><input type='hidden' id='total_discount_" + count + "' /><input type='hidden' id='all_discount_" + count + "' class='total_discount'/><button style='text-align: right;' class='btn btn-danger' type='button' value='Delete' onclick='deleteRow(this)'>Delete</button></td>", document.getElementById(t).appendChild(e), document.getElementById(a).focus(), count++

    }

}

//Add edit invocie row field

function addEditInvoiceItem(t) {

    //Variable declaratipn

    var rows = $('#edit_invoice tbody tr').length;

    var count = rows + 1,

    limits = 500;



    if (count == limits) alert("You have reached the limit of adding " + count + " inputs");

    else {

        var a = "product_name" + count,

            e = document.createElement("tr");

        e.innerHTML = "<td><input type='text' name='product_name' placeholder='Product Name' onkeypress='invoice_productList(" + count + ");' class='form-control productSelection' required='' id='product_name" + count + "' ><input type='hidden' class='autocomplete_hidden_value product_id_" + count + "' name='product_id[]' id='SchoolHiddenId'/></td><td><input type='text' name='available_quantity[]' id='' class='form-control text-right available_quantity_" + count + "' placeholder='0' readonly='' /></td><td><input type='text' class='form-control text-right unit_" + count + "' placeholder='None' readonly='' /></td><td><input type='number' name='product_quantity[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' id='total_qntt_" + count + "' class='form-control text-right' value='1' min='1' /></td><td><input type='number' name='product_rate[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' placeholder='0.00' min='0' id='price_item_" + count + "' class='price_item" + count + " form-control text-right' required='' /></td><td><input type='number' name='discount[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' id='discount_" + count + "' class='form-control text-right' placeholder='0.00' min='0' /></td><td><input class='total_price form-control text-right' type='text' name='total_price[]' id='total_price_" + count + "' placeholder='0.00' tabindex='' readonly='readonly' /></td><td><input type='hidden' id='cgst_" + count + "' class='cgst'/> <input type='hidden' id='sgst_" + count + "' class='sgst'/><input type='hidden' id='igst_" + count + "' class='igst'/><input type='hidden' id='total_cgst_" + count + "' class='total_cgst' name='cgst[]' /><input type='hidden' id='total_sgst_" + count + "' class='total_sgst' name='sgst[]'/><input type='hidden' id='total_igst_" + count + "' class='total_igst' name='igst[]'/><input type='hidden' name='cgst_id[]' id='cgst_id_" + count + "'><input type='hidden' name='sgst_id[]' id='sgst_id_" + count + "'><input type='hidden' name='igst_id[]' id='igst_id_" + count + "'><input type='hidden' name='variant_id[]' id='variant_" + count + "'><input type='hidden' id='total_discount_" + count + "' /><input type='hidden' id='all_discount_" + count + "' class='total_discount'/><button style='text-align: right;' class='btn btn-danger' type='button' value='Delete' onclick='deleteRow(this)'>Delete</button></td>", document.getElementById(t).appendChild(e), document.getElementById(a).focus(), count++

    }

}



//Quantity calculate

function quantity_calculate(item) {

    var quantity    = $("#total_qntt_" + item).val();

/*    var remise =$("#remise_item_"+item).val();

*/    var price_item  = $("#price_item_" + item).val();

    var discount    = $("#discount_" + item).val();

    var total_discount = $("#total_discount_" + item).val();

    var cgst        = $("#cgst_" + item).val();

    var sgst        = $("#sgst_" + item).val();

    var igst        = $("#igst_" + item).val();



    var all_discount = discount * quantity;

    $("#all_discount_" + item).val(all_discount);



    //Tax calculation

    var net_price = (quantity * price_item) - all_discount;

    var cgst_tax  = (net_price * cgst);

    var sgst_tax  = (net_price * sgst);

    var igst_tax  = (net_price * igst);



    //Tax calculation set

    $("#total_cgst_" + item).val(cgst_tax);

    $("#total_sgst_" + item).val(sgst_tax);

    $("#total_igst_" + item).val(igst_tax);



    if (quantity > 0) {

        var n = quantity * price_item;

        $("#total_price_" + item).val(n);

        $("#quantity_" + item).text('[ '+quantity+' ]');

        $(".qnt_price_" + item).text('('+quantity+' x '+price_item+')');

        $(".total_price_bill_" + item).text(n);

    }else {

        var n = quantity * price_item;

        $("#total_price_" + item).val(n);

    }



 /*       if (remise > 0) {

        var n = price_item/(1-remise *100);

        $("#total_price_" + item).val(n);

        $("#quantity_" + item).text('[ '+quantity+' ]');

        $(".qnt_price_" + item).text('('+quantity+' x '+price_item+')');

        $(".total_price_bill_" + item).text(n);

    }else {

        var nx = quantity * price_item;

        $("#total_price_" + item).val(nx);

    }*/

    calculateSum();

    invoice_paidamount();

}





//Quantity calculate

function remise_calculate(item) {

    var quantity    = $("#total_qntt_" + item).val();

    var remise =$("#remise_item_"+item).val();

    var price_item  = $("#price_item_" + item).val();

    var discount    = $("#discount_" + item).val();

    var total_discount = $("#total_discount_" + item).val();

    var cgst        = $("#cgst_" + item).val();

    var sgst        = $("#sgst_" + item).val();

    var igst        = $("#igst_" + item).val();

    var all_discount = discount * quantity;

    $("#all_discount_" + item).val(all_discount);

    //Tax calculation

    var net_price = (quantity * price_item) - all_discount;

    var cgst_tax  = (net_price * cgst);

    var sgst_tax  = (net_price * sgst);

    var igst_tax  = (net_price * igst);

/*    console.log("la remise des produits"+remise);

*/    //Tax calculation set

    $("#total_cgst_" + item).val(cgst_tax);

    $("#total_sgst_" + item).val(sgst_tax);

    $("#total_igst_" + item).val(igst_tax);

         if (remise > 0) {

        ////////////////////////////////

        var nx = quantity * price_item;

        var n = nx*(1-remise/100);

        ///////////////////////////////

        $("#total_price_" + item).val(n);

        $("#quantity_" + item).text('[ '+quantity+' ]');

        $(".qnt_price_" + item).text('('+quantity+' x '+price_item+')');

        $(".total_price_bill_" + item).text(n);

         }else {

            var n = quantity * price_item;

            $("#total_price_" + item).val(n);

        }

        calculateSum();

        invoice_paidamount();

}



///// calculer tout les somme y compris



//Calculate all summation

function calculateSum() {

    var cgst = 0;

    var sgst = 0;

    var igst = 0;

    var e = 0;

    var f = 0;

    var total_discount = 0;

    var total_price = 0;

    var inv_dis = 0;

    var ser_chg = 0;



    //Total CGST

    $(".total_cgst").each(function() {

        isNaN(this.value) || 0 == this.value.length || (cgst += parseFloat(this.value))

    }),

    $("#total_cgst").val(cgst),

    $(".total_cgst_bill").text(cgst),



    //Total SGST

    $(".total_sgst").each(function() {

        isNaN(this.value) || 0 == this.value.length || (sgst += parseFloat(this.value))

    }),

    $("#total_sgst").val(sgst),

    $(".total_sgst_bill").text(sgst),



     //Total IGST

    $(".total_igst").each(function() {

        isNaN(this.value) || 0 == this.value.length || (igst += parseFloat(this.value))

    }),

    $("#total_igst").val(igst),

    $(".total_igst_bill").text(igst),



    //Total Discount

    $(".total_discount").each(function() {

        isNaN(this.value) || 0 == this.value.length || (total_discount += this.value)

    }),

    $("#total_discount_ammount").val(total_discount),

    $(".total_discount_bill").text(total_discount),



    //Total Price

    $(".total_price").each(function() {

        isNaN(this.value) || 0 == this.value.length || (total_price += parseInt(this.value))

    }),



    cgst = cgst,

    sgst = sgst,

    igst = igst,

    e    = total_price,

    f    = total_discount,

    inv_dis = $("#invoice_discount").val(),

    ser_chg = $("#service_charge").val(),

    sum = +cgst+ +sgst+ +igst+ +e+ - f+ - inv_dis+ +ser_chg;

  

    sums= e*(1-inv_dis/100);

    tva=sums/100*18;



    $("#htva").val(sums);

    $("#grandTotal").val(tva);

    $(".total_bill").text(sum);

   // invoice_paidamount();

}



//Inovice paid amount

function invoice_paidamount() {

    var t = $("#grandTotal").val(),

        htva = $("#htva").val(),

        a = $("#paidAmount").val(),

        e = t - a;

    var test = e;

    $("#dueAmmount").val(test)

}



//Stock limit check

function stockLimit(t) {

    var a = $("#total_qntt_" + t).val(),

        e = $(".product_id_" + t).val(),

        o = $(".baseUrl").val();

    $.ajax({

        type: "POST",

        url: o + "administrator/autotec_ibi_vente/produit_checker",

        data: {

        product_id:e

        },

        cache: !1,

        success: function(e) {

            if (a > Number(e)) {

                var o = "You can purchase maximum " + e + " Items";

                alert(o), $("#qty_item_" + t).val("0"), $("#total_qntt_" + t).val("0"), $("#total_price_" + t).val("0")

            }

        }

    })

}







//Stock limit check by ajax

function stockLimitAjax(t) {

    var a = $("#total_qntt_" + t).val(),

        e = $(".product_id_" + t).val(),

        o = $(".baseUrl").val();

    $.ajax({

        type: "POST",

        url: o + "administrator/autotec_ibi_vente/produit_checker",

        data: {

            product_id: e

        },

        cache: !1,

        success: function(e) {

            if (a > Number(e)) {

                var o = "You can purchase maximum " + e + " Items";

                alert(o), $("#qty_item_" + t).val("0"), $("#total_qntt_" + t).val("0"), $("#total_price_" + t).val("0.00"), calculateSum()

            }

        }

    })

}



//Invoice full paid

function full_paid() {

    var grandTotal = $("#grandTotal").val();

    var htva=$("#grandTotal").val();

    $("#paidAmount").val(grandTotal);

    calculateSum();

    invoice_paidamount();

}





//Delete a row from invoice table

function deleteRow(t) {

    var a = $("#normalinvoice > tbody > tr").length;

    if (1 == a) {

        alert("There only one row you can't delete."); 

        return false;

    }else {

        var e = t.parentNode.parentNode;

        e.parentNode.removeChild(e);

        calculateSum();

        invoice_paidamount();

    }



    calculateSum();

    invoice_paidamount();

    $('#item-number').html('0');

    $(".itemNumber>tr").each(function(i){

        $('#item-number').html(i+1);

        $('.item_bill').html(i+1);

        //let $(this).val();

    });

}







//Delete a pos row from POS table

function deletePosRow(t){

    $("#"+t).remove();

    $("."+t).remove(); 

    calculateSum();

    invoice_paidamount();

    $('#item-number').html('0');

    $(".itemNumber>tr").each(function(i){

    $('#item-number').html(i+1);

    $('.item_bill').html(i+1);

    });

}









