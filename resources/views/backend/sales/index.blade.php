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

background-color:rgb(241, 242, 248);
}
.search-list{
height:550px;
overflow-x: hidden;
overflow-y: scroll;
}

</style>
<div class="content-wrapper">
    <x-breadcumb title="Sale Medecine"/>
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header p-2">
                    <div class="row">
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-control-sm" id="medecinelist" name="medecine_list" placeholder="Search">
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-sm btn-warning float-left" id="medecine-search-btn">search</button>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div  class="col-sm-9">
                            <div class="search-list" style="font-size:14px;height:250px;">
                                <table class="table table-sm">
                                    <thead>
                                        <th style="width:20%;">Name</th>
                                        <th style="width:20%;">Type</th>
                                        <th style="width:25%;">Manufacturer</th>
                                        <th style="width:35%;">Generic</th>
                                    </thead>
                                    <tbody class="bill-item-list-cl" id="medecine-item-list">
                                        @foreach ($medecineList as $item)
                                            <tr class="item-select" data-id="{{$item->id}}">
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->type}}</td>
                                                <td>{{$item->manufacturer}}</td>
                                                <td>{{$item->generic}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="search-list" style="font-size:14px;height:300px;">
                                <table class="table table-sm">
                                    <thead>
                                        <th style="width:30%;">Name</th>
                                        <th style="width:8%;">Expire Date</th>
                                        <th style="width:8%;">TP Rate</th>
                                        <th style="width:8%;">MRP Rate</th>
                                        <th style="width:8%;">Quantity</th>
                                        <th style="width:8%;">Total Amount</th>
                                        <th style="width:8%;">Discount Per</th>
                                        <th style="width:8%;">Discount Amt</th>
                                        <th style="width:8%;">Payble Amount</th>
                                        <th style="width:6%;">Action</th>
                                    </thead>
                                    <tbody class="bill-item-list-cl" id="bill-item-list" style="background-color:#e9ecef;">
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
                                            <td><input class="form-control form-control-sm " type="number" step="any" value="0" name="bill_amount" id="bill-amount" /></td>
                                            <th style="text-align: right;">Total Paid :</th>
                                            <td><input class="form-control form-control-sm final-bill-field" type="number" step="any" value="0" name="bill_paid_amount" id="bill-paid-amount"/></td>
                                        </tr>
                                        <tr>
                                            <th style="text-align: right;">Discount in Percentage :</th>
                                            <td><input class="form-control form-control-sm " type="number" step="any" value="0" name="bill_in_per" id="bill-in-per"/></td>
                                            <th style="text-align: right;">Net Payable Amount :</th>
                                            <td><input class="form-control form-control-sm " type="number" step="any" value="0" name="bill_total_amount" id="bill-total-amount"/></td>
                                            <th style="text-align: right;">Total Due :</th>
                                            <td><input class="form-control form-control-sm " type="number" step="any" value="0" name="bill_due_amount" id="bill-due-amount"/></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="card-footer text-right">
                                    <button type="reset" class="btn btn-sm btn-danger float-left">&nbsp;Clear&nbsp;</button>
                                    <button type="submit" class="btn btn-sm btn-success">&nbsp;Save&nbsp;</button>
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
                                            <input class="form-control form-control-md w-100" type="text" id="stock-cell" name="stock_cell" value="" disabled>
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

        $(function () {
            $('.select2bs4').select2({
            theme: 'bootstrap4',
            })
            $('#birth_date').datetimepicker({
                format: 'YYYY-MM-DD',
            });
        });

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






        $("#save-btn").on("click",function(e){

            let itemId = $("#item-id").val();
            let name = $("#name").val();
            let stockCell = $("#stock-cell").val();
            let mrpRate = $("#mrp-rate").val();
            let tpRate = $("#tp-rate").val();
            let stockPer = $("#stock_per").val();
            let currentStock = $("#current-stock").val();
            let stockQuantity = $("#sale-quantity").val();
            let expireDate = $("#expire-date").val();
            $.ajax({
                type: 'post',
                dataType: "json",
                url: "{{url('stockmedecine')}}",
                data:{
                    'item_id':itemId,
                    'name':name,
                    'stock_cell':stockCell,
                    'mrp_rate':mrpRate,
                    'tp_rate':tpRate,
                    'stock_per':stockPer,
                    'current_stock':currentStock,
                    'stock_quantity':stockQuantity,
                    'expire_date':expireDate,
                    '_token': '{{ csrf_token() }}',
                },
                success: function (response) {
                    console.log(response);


                }
            });

        });

        function setItem(id){
            console.log(id);
            $.ajax({
                    type: 'get',
                    dataType: "json",
                    url: "{{url('stockmedecine')}}/"+id,
                    success: function (result) {
                        console.log(result);
                        $("#item-id").val(result.item.id);
                        $("#name").val(result.item.name);
                        $("#stock-cell").val(result.item.stock_cell);
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
                });

        }

        $(".item-select").on('click',function(e){
            let id = $(this).attr('data-id');
            setItem(id);
        });

        function stockEntry(id){
              let storeQty = 5;
              let medecineID = 5;
              let stockID = 5;
            console.log(id);
            $.ajax({
                    type: 'post',
                    dataType: "json",
                    url: "{{url('stockmedecine')}}",
                    data:{
                        'storeQty':storeQty,
                        'medecineID':medecineID,
                        'stockID':stockID,
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (response) {
                        console.log(response);
                        if('success' in response){
                            $('#storeqty'+id).val(0);
                            $('#current-stock'+id).text(response.success.current_stock);
                            $('#storeqty'+id).attr('data-stock-id',response.success.id);
                            toastr.success('Stock Updated Successfully for '+response.success.name);

                        }

                    }
                });
        }

        $("#medecine-search-btn").on('click',function(e){
            let ch_data = $("#medecinelist").val();
            console.log(ch_data);
            if((ch_data != '') &&( ch_data.length >= 3)){
            $.ajax({
                    type: 'put',
                    dataType: "json",
                    url: "{{url('stockmedecine')}}/",
                    data:{
                        'search':ch_data,
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (result) {
                        console.log(result);
                        let element = "";
                        result.forEach(x =>{
                                element += `<tr class="item-select" data-id="${x.id}">
                                    <td>${x.name}</td>
                                    <td>${x.type}</td>
                                    <td>${x.manufacturer}</td>
                                    <td>${x.generic}</td>
                                </tr>`
                        });
                        $("#medecine-item-list").empty();
                        $("#medecine-item-list").append(element);

                      $(".item-select").on('click',function(e){
                            let id = $(this).attr('data-id');
                            setItem(id);
                        });
                    }
                });
            }

        });

        $(".store-medecine").on('click',function(e){
            let id = $(this).attr('data-id');
            console.log(id);
        });


        $("#add-new-item").on('click',function(){
            $('#modal-default-add').modal('show');
        })

        function NewItemAdd(id){
            let name = $("#name"+id).val();
            let type = $("#type"+id).val();
            let manufacturer = $("#manufacturer"+id).val();
            let generic = $("#generic"+id).val();
            let strength = $("#strength"+id).val();
            let use_for = $("#use_for"+id).val();
            $.ajax({
                type: 'post',
                dataType: "json",
                url: "{{url('medecinestock')}}",
                data:{
                    'name':name,
                    'type':type,
                    'manufacturer':manufacturer,
                    'generic':generic,
                    'strength':strength,
                    'use_for':use_for,
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

                    $("#medecine-item-list").empty();
                    let element = `
                        <tr class="item-select" data-id="${x.id}">
                            <td>${x.name}</td>
                                    <td>${x.type}</td>
                                    <td>${x.manufacturer}</td>
                                    <td>${x.generic}</td>
                                </tr>
                    `;
                    $("#medecine-item-list").append(element);
                    $('#modal-default-add').modal('hide');

                    $(".item-select").on('click',function(e){
                        let id = $(this).attr('data-id');
                        setItem(id);
                    });

                }
            });



        }


        $("#medecine-search-btn-new").on('click',function(e){
            let ch_data = $("#medecinelistnew").val();
            console.log(ch_data);
            if((ch_data != '') &&( ch_data.length >= 3)){
            $.ajax({
                    type: 'put',
                    dataType: "json",
                    url: "{{url('medecinestock')}}/",
                    data:{
                        'search':ch_data,
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (result) {
                        console.log(result);
                        let element = "";
                        result.forEach(x =>{
                                element += `<tr>
                                    <td><input class="form-control form-control-sm w-100" data-id="${x.id}" type="text" id="name${x.id}" name="name" value="${x.name}"></td>
                                    <td>
                                        <input class="form-control form-control-sm w-100" data-id="${x.id}" type="text" id="type${x.id}" name="type" value="${x.type}">
                                        <input class="form-control form-control-sm w-100" data-id="${x.id}" type="text" id="use_for${x.id}" name="use_for" value="${x.use_for}">
                                    </td>
                                    <td>
                                        <input class="form-control form-control-sm w-100" data-id="${x.id}" type="text" id="manufacturer${x.id}" name="manufacturer" value="${x.manufacturer}">
                                        <input class="form-control form-control-sm w-100" data-id="${x.id}" type="text" id="generic${x.id}" name="generic" value="${x.generic}">
                                    </td>
                                    <td><input class="form-control form-control-sm w-100" data-id="${x.id}" type="text" id="generic${x.id}" name="generic" value="${x.generic}"></td>
                                    <td><input class="form-control form-control-sm w-100" data-id="${x.id}" type="text" id="strength${x.id}" name="strength" value="${x.strength}"></td>
                                    <td><input class="form-control form-control-sm w-100" data-id="${x.id}" type="text" id="use_for${x.id}" name="use_for" value="${x.use_for}"></td>
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
            $('#bill-in-per').val(0);
            finalBillCalculation();
        });

        function calculateBill(){
            let amtResult = 0;
            let discResult = 0;
                $(".payable-total").each(function(){
                    amtResult += Number($(this).val());
                });
                console.log(amtResult);
                $(".payable-discount").each(function(){

                    discResult += Number($(this).val());
                });
                $("#bill-amount").val(amtResult);
                $("#bill-dis-amt").val(discResult);
                finalBillCalculation();
        }
        function calculateIndividualBill(id){
            let rate = $('#mrp-rate'+id).val();
            let qty = $('#sale-quantity'+id).val();
            let disc = $('#discount-amount'+id).val();

            let payAmount = (Number(rate)*Number(qty))-Number(disc);
            console.log(id);
            $('#total-amount'+id).val((Number(rate)*Number(qty)).toFixed(2));
            $('#payable-amount'+id).val(payAmount);
            calculateBill();
        }

        $("#add-btn").on("click",function(e){
            let itemId = $("#item-id").val();
            let name = $("#name").val();
            let stockCell = $("#stock-cell").val();
            let mrpRate = $("#mrp-rate").val();
            let tpRate = $("#tp-rate").val();
            let stockPer = $("#stock_per").val();
            let currentStock = $("#current-stock").val();
            let saleQuantity = $("#sale-quantity").val();
            let totalAmount = $("#total-amount").val();
            let expiryDate = $("#expire-date").val();
            let discountPer = $("#disc-per").val();
            let discountAmt = $("#disc-amt").val();
            let payableAmount = $("#payable-amount").val();

            let element = `<tr>
                <td>
                    ${name}

                </td>
                <td>
                    <input class="form-control form-control-sm w-100" data-id="${itemId+expiryDate}" type="text" id="expire-date${itemId+expiryDate}" name="expire_date[]" value="${expiryDate}" readonly>
                </td>
                <td>
                    ${tpRate}

                </td>
                <td>
                    <input class="form-control form-control-sm w-100 mrp-rate" data-id="${itemId+expiryDate}" type="text" id="mrp-rate${itemId+expiryDate}" name="mrp_rate[]" value="${mrpRate}">
                </td>
                 <td>
                    <input class="form-control form-control-sm w-100 sale-qty" data-id="${itemId+expiryDate}" type="text" id="sale-quantity${itemId+expiryDate}" name="sale_quantity[]" value="${saleQuantity}">
                </td>
                <td>
                    <input class="form-control form-control-sm w-100 payable-total" data-id="${itemId+expiryDate}" type="text" id="total-amount${itemId+expiryDate}" name="total_amount[]" value="${totalAmount}" readonly>
                </td>
                 <td>
                    <input class="form-control form-control-sm w-100 discount-per" data-id="${itemId+expiryDate}" type="text" id="discount-percent${itemId+expiryDate}" name="discount_percent[]" value="${discountPer}">
                </td>
                 <td>
                    <input class="form-control form-control-sm w-100 payable-discount" data-id="${itemId+expiryDate}" type="text" id="discount-amount${itemId+expiryDate}" name="discount_amount[]" value="${discountAmt}">
                </td>
                 <td>
                    <input class="form-control form-control-sm w-100 payable" data-id="${itemId+expiryDate}" type="text" id="payable-amount${itemId+expiryDate}" name="payable_amount[]" value="${payableAmount}" readonly>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-xs remove-btn" title="Remove">
                        <i class="fas fa-times p-1"></i>
                    </button>
                </td>
                </tr>`;
                    $("#bill-item-list").append(element);

                    $('.remove-btn').on('click',function(e){
                        $(this).closest("tr").remove();
                        calculateBill();
                    });
                    calculateBill();

                    $('.mrp-rate').on('keyup',function(e){
                        console.log($(this).attr('data-id'));
                        calculateIndividualBill($(this).attr('data-id'));
                    });
                    $('.sale-qty').on('keyup',function(e){
                        calculateIndividualBill($(this).attr('data-id'));
                    });

                    $('.discount-per').on('keyup',function(e){
                        let id = $(this).attr('data-id');
                        let totalAmount = $('#total-amount'+id).val();
                        let perValue = $(this).val();
                        let discountAmount = ((Number(perValue)*Number(totalAmount))/100).toFixed(2);
                        console.log(discountAmount);
                        $('#discount-amount'+id).val(discountAmount);
                        calculateIndividualBill(id);
                    });
                    $('.payable-discount').on('keyup',function(e){
                        let id = $(this).attr('data-id');
                        let totalAmount = $('#total-amount'+id).val();
                        let disValue = $(this).val();
                        let discountAmount = ((Number(disValue)/Number(totalAmount))*100).toFixed(2);
                        console.log(discountAmount);
                        $('#discount-percent'+id).val(discountAmount);
                        calculateIndividualBill(id);
                    });
                });


                $('#bill-in-per').on('keyup',function(e){
                    let perVal = $(this).val();

                    $(".discount-per").each(function(){
                        let id = $(this).attr('data-id');
                        let totalAmount = $('#total-amount'+id).val();
                        let discountAmount = ((Number(perVal)*Number(totalAmount))/100).toFixed(2);
                        console.log(discountAmount);
                        $('#discount-amount'+id).val(discountAmount);
                        $('#discount-percent'+id).val(perVal);
                        calculateIndividualBill(id);
                    });
                })





        });

</script>

@endpush
