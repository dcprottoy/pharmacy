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
                            {{-- <div class="dropdown">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name='search_data' id="search_data" placeholder="Medicine Name">
                                </div>
                                <div class="dropdown-menu" style="max-height:350px;min-width:100%;overflow-y:scroll;" id="search_dropdown-menu" aria-labelledby="dLabel">
                                    
                                </div>
                            </div> --}}
                            <div class="form-group">
                                  <select class="form-control form-control-sm"  name="search_data" id="search_data">
                                        <option value="" selected disabled>Please select</option>
                                        {{-- @foreach ($store_locations as $item )
                                            <option value="{{$item->id}}">{{$item->name_eng}}</option>
                                        @endforeach --}}
                                  </select>
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
                    <form action="" method="post" enctype="multipart/form-data" id="new_item_add">
                    @csrf
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Medicine Name</label>
                                    <input type="text" class="form-control form-control-sm" name='name' id="name" placeholder="Product Name" readonly>
                                    <input type="hidden" id="item-id" name="item_id" value="">
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <label>Type</label>
                                    <input type="text" class="form-control form-control-sm" id="product_sub_category" name="product_sub_category" value="" readonly>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <label>MRP Rate</label>
                                    <input type="text" class="form-control form-control-sm" id="mrp-rate" name="mrp_rate" value="" readonly>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <label>TP Rate</label>
                                    <input type="text" class="form-control form-control-sm" id="tp-rate" name="tp_rate" value="" readonly>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <label>Current Stock</label>
                                    <input type="text" class="form-control form-control-sm" id="current-stock" name="current_stock" value=""  readonly>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <label>Sale Quantity</label>
                                    <input class="form-control form-control-sm w-100" type="text" id="sale-quantity" name="sale_quantity" value="0">
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <label>Total Amount</label>
                                    <input class="form-control form-control-sm w-100" type="text" id="total-amount" name="total_amount" value="0" readonly>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <label>Discount Per</label>
                                    <input class="form-control form-control-sm w-100" type="text" id="disc-per" name="disc_per" value="0">
                                </div>
                            </div><div class="col-sm-1">
                                <div class="form-group">
                                    <label>Discount Amount</label>
                                    <input class="form-control form-control-sm w-100" type="text" id="disc-amt" name="disc_amt" value="0">
                                </div>
                            </div><div class="col-sm-1">
                                <div class="form-group">
                                    <label>Payable Amount</label>
                                    <input class="form-control form-control-sm w-100" type="text" id="payable-amount" name="payable_amount" value="0" readonly>
                                </div>
                            </div>
                            <div class="col-sm-1 p-2">
                                <br>
                                <button type="submit" class="btn btn-sm btn-success float-left" id="add-btn">&nbsp;Add&nbsp;</button>

                                <button type="reset" class="btn btn-sm btn-danger float-right">&nbsp;Clear&nbsp;</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" id="final_bill_submit" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="search-list" style="font-size:14px;">
                                    <table class="table table-sm">
                                        <thead>
                                            <th style="width:20%;">Product Name</th>
                                            <th style="width:10%;">Product Type</th>
                                            <th style="width:10%;">MRP Price</th>
                                            <th style="width:10%;">Quantity</th>
                                            <th style="width:10%;">Total Price</th>
                                            <th style="width:10%;">Discount Percent</th>
                                            <th style="width:10%;">Discount Amount</th>
                                            <th style="width:10%;">Final Price</th>
                                            <th style="width:10%; text-align: center;">Action</th>
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
                $('#search_data').select2({
                        placeholder: 'Search for a Product',
                        minimumInputLength: 2,
                        ajax: {
                            type: 'PUT',
                            url: "{{ url('medecine') }}",
                            dataType: 'json',
                            delay: 250,
                            cache: true,
                            data: function (params) {
                                return {
                                    search: params.term,
                                    match: $('input[name="match"]:checked').val(),
                                    _token: "{{ csrf_token() }}"
                                };
                            },
                            processResults: function (data) {
                                return {
                                    results: data.map(item => ({
                                        id: item.id,
                                        text: item.name,
                                        manufacturer: item.manufacturer,
                                        type: item.product_sub_category,
                                        generic: item.generic,
                                    }))
                                };
                            }
                        },
                        templateResult: function (data) {
                            if (!data.id) return data.text;
                            return $(`
                                <div>
                                    <strong>${data.text}</strong><br>
                                    Manufacturer: ${data.manufacturer} | Type: ${data.type} | Generic: ${data.generic}
                                </div>
                            `);
                        },

                        templateSelection: function (data) {
                            if (!data.id) return data.text;
                            return `${data.text} (${data.type})`;
                        }
                    });


                
                $('#stock_location').select2('open');
                setTimeout(function() {
                    $('#search_data').select2('open');
                }, 200);

                $('#search_data').on('select2:open', function () {
                    let searchField = document.querySelector('.select2-container--open .select2-search__field');
                    if (searchField) {
                        searchField.focus();
                    }
                });

            // setTimeout(() => {
            //     $('#search_data').select2('close');
            // }, 5000);





        $('#search_data').focus();
        //Calculate Final Bill
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

        //Calculate bill
        function calculateBill(){
            let amtResult = 0;
            let discResult = 0;
                $(".billing-item-amount").each(function(){
                    amtResult += Number($(this).val());
                });
                console.log(amtResult);
                $(".billing-item-dis-amt").each(function(){

                    discResult += Number($(this).val());
                });
                $("#bill-amount").val(amtResult);
                $("#bill-dis-amt").val(discResult);
                finalBillCalculation();
        }

        
        
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
                        $("#product_sub_category").val(result.item.product_sub_category);
                        $("#stock-location").val(result.item.stock_location);
                        $("#mrp-rate").val(result.item.mrp_rate);
                        $("#tp-rate").val(result.item.tp_rate);
                        $("#stock_per").val(result.item.stock_per);
                        $("#current-stock").val(result.item.current_stock);
                        $("#current-stock").attr("data-current-stock",result.item.current_stock);
                        $("#sale-quantity").val("");
                        $("#total-amount").val(0);
                        $("#disc-per").val(0);
                        $("#disc-amt").val(0);
                        $("#payable-amount").val(0);
                        $("#sale-quantity").focus();
                        }
                        console.log(result);
                        

                    }
                });

        }

       
        //Sale Entry Portion Calculation

        function calculatePrice(){
            let mrpRate = $('#mrp-rate').val();
            let saleQuantity = $('#sale-quantity').val();

            let totalAmount = (Number(mrpRate)*Number(saleQuantity)).toFixed(2);
            $('#total-amount').val(totalAmount);

            let discAmt = $('#disc-amt').val();

            let payableAmount = (totalAmount - Number(discAmt)).toFixed(2);

            $('#payable-amount').val(payableAmount);
            calculateBill()
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
            let mrpRate = $('#mrp_price'+id).val();
            let saleQuantity = $('#quantity'+id).val();
            let totalAmount = (Number(mrpRate)*Number(saleQuantity)).toFixed(2);
            $('#price'+id).val(totalAmount);
            let discAmt = $('#discount_amount'+id).val();
            let payableAmount = (totalAmount - Number(discAmt)).toFixed(2);
            $('#final_price'+id).val(payableAmount);
            calculateBill();
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

        $("#final_bill_submit").on('submit',function(e){
            e.preventDefault();
            let formData = $(this).serialize();
            formData += '&customer_name=' + encodeURIComponent($('#customer_name').val());
            formData += '&contact_no=' + encodeURIComponent($('#contact_no').val());
            $.ajax({
                type: 'post',
                dataType: "json",
                url: "{{ url('sales') }}",
                data: formData,
                success: function (data) {
                    console.log(data);
                }
            });
        })
       $('#search_data').on('select2:select', function (e) {
            let data = $(this).val();
            setItem(data);
       });

        //Sale Entry
        $("#new_item_add").on('submit',function(e){
            e.preventDefault();
            let product_name = $('#name').val();
            let product_id = $('#item-id').val();
            let product_sub_category = $('#product_sub_category').val();
            let mrp_rate = $('#mrp-rate').val();
            let quantity = $('#sale-quantity').val();
            let price = $('#total-amount').val();
            let discount_percent = $('#disc-per').val();
            let discount_amount = $('#disc-amt').val();
            let final_price = $('#payable-amount').val();
            if(quantity == "" || quantity == null || quantity == undefined || quantity == 0){
                toastr.error('Please Enter Quantity');
            }else{
                let id = product_id;
                let element = `<tr class="item-select" data-id="${id}">
                        <td>
                            ${product_name}
                            <input type="hidden" id="item-id${id}" name="item_id[]" value="${id}">
                        </td>
                        <td>
                            <input class="form-control form-control-sm w-100" type="text" id="product_sub_category${id}" name="product_sub_category[${id}]" value="${product_sub_category}" readonly>
                        </td>
                        <td>
                            <input class="form-control form-control-sm w-100" type="text" id="mrp_price${id}" name="mrp_price[${id}]" value="${mrp_rate}" readonly>
                        </td>
                        <td>
                            <input class="form-control form-control-sm w-100 inv_dtls_qnty" type="text" id="quantity${id}" name="quantity[${id}]" value="${quantity}">
                        </td>
                        <td>
                            <input class="form-control form-control-sm w-100 billing-item-amount" type="text" id="price${id}" name="price[${id}]" value="${price}" readonly>
                        </td><td>
                            <input class="form-control form-control-sm w-100 disc-cal-per" type="text" id="discount_percent${id}" name="discount_percent[${id}]" value="${discount_percent}">
                        </td><td>
                            <input class="form-control form-control-sm w-100 disc-cal-amt billing-item-dis-amt " type="text" id="discount_amount${id}" name="discount_amount[${id}]" value="${discount_amount}">
                        </td><td>
                            <input class="form-control form-control-sm w-100" type="text" id="final_price${id}" name="final_price[${id}]" value="${final_price}" readonly>
                        </td>
                        <td class="project-actions text-center">
                            <a class="btn btn-danger btn-sm delete" href="#" data-id="${id}" data-toggle="modal" data-target="#modal-default">
                                <i style="font-size:10px;" class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>`
                $("#medecine-item-list").append(element);
                        
            }
            $("#new_item_add")[0].reset();
            $('#search_data').select2('open');
            $("#search_data").val('').trigger('change');
            let searchField = document.querySelector('.select2-container--open .select2-search__field');
            if (searchField) {
                searchField.focus();
            }
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
            $('.delete').off('click').on('click',function(e){
                $(this).closest("tr").remove();
                calculateBill();

                
            });
            calculateBill();
            console.log({
                'product_name':product_name,
                'product_id':product_id,
                'quantity':quantity,
                'mrp_rate':mrp_rate,
                'price':price,
                'discount_percent':discount_percent,
                'discount_amount':discount_amount,
                'final_price':final_price});

        })


       $(document).on('keydown', function(e) {
                const tag = $(e.target).prop("tagName").toLowerCase();

                // Avoid triggering inside input/textarea
                // if (tag === 'input' || tag === 'textarea') return;

                // Ctrl + F to focus payment field
                if (e.ctrlKey && e.shiftKey && e.key.toLowerCase() === 'f') {
                    e.preventDefault();
                    $('#search_data').select2('open');
                    $("#search_data").val('');
                    let searchField = document.querySelector('.select2-container--open .select2-search__field');
                    if (searchField) {
                        searchField.focus();
                    }
                }

                // Ctrl + C to focus contact field
                if (e.ctrlKey && e.key.toLowerCase() === 'p') {
                    e.preventDefault();
                    $('#bill-paid-amount').val("");
                    $('#bill-paid-amount').focus();
                }

                if (e.ctrlKey && e.key.toLowerCase() === 'd') {
                    e.preventDefault();
                    $('#bill-dis-amt').val("");
                    $('#bill-dis-amt').focus();
                }

                if (e.ctrlKey && e.shiftKey && e.key.toLowerCase() === 'c') {
                    e.preventDefault();
                    $('#customer_name').focus();
                }
            });
      

            $(function () {
            
                $('#birth_date').datetimepicker({
                    format: 'YYYY-MM-DD',
                });

                $('#manufacture_date').datetimepicker({
                    format: 'YYYY-MM-DD',
                });
            });


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