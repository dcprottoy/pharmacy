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
    <x-breadcumb title="Sales Entry Approve"/>
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
                                        <input type="text" class="form-control form-control-sm" name='invoice_no' id="invoice_no" placeholder="Invoice No" value="{{$invoice->invoice_no}}" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Customer </label>
                                        <input type="text" class="form-control form-control-sm" name='customer_name' id="customer_name" value="{{@$invoice->customer_name}}" placeholder="Customer Name">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Contact No.</label>
                                        <input type="text" class="form-control form-control-sm" name='contact_no' id="contact_no" value="{{@$invoice->contact_no}}" placeholder="Contact No">
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                               
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
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="search-list" style="font-size:14px;">
                                <table class="table table-sm">
                                    <thead>
                                        <thead>
                                            <th style="width:20%;">Product Name</th>
                                            <th style="width:10%;">Product Type</th>
                                            <th style="width:10%;">MRP Price</th>
                                            <th style="width:10%;">Quantity</th>
                                            <th style="width:10%;">Total Price</th>
                                            <th style="width:10%;">Discount Percent</th>
                                            <th style="width:10%;">Discount Amount</th>
                                            <th style="width:10%;">Final Price</th>
                                            {{-- <th style="width:10%; text-align: center;">Action</th> --}}
                                        </thead>
                                    </thead>
                                    <tbody class="bill-item-list-cl" id="medecine-item-list">
                                        @php
                                            // dd($invoice_detals);
                                        @endphp
                                        @foreach ($invoice_detals as $key => $value )
                                            <tr class="item-select" data-id="${id}">
                                                <td>
                                                    {{$value->product_name}}
                                                </td>
                                                <td>
                                                    <input class="form-control form-control-sm w-100" type="text" id="product_sub_category${id}" name="product_sub_category[${id}]" value="${product_sub_category}" readonly>
                                                </td>
                                                <td>
                                                    <input class="form-control form-control-sm w-100" type="text" id="mrp_price${id}" name="mrp_price[${id}]" value="${mrp_rate}" readonly>
                                                </td>
                                                <td>
                                                    <input class="form-control form-control-sm w-100 inv_dtls_qnty" type="text" id="quantity${id}" data-current-stock="${currentQty}" name="quantity[${id}]" value="${quantity}">
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
                                                {{-- <td class="project-actions text-center">
                                                    <a class="btn btn-danger btn-sm delete" href="#" data-id="${id}" data-toggle="modal" data-target="#modal-default">
                                                        <i style="font-size:10px;" class="fas fa-trash"></i>
                                                    </a>
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                        
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
                                {{-- <div class="card-footer text-right">
                                    <button type="reset" class="btn btn-sm btn-danger float-left">&nbsp;Clear&nbsp;</button>
                                    <button type="submit" class="btn btn-sm btn-success" id="bill-final-save">&nbsp;Save&nbsp;</button>
                                </div> --}}
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

        //Add New Mrr No.
        $("#mrr_create_new").on('click',function(){
            $("#mrr_no").val("");
            $("#supplier_name").val("");
            $("#challan_no").val("");
            $("#add-new-mrr").show();
        });
        //Save New Mrr No.
        $("#update-mrr").on('click',function(){
            let mrr_id = $("#mrr_no").val();
            let supplier_name = $("#supplier_name").val();
            let challan_no = $("#challan_no").val();
            let bill_amount = $("#bill_amount").val();
            let paid_amount = $("#paid_amount").val();
            let due_amount = $("#due_amount").val();
            $.ajax({
                type: 'post',
                dataType: "json",
                url: "{{url('stockapprove')}}",
                data:{
                    '_token': '{{ csrf_token() }}',
                    'mrr_id' : mrr_id,
                    'supplier_name' : supplier_name,
                    'challan_no' : challan_no,
                    'bill_amount' : bill_amount,
                    'paid_amount' : paid_amount,
                    'due_amount' : due_amount,
                    'type' : 'update'
                },
                success: function (response) {
                    console.log(response);
                    
                    toastr.success('MRR Created Successfully');
                    location.reload(); 
                  

                }
            });
        });
        //Save Approve Mrr
        $("#approve_mrr").on('click',function(){
            let mrr_id = $("#mrr_no").val();
            let supplier_name = $("#supplier_name").val();
            let challan_no = $("#challan_no").val();
            let bill_amount = $("#bill_amount").val();
            let paid_amount = $("#paid_amount").val();
            let due_amount = $("#due_amount").val();
            $.ajax({
                type: 'post',
                dataType: "json",
                url: "{{url('stockapprove')}}",
                data:{
                    '_token': '{{ csrf_token() }}',
                    'mrr_id' : mrr_id,
                    'supplier_name' : supplier_name,
                    'challan_no' : challan_no,
                    'bill_amount' : bill_amount,
                    'paid_amount' : paid_amount,
                    'due_amount' : due_amount,
                    'type' : 'approve'
                },
                success: function (response) {
                    console.log(response);
                    toastr.success('MRR Created Successfully');
                  location.reload(); 

                }
            });
        });//Save Not Approve Mrr
        $("#not_approve_mrr").on('click',function(){
            let mrr_id = $("#mrr_no").val();
            let supplier_name = $("#supplier_name").val();
            let challan_no = $("#challan_no").val();
            let bill_amount = $("#bill_amount").val();
            let paid_amount = $("#paid_amount").val();
            let due_amount = $("#due_amount").val();
            $.ajax({
                type: 'post',
                dataType: "json",
                url: "{{url('stockapprove')}}",
                data:{
                    '_token': '{{ csrf_token() }}',
                    'mrr_id' : mrr_id,
                    'supplier_name' : supplier_name,
                    'challan_no' : challan_no,
                    'bill_amount' : bill_amount,
                    'paid_amount' : paid_amount,
                    'due_amount' : due_amount,
                    'type' : 'not_approve'
                },
                success: function (response) {
                
                    toastr.success('MRR Created Successfully');
                  
                    location.reload(); 
                }
            });
        });//Save New Mrr No.
        $("#not_done_mrr").on('click',function(){
            let mrr_id = $("#mrr_no").val();
            let supplier_name = $("#supplier_name").val();
            let challan_no = $("#challan_no").val();
            let bill_amount = $("#bill_amount").val();
            let paid_amount = $("#paid_amount").val();
            let due_amount = $("#due_amount").val();
            $.ajax({
                type: 'post',
                dataType: "json",
                url: "{{url('stockapprove')}}",
                data:{
                    '_token': '{{ csrf_token() }}',
                    'mrr_id' : mrr_id,
                    'supplier_name' : supplier_name,
                    'challan_no' : challan_no,
                    'bill_amount' : bill_amount,
                    'paid_amount' : paid_amount,
                    'due_amount' : due_amount,
                    'type' : 'not_done_mrr'

                },
                success: function (response) {
                    console.log(response);
                   
                    toastr.success('MRR Created Successfully');
                  
                    location.reload(); 
                }
            });
        });//Save New Mrr No.
        $("#done_mrr").on('click',function(){
            let mrr_id = $("#mrr_no").val();
            let supplier_name = $("#supplier_name").val();
            let challan_no = $("#challan_no").val();
            let bill_amount = $("#bill_amount").val();
            let paid_amount = $("#paid_amount").val();
            let due_amount = $("#due_amount").val();
            $.ajax({
                type: 'post',
                dataType: "json",
                url: "{{url('stockapprove')}}",
                data:{
                    '_token': '{{ csrf_token() }}',
                    'mrr_id' : mrr_id,
                    'supplier_name' : supplier_name,
                    'challan_no' : challan_no,
                    'bill_amount' : bill_amount,
                    'paid_amount' : paid_amount,
                    'due_amount' : due_amount,
                    'type' : 'done_mrr'
                },
                success: function (response) {
                    console.log(response);
                   
                    toastr.success('MRR Created Successfully');
                  location.reload(); 

                }
            });
        });
        //Supplier Search And Select
        $("#supplier_name").on('keyup',function(){
                var value = $(this).val().toLowerCase();
                let result = false;
                $("#suuplier-dropdown-menu li").filter(function() {
                    if(!result) result = $(this).text().toLowerCase().indexOf(value) > -1;
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
                console.log(result);
                if(result) $("#suuplier-dropdown-menu").show();
                else $("#suuplier-dropdown-menu").hide();

                $('#suuplier-dropdown-menu li').on('mouseenter', function() {
                    $(this).css('background-color', 'lightgreen');
                });

                $('#suuplier-dropdown-menu li').on('mouseleave', function() {
                    $(this).css('background-color', 'white');
                });

        })
        $("#suuplier-dropdown-menu li").on('click',function(e){
            $("#supplier_name").val($(this).text());
            $("#suuplier-dropdown-menu").hide();
        })
        $("#supplier_name").on('focusout',function(){
            $("#suuplier-dropdown-menu").fadeOut()
        })
        $("#supplier_name").on('focusin',function(){
            var value = $(this).val().toLowerCase();
            let result = false;
            $("#suuplier-dropdown-menu li").filter(function() {
                if(!result) result = $(this).text().toLowerCase().indexOf(value) > -1;
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
            console.log(result);
            if(result) $("#suuplier-dropdown-menu").show();
            else $("#suuplier-dropdown-menu").hide();

            $('#suuplier-dropdown-menu li').on('mouseenter', function() {
                $(this).css('background-color', 'lightgreen');
            });

            $('#suuplier-dropdown-menu li').on('mouseleave', function() {
                $(this).css('background-color', 'white');
            });
        })
        //Search Mrr No. & Select

        $("#mrr_no_search").on('keyup',function(){
            var value = $(this).val().toLowerCase();
            console.log("Prottoy");
            $.ajax({
                    type: 'put',
                    dataType: "json",
                    url: "{{url('mrr')}}/",
                    data:{
                        'search':value,
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (result) {
                        console.log(result);
                        let element = "";
                        result.forEach(x =>{
                                element += `<a class="dropdown-item" href="{{url('stockapprove/')}}" >${x.mrr_id}</a>`;
                        });
                        $("#mrr_dropdown-menu").empty();
                        $("#mrr_dropdown-menu").append(element);
                        $('#mrr_dropdown-menu li').on('mouseenter', function() {
                            $(this).css('background-color', 'lightgreen');
                        });

                        $('#mrr_dropdown-menu li').on('mouseleave', function() {
                            $(this).css('background-color', 'white');
                        });
                    }
                });
            $("#mrr_dropdown-menu").show();
         })
         
        
        $("#mrr_dropdown-menu li").on('click',function(e){
            $("#mrr_no_search").val('');
            let mrr_no = $(this).text();
            $.ajax({
                type: 'get',
                dataType: "json",
                url: "{{url('mrr')}}/"+mrr_no,
                success: function (result) {
                    console.log(result);
                    
                }
            });

            
            $("#mrr_dropdown-menu").hide();
        });
        $("#mrr_no_search").on('focusout',function(){
            $("#mrr_dropdown-menu").fadeOut()
        })
        $("#mrr_no_search").on('focusin',function(){
            var value = $(this).val().toLowerCase();
            let result = false;
            $("#mrr_dropdown-menu li").filter(function() {
                if(!result) result = $(this).text().toLowerCase().indexOf(value) > -1;
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
            console.log(result);
            if(result) $("#mrr_dropdown-menu").show();
            else $("#mrr_dropdown-menu").hide();

            $('#mrr_dropdown-menu li').on('mouseenter', function() {
                $(this).css('background-color', 'lightgreen');
            });

            $('#mrr_dropdown-menu li').on('mouseleave', function() {
                $(this).css('background-color', 'white');
            });
        
        })

        //Registerd Medicine Search

        function setItem(id){
            console.log(id);
            $.ajax({
                    type: 'get',
                    dataType: "json",
                    url: "{{url('medecine')}}/"+id,
                    success: function (result) {
                        console.log(result);
                        $("#item-id").val(result.id);
                        $("#name").val(result.name);
                        $("#mrp-rate").val(result.mrp_rate);
                        $("#tp-rate").val(result.tp_rate);
                        $("#stock_per").val(result.stock_per);
                        $("#current-stock").val(result.current_stock);
                        $("#current-stock").attr("data-current-stock",result.current_stock);
                        $("#expire-date").val("");
                        $("#stock-quantity").focus();
                        // Step 1: Set default value from response
                        let defaultMedicine = {
                            'id': result.stock_location_id,       // e.g., 5
                            'text': result.stock_location         // e.g., "Main Store"
                        };

                        // Step 2: Create and add the option dynamically
                        let newOption = new Option(defaultMedicine.text, defaultMedicine.id, true, true);
                        $('#stock_location').append(newOption).trigger('change');
                        // console.log($('#stock_location'));


                    }
                });

        }


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
        //New Medicine Search
        $("#search_new_data").on('keyup',function(){
            var value = $(this).val().toLowerCase();
            console.log("Prottoy");
            if((value != '') &&( value.length >= 3)){
                $.ajax({
                    type: 'put',
                    dataType: "json",
                    url: "{{url('medicinefrombank')}}/",
                    data:{
                        'search':value,
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (result) {
                        console.log(result);
                        let element = "";
                        result.forEach(x =>{
                                element += `<li class="dropdown-item grid-container text-left">
                                                <b data-id="${x.id}">${x.name}</b>
                                                <span>${x.product_sub_category}</span>
                                                <span>${x.manufacturer}</span>
                                                <span>${x.strength}</span>
                                            </li>`;
                        });
                        $("#search_new_dropdown-menu").empty();
                        $("#search_new_dropdown-menu").append(element);
                        $("#search_new_dropdown-menu li").on('click',function(e){
                        $("#search_new_data").val($(this).children('b').text());
                            let item_id = $(this).children('b').attr("data-id");
                            
                            $.ajax({
                                type: 'get',
                                dataType: "json",
                                url: "{{url('medicineinfobank')}}/"+item_id,
                                success: function (result) {
                                    console.log(result);
                                    $("#item_name").val(result.name);
                                    $("#manufacturer").val(result.manufacturer);
                                    $("#generic").val(result.generic);
                                    $("#strength").val(result.strength);
                                    $("#product_category_id").val(result.product_category_id);
                                    $("#product_sub_category_id").val(result.product_sub_category_id);
                                    $("#medicine_use_for_id").val(result.medicine_use_for_id);
                                }
                            });

                            $("#search_new_dropdown-menu").hide();
                        });
                        $('#search_new_dropdown-menu li').on('mouseenter', function() {
                            $(this).css('background-color', 'lightgreen');
                        });

                        $('#search_new_dropdown-menu li').on('mouseleave', function() {
                            $(this).css('background-color', 'white');
                        });
                    }
                });
            }
            $("#search_new_dropdown-menu").show();
            
        })
        $("#search_new_dropdown-menu li").on('click',function(e){
            $("#mrr_no_search").val($(this).text());
            $("#search_new_dropdown-menu").hide();
        })
        $("#search_new_data").on('focusout',function(){
            $("#search_new_dropdown-menu").fadeOut()
        })
        $("#search_new_data").on('focusin',function(){
            var value = $(this).val().toLowerCase();
            $("#search_new_dropdown-menu").show();

            $('#search_new_dropdown-menu li').on('mouseenter', function() {
                $(this).css('background-color', 'lightgreen');
            });

            $('#search_new_dropdown-menu li').on('mouseleave', function() {
                $(this).css('background-color', 'white');
            });
        })
        //Manufacturer Search Data
        $("#manufacturer").on('keyup',function(){
            var value = $(this).val().toLowerCase();
            let result = false;
            $("#dropdown-menu li").filter(function() {
                if(!result) result = $(this).text().toLowerCase().indexOf(value) > -1;
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
            console.log(result);
            if(result) $("#dropdown-menu").show();
            else $("#dropdown-menu").hide();

            $('#dropdown-menu li').on('mouseenter', function() {
                $(this).css('background-color', 'lightgreen');
            });

            $('#dropdown-menu li').on('mouseleave', function() {
                $(this).css('background-color', 'white');
            });

        })

        $("#dropdown-menu li").on('click',function(e){
            $("#manufacturer").val($(this).text());
            $("#dropdown-menu").hide();
        })
        $("#manufacturer").on('focusout',function(){
            $("#dropdown-menu").fadeOut()
        })
        $("#manufacturer").on('focusin',function(){
            var value = $(this).val().toLowerCase();
            let result = false;
            $("#dropdown-menu li").filter(function() {
                if(!result) result = $(this).text().toLowerCase().indexOf(value) > -1;
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
            console.log(result);
            if(result) $("#dropdown-menu").show();
            else $("#dropdown-menu").hide();

            $('#dropdown-menu li').on('mouseenter', function() {
                $(this).css('background-color', 'lightgreen');
            });

            $('#dropdown-menu li').on('mouseleave', function() {
                $(this).css('background-color', 'white');
            });
        })


        $(function () {
           
            $('#birth_date').datetimepicker({
                format: 'YYYY-MM-DD',
            });

             $('#manufacture_date').datetimepicker({
                format: 'YYYY-MM-DD',
            });
        });


        $('#stock-quantity').on('keyup',function(e){
            let currentStock =  $("#current-stock").attr("data-current-stock");
            let stockQuantity = $("#stock-quantity").val();
            $("#current-stock").val((Number(currentStock)+Number(stockQuantity)));
        });

        function updateStockEntry(id){
            let stock_qty = $("#stock_qty"+id).val();
            let mfg_date = $("#mfg_date"+id).val();
            let expire_date = $("#expire_date"+id).val();
            $.ajax({
                type: 'put',
                dataType: "json",
                url: "{{url('stockentry')}}/"+id,
                data:{
                    'stock_qty':stock_qty,
                    'mfg_date':mfg_date,
                    'expire_date':expire_date,
                    '_token': "{{ csrf_token() }}",
                },
                success: function (response) {
                    if('error' in response){
                            toastr.error(response.error);
                        }else{
                        console.log(response);
                        toastr.success('Item Updated Successfully for '+response.success.name);
                        $("#item-id").val(response.success.id);
                        $("#name").val(response.success.name);
                        $("#stock-location").val(response.success.stock_location);
                        $("#mrp-rate").val(response.success.mrp_rate);
                        $("#tp-rate").val(response.success.tp_rate);
                        $("#stock_per").val(response.success.stock_per);
                        $("#current-stock").val(response.success.current_stock);
                        $("#current-stock").attr("data-current-stock",response.success.current_stock);
                        $("#stock-quantity").val(0);
                        $("#expire-date").val("");
                        $("#manufacture-date").val("");
                        $("#stock_qty"+id).val(response.expiry_log.stock_qty);
                        $("mfg_date"+id).val(response.expiry_log.manufacture_date);
                        $("#expire_date"+id).val(response.expiry_log.expiry_date);
                    }
                }
            });
        }

        function deleteStockEntry(id){
                $.ajax({
                    type: 'post',
                    url: "{{ url('stockentry') }}/" + id,
                    dataType: "json",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        '_method': 'DELETE'
                    },
                    success: function (response) {
                        console.log(response);
                        if('error' in response){
                            toastr.error(response.error);
                        }else{
                            toastr.success('Item Deleted Successfully for ' + response.success.name);

                        // Update fields
                        $("#item-id").val(response.success.id);
                        $("#name").val(response.success.name);
                        $("#stock-location").val(response.success.stock_location);
                        $("#mrp-rate").val(response.success.mrp_rate);
                        $("#tp-rate").val(response.success.tp_rate);
                        $("#stock_per").val(response.success.stock_per);
                        $("#current-stock").val(response.success.current_stock);
                        $("#current-stock").attr("data-current-stock", response.success.current_stock);

                        // Remove row
                        $("#stock_qty" + id).closest("tr").remove();
                        }
                        
                    },
                    error: function (xhr) {
                        console.error("Delete failed", xhr.responseText);
                        toastr.error("Something went wrong while deleting.");
                    }
                });
        }

        
        $("#save-btn").on("click",function(e){
            console.log("Prottoy");
            let mrrId = $("#mrr_no").val();
            console.log(typeof(mrrId));
            if(mrrId != null & mrrId != undefined && mrrId != ""){
                let itemId = $("#item-id").val();
                let name = $("#name").val();
                let stockCell = $("#stock_location").val();
                let mrpRate = $("#mrp-rate").val();
                let tpRate = $("#tp-rate").val();
                let stockPer = $("#stock_per").val();
                let currentStock = $("#current-stock").val();
                let stockQuantity = $("#stock-quantity").val();
                let expireDate = $("#expire-date").val();
                let manufactureDate = $("#manufacture-date").val();
                console.log({expireDate,manufactureDate});
                if(itemId == null || itemId == undefined || itemId == ""){
                    toastr.error("Please Select Item");
                }else if(stockQuantity == null || stockQuantity == undefined || stockQuantity == "" || stockQuantity == 0){
                    toastr.error("Please Enter Stock Quantity");
                }else if(expireDate == null || expireDate == undefined || expireDate == ""){
                    toastr.error("Please Enter Expire Date");
                }else if(manufactureDate == null || manufactureDate == undefined || manufactureDate == ""){
                    toastr.error("Please Enter Manufacture Date");
                }else{
                    $.ajax({
                        type: 'post',
                        dataType: "json",
                        url: "{{url('stockentry')}}",
                        data:{
                            'item_id':itemId,
                            'mrr_id':mrrId,
                            'name':name,
                            'stock_location_id':stockCell,
                            'mrp_rate':mrpRate,
                            'tp_rate':tpRate,
                            'stock_per':stockPer,
                            'current_stock':currentStock,
                            'stock_quantity':stockQuantity,
                            'expire_date':expireDate,
                            'manufacture_date':manufactureDate,
                            '_token': '{{ csrf_token() }}',
                        },
                        success: function (response) {
                            console.log(response);
                            if('error' in response){
                                toastr.error(response.error);
                            }else{
                                let stock_loc_element = `<option value="${response.success.stock_location_id}">${response.success.stock_location}</option>`
                                toastr.success('Item Updated Successfully for '+response.success.name);
                                $("#item-id").val(response.success.id);
                                $("#name").val(response.success.name);
                                $("#mrp-rate").val(response.success.mrp_rate);
                                $("#tp-rate").val(response.success.tp_rate);
                                $("#stock_per").val(response.success.stock_per);
                                $("#current-stock").val(response.success.current_stock);
                                $("#current-stock").attr("data-current-stock",response.success.current_stock);
                                $("#stock-quantity").val(0);
                                $("#expire-date").val("");
                                $("#manufacture-date").val("");

                                // Step 1: Set default value from response
                                let defaultMedicine = {
                                    'id': response.success.stock_location_id,       // e.g., 5
                                    'text': response.success.stock_location         // e.g., "Main Store"
                                };

                                // Step 2: Create and add the option dynamically
                                let newOption = new Option(defaultMedicine.text, defaultMedicine.id, true, true);
                                $('#stock_location').append(newOption).trigger('change');
                                // console.log($('#stock_location'));

                                let element = `<tr class="item-select" data-medicine-id="${response.expiry_log.medecine_id}" data-id="${response.expiry_log.id}">
                                            <td>${response.success.name}</td>
                                            <td>${response.expiry_log.manufacture_date}</td>
                                            <td>${response.expiry_log.expiry_date}</td>
                                            <td>
                                                <input class="form-control form-control-sm w-100" type="text" id="stock_qty${response.expiry_log.id}"" name="stock_per" value="${response.expiry_log.stock_qty}">
                                            </td>
                                            <td class="project-actions text-center">
                                                <a class="btn btn-info btn-sm update" data-id="${response.expiry_log.id}">
                                                    <i style="font-size:10px;" class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a class="btn btn-danger btn-sm delete" href="#" data-id="${response.expiry_log.id}" data-toggle="modal" data-target="#modal-default">
                                                    <i style="font-size:10px;" class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>`
                                $("#medecine-item-list").append(element);
                                $('.update').off('click').on('click',function(e){
                                    let id = $(this).attr('data-id');
                                    updateStockEntry(id);
                                })
                                $('.delete').off('click').on('click',function(e){
                                    let id = $(this).attr('data-id');
                                    deleteStockEntry(id);
                                })
                            }
                            

                        }
                    });
                }
                


            }else{
                toastr.error('Must Have Mrr Number');
            }
        
        });

        $("#done-mrr").on('click',function(e){
             let mrrId = $("#mrr_no").val();
            if(mrrId != null & mrrId != undefined && mrrId != ""){
                 $.ajax({
                        type: 'put',
                        dataType: "json",
                        url: "{{url('mrr')}}/"+mrrId,
                        data:{
                            'approved':1,
                            '_token': '{{ csrf_token() }}',
                        },
                        success: function (result) {
                                    console.log(result);
                                    $("#mrr_no").val(result.mrr.mrr_id);
                                    $("#supplier_name").val(result.mrr.supplier_name);
                                    $("#challan_no").val(result.mrr.challan_no);
                                    $("#medecine-item-list").empty();

                                    let element = "";
                                    result.stock.forEach(x=>{
                                            element += `<tr class="item-select" data-medicine-id="${x.medecine_id}" data-id="${x.id}">
                                                    <td>${x.name}</td>
                                                    <td>${x.manufacture_date}</td>
                                                    <td>${x.expiry_date}</td>
                                                    <td>
                                                       ${x.stock_qty}
                                                    </td>
                                                    <td class="project-actions text-center">
                                                        <span style:"text-color:red;">Not Changable</span>
                                                    </td>
                                                </tr>`
                                        
                                        })
                                        $("#medecine-item-list").append(element);
                                        $(".item-select").off('click').on('click',function(e){
                                            let id = $(this).attr('data-medicine-id');
                                            setItem(id);
                                        });

                                    $("#mrr_dropdown-menu").empty();

                                    $("#add-new-mrr").hide();
                                }
                    });
            }else{
                toastr.error('Must Have Mrr Number');
            }
        });
        

        $(".item-select").on('click',function(e){
            let id = $(this).attr('data-medicine-id');
            setItem(id);
        });

      
        $("#add-new-item").on('click',function(){
            $('#modal-default-add').modal('show');
        })

        function NewItemAdd(){
            
            let name = $("#item_name").val();
            let manufacturer = $("#manufacturer").val();
            let generic = $("#generic").val();
            let strength = $("#strength").val();
            let product_category_id = $("#product_category_id").val();
            let product_sub_category_id = $("#product_sub_category_id").val();
            let medicine_use_for_id = $("#medicine_use_for_id").val();

            console.log({
                    'name' :name,
                    'manufacturer' :manufacturer,
                    'generic' :generic,
                    'strength' :strength,
                    'product_category_id' :product_category_id,
                    'product_sub_category_id' :product_sub_category_id,
                    'medicine_use_for_id' :medicine_use_for_id,
                    '_token': '{{ csrf_token() }}',
                });
            $.ajax({
                type: 'post',
                dataType: "json",
                url: "{{url('/medecine')}}",
                data:{
                    'form':'ajax_save',
                    'name':name,
                    'manufacturer':manufacturer,
                    'generic':generic,
                    'strength':strength,
                    'product_category_id':product_category_id,
                    'product_sub_category_id':product_sub_category_id,
                    'medicine_use_for_id':medicine_use_for_id,
                    '_token': '{{ csrf_token() }}',
                },
                success: function (response) {
                    console.log(response);
                    let x;
                    if('success' in response){
                        toastr.success('Item Added Successfully for '+response.success.name);
                        x = response.success;
                    }else if('existed' in response){
                        toastr.warning('Item Already Exists In store '+response.existed.name);
                        x = response.existed;
                    }
                    setItem(response.success.id);
                    
                        $("#item_name").val("");
                        $("#manufacturer").val("");
                        $("#generic").val("");
                        $("#strength").val("");
                        $("#product_category_id").val("");
                        $("#product_sub_category_id").val("");
                        $("#medicine_use_for_id").val("");
                    $('#modal-default-add').modal('hide');

                    $(".item-select").on('click',function(e){
                        let id = $(this).attr('data-medicine-id');
                        setItem(id);
                    });

                }
            });



        }

        $("#new_add_button").on('click',function(){
            NewItemAdd();
        })
        $("#medecine-search-btn-new").on('click',function(e){
            let ch_data = $("#medecinelistnew").val();
            console.log(ch_data);
            if((ch_data != '') &&( ch_data.length >= 3)){
            $.ajax({
                    type: 'put',
                    dataType: "json",
                    url: "{{url('medicinefrombank')}}/",
                    data:{
                        'search':ch_data,
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (result) {
                        console.log(result);
                        let element = "";
                        result.forEach(x =>{
                                element += `<tr>
                                    <td>
                                        <input class="form-control form-control-sm w-100" data-id="${x.id}" type="text" id="name${x.id}" name="name" value="${x.name}">
                                    </td>
                                    <td>
                                        <input class="form-control form-control-sm w-100" data-id="${x.id}" type="text" id="type${x.id}" name="type" value="${x.type}">
                                    </td>
                                    <td>
                                        <input class="form-control form-control-sm w-100" data-id="${x.id}" type="text" id="manufacturer${x.id}" name="manufacturer" value="${x.manufacturer}">
                                        
                                    </td>
                                     <td>
                                        <input class="form-control form-control-sm w-100" data-id="${x.id}" type="text" id="use_for${x.id}" name="use_for" value="${x.use_for}">
                                    </td>
                                    <td>
                                        <input class="form-control form-control-sm w-100" data-id="${x.id}" type="text" id="generic${x.id}" name="generic" value="${x.generic}">
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <select class="form-control form-control-sm" data-id="${x.id}"  name="category" id="category${x.id}">
                                                <option value="alo" ${x.category=='alo'?"selected":""}>Allopathy</option>
                                                <option value="her" ${x.category=='her'?"selected":""}>Herbal</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-xs btn-info add-new" data-id="${x.id}" >ADD
                                            {{-- <i class="fas fa-edit edit-delete-icon pb-1" style="color:#eef4f7;" data-id="${x.id}"></i> --}}
                                        </a>
                                    </td>
                                </tr>`
                        });
                        $("#medecine-item-list-new").empty();
                        $("#medecine-item-list-new").append(element);

                        $(".add-new").on('click',function(e){
                            let id = $(this).attr('data-id');
                            NewItemAdd(id);
                        })
                    }
                });
            }

        });
        $("#product_category_id").on('change',function(e){
            let id = $("#product_category_id").val();
                $.ajax({
                    url: "{{url('productsubcategory/listbycategory/')}}/"+id,
                    success: function (result) {
                        let element = `<option value="" selected disabled>Please select</option>`;
                        console.log(result);
                        result.forEach(x => {
                            element +=`<option value="${x.id}">${x.name_eng}</option>`;
                        });

                        $("#product_sub_category_id").empty();
                        $("#product_sub_category_id").append(element);
                       
                    }
                });
           

        });

    });

</script>

@endpush