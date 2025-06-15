@extends('backend.layout.main')
@section('body-part')
<style>
.edit-delete-icon:hover{
        cursor: pointer;
        color: #e6e7ec;
        scale: 1.1;
        transition-duration: 0.1s ease;

    }
    .bill-item-list-cl tr:hover{

background-color:rgb(245, 247, 250);
}
.search-list{
height:550px;
overflow-x: hidden;
overflow-y: scroll;
}
.grid-container {
  display: grid;
  grid-template-columns: 1fr 1fr 2fr 1fr;
}

.grid-container-medicine {
  display: grid;
  grid-template-columns: 1fr 1fr 2fr 1fr 1fr;
}

</style>
<div class="content-wrapper">
    <x-breadcumb title="Sale Entry"/>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-9">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Invoice NO.</label>
                                        <input type="text" class="form-control form-control-sm" name='invoice_no' id="invoice_no" placeholder="Invoice No" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Customer </label>
                                        <input type="text" class="form-control form-control-sm" name='customer_name' id="customer_name" placeholder="Customer Name">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Contact No.</label>
                                        <input type="text" class="form-control form-control-sm" name='contact_no' id="contact_no" placeholder="Contact No">
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="reset" class="btn btn-sm btn-info" id="invoice_create_new">&nbsp;Create New&nbsp;</button>
                                <button type="submit" class="btn btn-sm btn-success" id="add-new-invoice">&nbsp;Save&nbsp;</button>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="form-group">
                                <label>Search Invoice NO.</label>
                                <input type="text" class="form-control form-control-sm" name='invoice_no_search' id="invoice_no_search" placeholder="Invoice NO">
                            </div>
                            <div class="dropdown-menu w-100" style="max-height:350px;overflow-y:scroll;" id="invoice_dropdown-menu" aria-labelledby="dLabel">
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
        <div class="container-fluid">
            <div class="card p-0">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="dropdown">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name='search_data' id="search_data" placeholder="Medicine Name">
                                </div>
                                <div class="dropdown-menu" style="max-height:350px;min-width:100%;overflow-y:scroll;" id="search_dropdown-menu" aria-labelledby="dLabel">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-2 d-flex">
                            <div class="form-check mr-2">
                                <input class="form-check-input" type="radio" name="match" value="E"checked required>
                                <label class="form-check-label">Exact</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="match" value="P">
                                <label class="form-check-label">Partial</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-9">
                             <div class="search-list" style="font-size:14px;">
                                <table class="table table-sm">
                                    <thead>
                                        <th style="width:20%;">Product Name</th>
                                        <th style="width:10%;">Expire Date</th>
                                        <th style="width:10%;">MRP Price</th>
                                        <th style="width:10%;">Quantity</th>
                                        <th style="width:10%;">Total Price</th>
                                        <th style="width:10%;">Discount Percent</th>
                                        <th style="width:10%;">Discount Amount</th>
                                        <th style="width:10%;">Final Price</th>
                                        <th style="width:10%;">Action</th>
                                    </thead>
                                    <tbody class="bill-item-list-cl" id="medecine-item-list">
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive" style="font-size:14px;">
                                <table class="table table-sm">
                                    <tbody>
                                        <tr>
                                            <th style="text-align: right;">Discount in Amount :</th>
                                            <td><input class="form-control form-control-sm final-bill-field" type="number" step="any" value="0" name="bill_dis_amt" id="bill-dis-amt" /></td>
                                            <th style="text-align: right;">Total Amount :</th>
                                            <td><input class="form-control form-control-sm " type="number" step="any" value="0" name="bill_amount" id="bill-amount"  readonly/></td>
                                            <th style="text-align: right;">Total Paid :</th>
                                            <td><input class="form-control form-control-sm final-bill-field" type="number" step="any" value="0" name="bill_paid_amount" id="bill-paid-amount"/></td>
                                        </tr>
                                        <tr>
                                            <th style="text-align: right;">Discount in Percentage :</th>
                                            <td><input class="form-control form-control-sm " type="number" step="any" value="0" name="bill_in_per" id="bill-in-per"/></td>
                                            <th style="text-align: right;">Net Payable Amount :</th>
                                            <td><input class="form-control form-control-sm " type="number" step="any" value="0" name="bill_total_amount" id="bill-total-amount" readonly/></td>
                                            <th style="text-align: right;">Total Due :</th>
                                            <td><input class="form-control form-control-sm " type="number" step="any" value="0" name="bill_due_amount" id="bill-due-amount"/></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="card-footer text-right">
                                    <button type="reset" class="btn btn-sm btn-danger float-left">&nbsp;Clear&nbsp;</button>
                                    <button type="submit" class="btn btn-sm btn-success" id="bill-final-save">&nbsp;Save&nbsp;</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <table  class="table table-sm" class="w-100">
                                <thead>
                                    <th style="width:30%;padding:5px;">Attribute</th>
                                    <th style="width:70%;padding:5px;">Value</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="width:30%;">Name</td>
                                        <td style="width:70%;">
                                            <input class="form-control form-control-md w-100" type="text" id="name" name="name" value="" disabled>
                                            <input type="hidden" id="item-id" name="item_id" value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:30%;">Cell</td>
                                        <td style="width:70%;">
                                            <input class="form-control form-control-md w-100" type="text" id="stock-location" name="stock_location" value="" disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:30%;">Expire Date</td>
                                        <td style="width:70%;">
                                            <div class="form-group">
                                                <select class="form-control form-control-sm"  name="expire_date" id="expire-date">
                                                  <option value="" disabled>Please select</option>
                                                </select>
                                              </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:30%;">MRP Price</td>
                                        <td style="width:70%;">
                                            <input class="form-control form-control-md w-100" type="text" id="mrp-rate" name="mrp_rate" value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:30%;">Trade Price</td>
                                        <td style="width:70%;">
                                            <input class="form-control form-control-md w-100" type="text" id="tp-rate" name="tp_rate" value="" disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:30%;">Stock Percentage</td>
                                        <td style="width:70%;">
                                            <input class="form-control form-control-md w-100" type="text" id="stock_per" name="stock_per" value=""  disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:30%;">Current Stock</td>
                                        <td style="width:70%;">
                                            <input class="form-control form-control-md w-100" type="text" id="current-stock" data-current-stock="" name="current_stock" value="" disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:30%;">Sale Quantity</td>
                                        <td style="width:70%;">
                                            <input class="form-control form-control-md w-100" type="text" id="sale-quantity" name="sale_quantity" value="0">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:30%;">Total Amount</td>
                                        <td style="width:70%;">
                                            <input class="form-control form-control-md w-100" type="text" id="total-amount" name="total_amount" value="0">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:30%;">Discount Per</td>
                                        <td style="width:70%;">
                                            <input class="form-control form-control-md w-100" type="text" id="disc-per" name="disc_per" value="0">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:30%;">Discount Amount</td>
                                        <td style="width:70%;">
                                            <input class="form-control form-control-md w-100" type="text" id="disc-amt" name="disc_amt" value="0">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:30%;">Payable Amount</td>
                                        <td style="width:70%;">
                                            <input class="form-control form-control-md w-100" type="text" id="payable-amount" name="payable_amount" value="0">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="card-footer text-right pl-0 pr-0">
                                <button type="reset" class="btn btn-sm btn-danger float-left">&nbsp;Clear&nbsp;</button>
                                <button type="submit" class="btn btn-sm btn-success" id="add-btn">&nbsp;Add&nbsp;</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function(){

        //Add New Invoice No.
        $("#invoice_create_new").on('click',function(){
            $("#invoice_no").val("");
            $("#customer_name").val("");
            $("#contact_no").val("");
            $("#add-new-invoice").show();
        });
        //Save New Invoice No.
        $("#add-new-invoice").on('click',function(){
            let customer = $("#customer_name").val();
            let contact =   $("#contact_no").val();
            
            $.ajax({
                type: 'post',
                dataType: "json",
                url: "{{url('invoice')}}",
                data:{
                    '_token': '{{ csrf_token() }}',
                    'customer_name': customer,
                    'contact_no': contact,
                },
                success: function (response) {
                    console.log(response);
                    $("#invoice_no").val(response.invoice_id);
                    $("#customer_name").val(response.customer_name);
                    $("#contact_no").val(response.contact_no);
                    $("#bill-dis-amt").val(0);
                    $("#bill-amount").val(0);
                    $("#bill-paid-amount").val(0);
                    $("#bill-in-per").val(0);
                    $("#bill-total-amount").val(0);
                    $("#bill-due-amount").val(0);
                    toastr.success('Invoice Created Successfully');
                    $("#add-new-invoice").hide();
                    $("#bill-final-save").show();
                    $("#medecine-item-list").empty();

                }
            });
        });
        
        //Search Mrr No. & Select

        $("#invoice_no_search").on('keyup',function(){
            var value = $(this).val().toLowerCase();
            console.log("Prottoy");
            $.ajax({
                    type: 'put',
                    dataType: "json",
                    url: "{{url('invoice')}}/",
                    data:{
                        'search':value,
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (result) {
                        console.log(result);
                        let element = "";
                        result.forEach(x =>{
                                element += `<li class="dropdown-item" >${x.invoice_id}</li>`;
                        });
                        $("#invoice_dropdown-menu").empty();
                        $("#invoice_dropdown-menu").append(element);
                        $("#invoice_dropdown-menu li").on('click',function(e){
                            $("#invoice_no_search").val('');
                            let invoice_no = $(this).text();
                            $.ajax({
                                type: 'get',
                                dataType: "json",
                                url: "{{url('invoice')}}/"+invoice_no,
                                success: function (response) {
                                    console.log(response);
                                    $("#invoice_no").val(response.invoice.invoice_id);
                                    $("#customer_name").val(response.invoice.customer_name);
                                    $("#contact_no").val(response.invoice.contact_no);
                                    $("#bill-dis-amt").val(response.invoice.discount_amount);
                                    $("#bill-amount").val(response.invoice.total_amount);
                                    $("#bill-paid-amount").val(response.invoice.paid_amount);
                                    $("#bill-in-per").val(response.invoice.discount_percent);
                                    $("#bill-total-amount").val(response.invoice.payable_amount);
                                    $("#bill-due-amount").val(response.invoice.due_amount);
                                    // toastr.success('Item Updated Successfully for '+response.success.name);
                                    let element ="";
                                    response.invoice_details.forEach(x =>{
                                            element += `<tr class="item-select" data-id="${x.id}">
                                                <td>${x.product_name}</td>
                                                <td>${x.expire_date}</td>
                                                <td>
                                                    <input class="form-control form-control-sm w-100" type="text" id="mrp_price${x.id}" name="mrp_price" value="${x.mrp_price}" readonly>
                                                </td>
                                                <td>
                                                    <input class="form-control form-control-sm w-100 inv_dtls_qnty" type="text" id="quantity${x.id}" name="quantity" value="${x.quantity}">
                                                </td>
                                                <td>
                                                    <input class="form-control form-control-sm w-100" type="text" id="price${x.id}" name="price" value="${x.price}" readonly>
                                                </td><td>
                                                    <input class="form-control form-control-sm w-100 disc-cal-per" type="text" id="discount_percent${x.id}" name="discount_percent" value="${x.discount_percent}">
                                                </td><td>
                                                    <input class="form-control form-control-sm w-100 disc-cal-amt" type="text" id="discount_amount${x.id}" name="discount_amount" value="${x.discount_amount}">
                                                </td><td>
                                                    <input class="form-control form-control-sm w-100" type="text" id="final_price${x.id}" name="final_price" value="${x.final_price}" readonly>
                                                </td>
                                                <td class="project-actions text-center">
                                                    <a class="btn btn-info btn-sm update" data-id="${x.id}">
                                                        <i style="font-size:10px;" class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-sm delete" href="#" data-id="${x.id}" data-toggle="modal" data-target="#modal-default">
                                                        <i style="font-size:10px;" class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>`
                                        })
                                        $("#medecine-item-list").empty();
                                        $("#medecine-item-list").append(element);
                                        $('.delete').off('click').on('click',function(e){
                                            let id = $(this).attr('data-id');
                                            deleteSaleEntry(id);
                                        });
                                        $('.update').off('click').on('click',function(e){
                                            let id = $(this).attr('data-id');
                                            updateSaleEntry(id);
                                        });
                                        $(".inv_dtls_qnty").off('keyup').on('keyup',function(e){ 
                                            let id = $(this).closest("tr").attr('data-id');
                                            calculateInvoiceDetails(id);
                                        });
                                        $(".disc-cal-per").off('keyup').on('keyup',function(e){
                                            let id = $(this).closest("tr").attr('data-id');
                                            InvDetailsDisAmtCalc(id);
                                        });
                                        $(".disc-cal-amt").off('keyup').on('keyup',function(e){
                                            let id = $(this).closest("tr").attr('data-id');
                                            InvDetailsDisPerCalc(id);
                                        });
                                                

                                                $("#add-new-invoice").hide();
                                                $("#bill-final-save").show();

                                            }
                                        });
                            $("#invoice_dropdown-menu").hide();
                        });
                        $('#invoice_dropdown-menu li').on('mouseenter', function() {
                            $(this).css('background-color', 'lightgreen');
                        });

                        $('#invoice_dropdown-menu li').on('mouseleave', function() {
                            $(this).css('background-color', 'white');
                        });
                    }
                });
            $("#invoice_dropdown-menu").show();
         })
         
        
        $("#invoice_dropdown-menu li").on('click',function(e){
            $("#invoice_no_search").val('');
            let invoice_no = $(this).text();
            $.ajax({
                type: 'get',
                dataType: "json",
                url: "{{url('invoice')}}/"+invoice_no,
                success: function (result) {
                    console.log(result);
                    
                }
            });

            
            $("#mrr_dropdown-menu").hide();
        });
        $("#invoice_no_search").on('focusout',function(){
            $("#invoice_dropdown-menu").fadeOut()
        })
        $("#invoice_no_search").on('focusin',function(){
            var value = $(this).val().toLowerCase();
            let result = false;
            $("#invoice_dropdown-menu li").filter(function() {
                if(!result) result = $(this).text().toLowerCase().indexOf(value) > -1;
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
            console.log(result);
            if(result) $("#invoice_dropdown-menu").show();
            else $("#invoice_dropdown-menu").hide();

            $('#invoice_dropdown-menu li').on('mouseenter', function() {
                $(this).css('background-color', 'lightgreen');
            });

            $('#invoice_dropdown-menu li').on('mouseleave', function() {
                $(this).css('background-color', 'white');
            });
        
        })

        
        //Item Set To Sale Section
        function setItem(id){
            console.log(id);
            $.ajax({
                    type: 'get',
                    dataType: "json",
                    url: "{{url('medecine/productInfo')}}/"+id,
                    success: function (result) {
                        if(result.item.current_stock == 0){
                            toastr.error('Stock Not Available');
                        }else{
                            $("#item-id").val(result.item.id);
                        $("#name").val(result.item.name);
                        $("#stock-location").val(result.item.stock_location);
                        $("#mrp-rate").val(result.item.mrp_rate);
                        $("#tp-rate").val(result.item.tp_rate);
                        $("#stock_per").val(result.item.stock_per);
                        $("#current-stock").val(result.item.current_stock);
                        $("#current-stock").attr("data-current-stock",result.item.current_stock);
                        $("#sale-quantity").val(0);
                        $("#total-amount").val(0);
                        $("#disc-per").val(0);
                        $("#disc-amt").val(0);
                        $("#payable-amount").val(0);
                        if(result.expiryDates){
                            let element=`<option value="" disabled selected>Please select</option>`;
                            result.expiryDates.map(x=>{
                                element+=`<option value="${x.expiry_date}" data-current-qty="${x.current_qty}">${x.expiry_date}</option>`;
                            });
                            $("#expire-date").empty();
                            $("#expire-date").append(element);

                            $("#expire-date").on('change',function(e){
                                let currentStock = $('#expire-date option:selected').attr('data-current-qty');
                                $("#current-stock").val(Number(currentStock).toFixed(2));
                                $("#current-stock").attr("data-current-stock",Number(currentStock).toFixed(2));
                                $("#sale-quantity").val(0);
                                $("#total-amount").val(0);
                            });
                        }
                        }
                        console.log(result);
                        

                    }
                });

        }

        //Registerd Medicine Search
        $("#search_data").on('keyup',function(){
            var value = $(this).val().toLowerCase();
            let match = $('input[name="match"]:checked').val();
            console.log("Prottoy");
            if((value != '') &&( value.length >= 3)){
                $.ajax({
                    type: 'put',
                    dataType: "json",
                    url: "{{url('medecine')}}/",
                    data:{
                        'search':value,
                        'match':match,
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (result) {
                        console.log(result);
                        let element = "";
                        result.forEach(x =>{
                                element += `<li class="dropdown-item grid-container-medicine text-left">
                                                <b data-id="${x.id}">${x.name}</b>
                                                <span>${x.product_sub_category}</span>
                                                <span>${x.manufacturer}</span>
                                                <span>${x.strength}</span>
                                                <span>${x.generic}</span>
                                            </li>`;
                        });
                        $("#search_dropdown-menu").empty();
                        $("#search_dropdown-menu").append(element);
                        $("#search_dropdown-menu li").on('click',function(e){
                        $("#search_data").val($(this).children('b').text());
                            let item_id = $(this).children('b').attr("data-id");
                            setItem(item_id);
                            $("#search_dropdown-menu").hide();
                        });
                        $('#search_dropdown-menu li').on('mouseenter', function() {
                            $(this).css('background-color', 'lightgreen');
                        });

                        $('#search_dropdown-menu li').on('mouseleave', function() {
                            $(this).css('background-color', 'white');
                        });
                    }
                });
            }
            $("#search_dropdown-menu").show();
            
        })
        $("#search_dropdown-menu li").on('click',function(e){
            $("#mrr_no_search").val($(this).text());
            $("#search_dropdown-menu").hide();
        })
        $("#search_data").on('focusout',function(){
            $("#search_dropdown-menu").fadeOut()
        })
        $("#search_data").on('focusin',function(){
            var value = $(this).val().toLowerCase();
            $("#search_dropdown-menu").show();

            $('#search_dropdown-menu li').on('mouseenter', function() {
                $(this).css('background-color', 'lightgreen');
            });

            $('#search_new_dropdown-menu li').on('mouseleave', function() {
                $(this).css('background-color', 'white');
            });
        })

        //Sale Entry Portion Calculation

        function calculatePrice(){
            let mrpRate = $('#mrp-rate').val();
            let saleQuantity = $('#sale-quantity').val();

            let totalAmount = (Number(mrpRate)*Number(saleQuantity)).toFixed(2);
            $('#total-amount').val(totalAmount);

            let discAmt = $('#disc-amt').val();

            let payableAmount = (totalAmount - Number(discAmt)).toFixed(2);

            $('#payable-amount').val(payableAmount);
        }

        $('#mrp-rate').on('keyup',function(e){
            calculatePrice();
        });

        $('#sale-quantity').on('keyup',function(e){
            calculatePrice();
        });

        $('#disc-per').on('keyup',function(e){
           let percent = $(this).val();
           let totalAmount = $('#total-amount').val();
           let discAmount = ((Number(percent)*Number(totalAmount))/100).toFixed(2);
           $('#disc-amt').val(discAmount);
           calculatePrice();
        });
        $('#disc-amt').on('keyup',function(e){
            let amt = $(this).val();
           let totalAmount = $('#total-amount').val();
           let discPercent= ((Number(amt)/Number(totalAmount))*100).toFixed(2);
           $('#disc-per').val(discPercent);
           calculatePrice();
        });


         $('#stock-quantity').on('keyup',function(e){
            let currentStock =  $("#current-stock").attr("data-current-stock");
            let stockQuantity = $("#stock-quantity").val();
            $("#current-stock").val((Number(currentStock)+Number(stockQuantity)));
        });

        //Invoice Details Bill Calculation
        function calculateInvoiceDetails(id){

            console.log(id);

            // mrp_price
            // quantity
            // price
            // discount_percent
            // discount_amount
            // final_price

            let mrpRate = $('#mrp_price'+id).val();
            let saleQuantity = $('#quantity'+id).val();

            let totalAmount = (Number(mrpRate)*Number(saleQuantity)).toFixed(2);
            $('#price'+id).val(totalAmount);

            let discAmt = $('#discount_amount'+id).val();

            let payableAmount = (totalAmount - Number(discAmt)).toFixed(2);

            $('#final_price'+id).val(payableAmount);
        }

        
        function InvDetailsDisAmtCalc(id){

            let percent =  $('#discount_percent'+id).val();
            let totalAmount =  $('#price'+id).val();
            let discAmount = ((Number(percent)*Number(totalAmount))/100).toFixed(2);
            $('#discount_amount'+id).val(discAmount);
            calculateInvoiceDetails(id);
            
        }

        function InvDetailsDisPerCalc(id){

            let amt =  $('#discount_amount'+id).val();
            let totalAmount =  $('#price'+id).val();
            let discPercent = ((Number(amt)/Number(totalAmount))*100).toFixed(2);
            $('#discount_percent'+id).val(discPercent);
            calculateInvoiceDetails(id);

        }

        $("#bill-final-save").on('click',function(e){
            e.preventDefault();
            let invoice_no = $('#invoice_no').val();
            let billAmount =  $("#bill-amount").val();
            let discountAmount =  $("#bill-dis-amt").val();
            let discountPer =  $("#bill-in-per").val();
            let finalAmount =  $("#bill-total-amount").val();
            let paidAmount =  $("#bill-paid-amount").val();
            let dueAmount =  $("#bill-due-amount").val();
            if(invoice_no == "" || invoice_no == null || invoice_no == undefined){
                toastr.error('Please Enter Invoice No');
            }else{
                $.ajax({
                    type: 'put',
                    dataType: "json",
                    url: "{{ url('invoice') }}/"+invoice_no,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'total_amount':billAmount,
                        'discount_amount':discountAmount,
                        'discount_percent':discountPer,
                        'payable_amount':finalAmount,
                        'paid_amount':paidAmount,
                        'due_amount':dueAmount,
                    },
                    success: function (data) {
                        console.log(data);
                        $("#bill-final-save").hide();
                    }
                });
            }
        })
       

        //Sale Entry
        $("#add-btn").on('click',function(e){
            let invoice_no = $('#invoice_no').val();
            let product_name = $('#name').val();
            let product_id = $('#item-id').val();
            let expire_date = $('#expire-date').val();
            let mrp_rate = $('#mrp-rate').val();
            let quantity = $('#sale-quantity').val();
            let price = $('#total-amount').val();
            let discount_percent = $('#disc-per').val();
            let discount_amount = $('#disc-amt').val();
            let final_price = $('#payable-amount').val();
            if(expire_date == "" || expire_date == null || expire_date == undefined){
                toastr.error('Please Select Expire Date');
            }else if(invoice_no == "" || invoice_no == null || invoice_no == undefined){
                toastr.error('Please Enter Invoice No');
            }else if(quantity == "" || quantity == null || quantity == undefined || quantity == 0){
                toastr.error('Please Enter Quantity');
            }else{
                $.ajax({
                    type: 'post',
                    dataType: "json",
                    url: "{{url('sales')}}",
                    data:{
                        'invoice_id':invoice_no,
                        'product_name':product_name,
                        'product_id':product_id,
                        'expire_date':expire_date,
                        'quantity':quantity,
                        'mrp_rate':mrp_rate,
                        'price':price,
                        'discount_percent':discount_percent,
                        'discount_amount':discount_amount,
                        'final_price':final_price,
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (response) {
                        console.log(response);
                        $("#bill-dis-amt").val(response.invoice.discount_amount);
                        $("#bill-amount").val(response.invoice.total_amount);
                        $("#bill-paid-amount").val(response.invoice.paid_amount);
                        $("#bill-in-per").val(response.invoice.discount_percent);
                        $("#bill-total-amount").val(response.invoice.payable_amount);
                        $("#bill-due-amount").val(response.invoice.due_amount);
                        // toastr.success('Item Updated Successfully for '+response.success.name);
                          
                        let element = `<tr class="item-select" data-id="${response.invoice_details.id}">
                                <td>${response.invoice_details.product_name}</td>
                                <td>${response.invoice_details.expire_date}</td>
                                <td>
                                    <input class="form-control form-control-sm w-100" type="text" id="mrp_price${response.invoice_details.id}" name="mrp_price" value="${response.invoice_details.mrp_price}" readonly>
                                </td>
                                <td>
                                    <input class="form-control form-control-sm w-100 inv_dtls_qnty" type="text" id="quantity${response.invoice_details.id}" name="quantity" value="${response.invoice_details.quantity}">
                                </td>
                                <td>
                                    <input class="form-control form-control-sm w-100" type="text" id="price${response.invoice_details.id}" name="price" value="${response.invoice_details.price}" readonly>
                                </td><td>
                                    <input class="form-control form-control-sm w-100 disc-cal-per" type="text" id="discount_percent${response.invoice_details.id}" name="discount_percent" value="${response.invoice_details.discount_percent}">
                                </td><td>
                                    <input class="form-control form-control-sm w-100 disc-cal-amt" type="text" id="discount_amount${response.invoice_details.id}" name="discount_amount" value="${response.invoice_details.discount_amount}">
                                </td><td>
                                    <input class="form-control form-control-sm w-100" type="text" id="final_price${response.invoice_details.id}" name="final_price" value="${response.invoice_details.final_price}" readonly>
                                </td>
                                <td class="project-actions text-center">
                                    <a class="btn btn-info btn-sm update" data-id="${response.invoice_details.id}">
                                        <i style="font-size:10px;" class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a class="btn btn-danger btn-sm delete" href="#" data-id="${response.invoice_details.id}" data-toggle="modal" data-target="#modal-default">
                                        <i style="font-size:10px;" class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>`
                            $("#medecine-item-list").append(element);
                            $('.delete').off('click').on('click',function(e){
                                let id = $(this).attr('data-id');
                                deleteSaleEntry(id);
                            });
                            $('.update').off('click').on('click',function(e){
                                let id = $(this).attr('data-id');
                                updateSaleEntry(id);
                            });
                            $(".inv_dtls_qnty").off('keyup').on('keyup',function(e){ 
                                let id = $(this).closest("tr").attr('data-id');
                                calculateInvoiceDetails(id);
                            });
                            $(".disc-cal-per").off('keyup').on('keyup',function(e){
                                let id = $(this).closest("tr").attr('data-id');
                                InvDetailsDisAmtCalc(id);
                            });
                            $(".disc-cal-amt").off('keyup').on('keyup',function(e){
                                let id = $(this).closest("tr").attr('data-id');
                                InvDetailsDisPerCalc(id);
                            });

                    }
                });
            }
            console.log({
                'product_name':product_name,
                'product_id':product_id,
                'expire_date':expire_date,
                'quantity':quantity,
                'mrp_rate':mrp_rate,
                'price':price,
                'discount_percent':discount_percent,
                'discount_amount':discount_amount,
                'final_price':final_price});

        })


       
      

        $(function () {
           
            $('#birth_date').datetimepicker({
                format: 'YYYY-MM-DD',
            });

             $('#manufacture_date').datetimepicker({
                format: 'YYYY-MM-DD',
            });
        });


       

        function updateSaleEntry(id){
            console.log(id)
                let quantity = $('#quantity'+id).val();
                let price = $('#price'+id).val();
                let discount_percent = $('#discount_percent'+id).val();
                let discount_amount = $('#discount_amount'+id).val();
                let final_price = $('#final_price'+id).val();
                console.log({
                    'quantity':quantity,
                    'price':price,
                    'discount_percent':discount_percent,
                    'discount_amount':discount_amount,
                    'final_price':final_price,
                });
            $.ajax({
                type: 'put',
                dataType: "json",
                url: "{{ url('sales') }}/"+id,
                data:{
                    'quantity':quantity,
                    'price':price,
                    'discount_percent':discount_percent,
                    'discount_amount':discount_amount,
                    'final_price':final_price,
                    '_token': "{{ csrf_token() }}",
                },
                success: function (response) {
                    console.log(response);
                    toastr.success('Item Updated Successfully for '+response.invoice_details.product_name);
                    $('#quantity'+id).val(response.invoice_details.quantity);
                    $('#price'+id).val(response.invoice_details.price);
                    $('#discount_percent'+id).val(response.invoice_details.discount_percent);
                    $('#discount_amount'+id).val(response.invoice_details.discount_amount);
                    $('#final_price'+id).val(response.invoice_details.final_price);
                    $("#bill-dis-amt").val(response.invoice.discount_amount);
                    $("#bill-amount").val(response.invoice.total_amount);
                    $("#bill-paid-amount").val(response.invoice.paid_amount);
                    $("#bill-in-per").val(response.invoice.discount_percent);
                    $("#bill-total-amount").val(response.invoice.payable_amount);
                    $("#bill-due-amount").val(response.invoice.due_amount);
                }
            });
        }

        function deleteSaleEntry(id){
                $.ajax({
                    type: 'post',
                    url: "{{ url('sales') }}/" + id,
                    dataType: "json",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        '_method': 'DELETE'
                    },
                    success: function (response) {
                        console.log(response);

                        // Update fields
                        $("#bill-dis-amt").val(response.invoice.discount_amount);
                        $("#bill-amount").val(response.invoice.total_amount);
                        $("#bill-paid-amount").val(response.invoice.paid_amount);
                        $("#bill-in-per").val(response.invoice.discount_percent);
                        $("#bill-total-amount").val(response.invoice.payable_amount);
                        $("#bill-due-amount").val(response.invoice.due_amount);

                        // Remove row
                        $("#quantity" + id).closest("tr").remove();
                    },
                    error: function (xhr) {
                        console.error("Delete failed", xhr.responseText);
                        toastr.error("Something went wrong while deleting.");
                    }
                });
        }

        function finalBillCalculation(){
          let billAmount =  $("#bill-amount").val();
          let discountAmount =  $("#bill-dis-amt").val();
          let discountPer =  $("#bill-in-per").val();
          let finalAmount =  $("#bill-total-amount").val();
          let paidAmount =  $("#bill-paid-amount").val();
          let dueAmount =  $("#bill-due-amount").val();
          let newFinalAmount = billAmount;
          if((!isNaN(discountAmount)) && discountAmount != 0){
            newFinalAmount = (Number(billAmount)-Number(discountAmount)).toFixed(2);
          }
          if(!isNaN(paidAmount)){
            let newDueAmount = (Number(newFinalAmount)-Number(paidAmount)).toFixed(2);
            $("#bill-due-amount").val(newDueAmount);
          }
          $("#bill-total-amount").val(newFinalAmount);


        }
        $(".final-bill-field").on('keyup',function(){
            finalBillCalculation();
        });

        $("#bill-in-per").on('keyup',function(){
            let billAmount =  $("#bill-amount").val();
            let discountPer =  $(this).val();
            let amtValue = ((Number(discountPer)/100)*Number(billAmount)).toFixed(2);
            $("#bill-dis-amt").val(amtValue);
            finalBillCalculation();
        });

        


    });

</script>

@endpush