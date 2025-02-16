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

#investigation-list{
    height:300px;
    overflow-x: hidden;
    overflow-y: scroll;

}
.complaint-search-list{
    height:450px;
    overflow-x: hidden;
    overflow-y: scroll;
}
.add-list{
    overflow-x: hidden;
    overflow-y: scroll;
}
.complaint-list-item:hover{
    cursor: pointer;
    background-color: beige;
}

.complaint-duration-list-item:hover{
    cursor: pointer;
    background-color: beige;
}
@media print
{
body * { visibility: hidden; }
#print-div * { visibility: visible; }
#print-button { visibility: hidden; }

#print-div { position: absolute; top: 40px; left: 30px; }
}



        /* Custom scrollbar for WebKit-based browsers (Chrome, Safari, Edge) */
        .complaint-search-list::-webkit-scrollbar {
            width: 10px; /* Width of the scrollbar */
        }

        .complaint-search-list::-webkit-scrollbar-track {
            background: #f1f1f1; /* Track color */
            border-radius: 5px;
        }

        .complaint-search-list::-webkit-scrollbar-thumb {
            background: #888; /* Scrollbar thumb color */
            border-radius: 5px; /* Rounded corners */
        }

        .complaint-search-list::-webkit-scrollbar-thumb:hover {
            background: #555; /* Hover effect */
        }

        /* Custom scrollbar for Firefox */
        .complaint-search-list {
            scrollbar-width: thin; /* Thin scrollbar */
            scrollbar-color: #888 #f1f1f1; /* Thumb color and track color */
        }

        /* Custom scrollbar for Internet Explorer (Optional) */
        .complaint-search-list {
            -ms-overflow-style: scrollbar; /* Custom IE scrollbar style */
        }
</style>
<div class="content-wrapper">
    <x-breadcumb title="Stock History"/>
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header p-2">

                </div>
                <div class="card-body">
                    <div class="col-sm-12 search-list" style="font-size:14px;height:550px;">
                        <table class="table table-sm">
                            <thead>
                                <th style="width:20%;">Name</th>
                                <th style="width:10%;">Type</th>
                                <th style="width:20%;">Manufacturer</th>
                                <th style="width:10%;">Generic</th>
                                <th style="width:10%;">Strength</th>
                                <th style="width:10%;">Use For</th>
                                <th style="width:7%;">Current Stock</th>
                                <th style="width:7%;">Entry Qty</th>
                                <th style="width:7%;">Entry Date</th>
                            </thead>
                            <tbody class="bill-item-list-cl" >
                            @foreach($todaystock as $item)
                                <tr data-id="{!! $item->id !!}">
                                    <td>{!! $item->name	 !!}</td>
                                    <td>{!! $item->type !!}</td>
                                    <td>{!! $item->manufacturer !!}</td>
                                    <td>{!! $item->generic !!}</td>
                                    <td>{!! $item->strength !!}</td>
                                    <td>{!! $item->use_for !!}</td>
                                    <td>{!! $item->current_stock !!}</td>
                                    <td>{!! $item->stock_qty !!}</td>
                                    <td>{!! $item->stock_date !!}</td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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

        function patientSet(id){
                let patient_id = $("#reg-patient-id"+id).text();
                let patient_name = $("#reg-patient-name"+id).text();
                let patient_gender = $("#reg-patient-gender"+id).text();
                let patient_age = $("#reg-patient-age"+id).text();
                let appon_date = $("#reg-appon-date"+id).text();

                $("#patient-id").text(patient_id);
                $("#patient-name").text(patient_name);
                $("#patient-gender").text(patient_gender);
                $("#patient-age").text(patient_age);
                $("#appon-date").text(appon_date);
                console.log([id,patient_id]);
                $('#allPatient').modal('hide')
                }
        function regPatientBill(id){
                    patientSet(id);
                    let patient_id = $("#patient-id").text();
                    $.ajax({
                            type: "POST",
                            url: "{{url('billing')}}",
                            data: {
                                    '_token':'{{ csrf_token() }}',
                                    patient_id:patient_id,
                                },
                            success: function(response) {
                                    $("#bill-date").text(response.bill_date);
                                    $("#bill-no").text(response.bill_id);
                                    $("#bill_main_id").val(response.bill_id);
                                    $("#bill-item-add-list").empty();
                                    $("#bill-service-add-list").empty();
                                    $("#bill-equip-add-list").empty();
                                    $("#bill-amount").val(0);
                                    $("#bill-dis-amt").val(0);
                                    $("#bill-in-per").val(0);
                                    $("#bill-total-amount").val(0);
                                    $("#bill-paid-amount").val(0);
                                    $("#bill-due-amount").val(0);
                                    toastr.success('New Bill Is Created');
                            },
                        });
        }
        $("#allptnbtn").on('click',function(e){
            $.ajax({
                    type: 'PUT',
                    dataType: "json",
                    url: "{{url('patient')}}/",
                    data:{
                        'search':"",
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (result) {
                        console.log(result);
                        let element = "";
                        result.forEach(x =>{
                            element +=`<tr>
                                        <td id="reg-patient-id${x.id}">${x.patient_id}</td>
                                        <td id="reg-patient-name${x.id}">${x.name}</td>
                                        <td id="reg-patient-gender${x.id}">${x.sex == 'M'?'Male':(x.sex == 'F'?'Female':'Other')}</td>
                                        <td id="reg-patient-contact${x.id}">${x.contact_no}</td>
                                        <td id="reg-patient-age${x.id}">${x.age}</td>
                                        <td ><button class="btn btn-sm btn-info reg-select" data-id="${x.id}">
                                            <i class="fas fa-check p-1 edit-delete-icon" style="color:#004369;" data-id="${x.id}"></i>
                                        </button></td>
                                    </tr>`
                        });
                        $("#patient_search_list").empty();
                        $("#patient_search_list").append(element);
                        $(".reg-select").on('click',function(e){
                            let id = $(this).attr('data-id');
                            regPatientBill(id);
                        });
                    }
                });
        });

        $(".reg-select").on('click',function(e){
            let id = $(this).attr('data-id');
            regPatientBill(id);

        });

        $("#patient").on('keyup',function(e){
            let ch_data = $("#patient").val();
            console.log(ch_data);
            $.ajax({
                    type: 'PUT',
                    dataType: "json",
                    url: "{{url('patient')}}/",
                    data:{
                        'search':ch_data,
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (result) {
                        console.log(result);
                        let element = "";
                        result.forEach(x =>{
                            element +=`<tr>
                                        <td id="reg-patient-id${x.id}">${x.patient_id}</td>
                                        <td id="reg-patient-name${x.id}">${x.name}</td>
                                        <td id="reg-patient-gender${x.id}">${x.sex == 'M'?'Male':(x.sex == 'F'?'Female':'Other')}</td>
                                        <td id="reg-patient-contact${x.id}">${x.contact_no}</td>
                                        <td id="reg-patient-age${x.id}">${x.age}</td>
                                        <td ><button class="btn btn-sm btn-info reg-select" data-id="${x.id}">
                                            <i class="fas fa-check p-1 edit-delete-icon" style="color:#004369;" data-id="${x.id}"></i>
                                        </button></td>
                                    </tr>`
                        });
                        $("#patient_search_list").empty();
                        $("#patient_search_list").append(element);
                        $(".reg-select").on('click',function(e){
                            let id = $(this).attr('data-id');
                            regPatientBill(id);
                        });
                    }
                });
        });

        $('#new_patient_create').submit(function(e) {
                e.preventDefault();
                let formdata = $('#new_patient_create').serialize();
                console.log(formdata);
                $.ajax({
                    type: "POST",
                    url: "{{url('patients')}}",
                    data: formdata,
                    success: function(response) {
                            if('error' in response){
                                if('message' in response) {toastr.warning(response.message);}
                                toastr.error(response.error);

                            }else{
                                $("#patient-id").text(response.patient_id);
                                $("#patient-name").text(response.name);
                                $("#patient-gender").text(response.sex=='M'?'Male':(response.sex=='F'?'Female':'Other'));
                                $("#patient-age").text(response.age);
                                $('#new_patient_create').trigger("reset");
                                $('#newPatient').modal("hide");
                                toastr.success('New Patient Created');
                                $.ajax({
                                    type: "POST",
                                    url: "{{url('billing')}}",
                                    data: {
                                            '_token':'{{ csrf_token() }}',
                                            patient_id:response.patient_id,
                                        },
                                    success: function(response) {
                                            $("#bill-date").text(response.bill_date);
                                            $("#bill-no").text(response.bill_id);
                                            $("#bill_main_id").val(response.bill_id);
                                            $("#bill-item-add-list").empty();
                                            $("#bill-service-add-list").empty();
                                            $("#bill-equip-add-list").empty();
                                            $("#bill-amount").val(0);
                                            $("#bill-dis-amt").val(0);
                                            $("#bill-in-per").val(0);
                                            $("#bill-total-amount").val(0);
                                            $("#bill-paid-amount").val(0);
                                            $("#bill-due-amount").val(0);
                                            toastr.success('New Bill Is Created');
                                    },
                                });
                            }

                    },
                    error:function(req,status,err){
                        console.log(err);
                    }
                });
                console.log('Worked');
        });

        $("#investigation").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#investigation-table-list tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
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
          }else if((!isNaN(discountPer)) && discountPer != 0){
            newFinalAmount = (Number(billAmount) - ((Number(discountPer)*Number(billAmount))/100)).toFixed(2);
          }
          if(!isNaN(paidAmount)){
            let newDueAmount = (Number(newFinalAmount)-Number(paidAmount)).toFixed(2);
            $("#bill-due-amount").val(newDueAmount);
          }
          $("#bill-total-amount").val(newFinalAmount);


        }
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
        function billItemotalCal(id){
            let quantity = $("#qty"+id).val();
            let discount_per = $("#dis-per"+id).val();
            let discount_amt = $("#dis-amt"+id).val();
            if(!isNaN(quantity)&&quantity!=""){
                let price = $("#price"+id).text();
                let total_price = (Number(price)*Number(quantity)).toFixed(2);
                let discount_amount = ((Number(discount_per)/100)*Number(price)).toFixed(2);
                let total_discount_amount = (discount_amount*Number(quantity)).toFixed(2);
                let total_payable = (total_price-total_discount_amount).toFixed(2);
                $("#amt"+id).val(total_price);
                $("#dis-amt"+id).val(total_discount_amount);
                $("#total-payable"+id).val(total_payable);
            }else{
                $("#amt"+id).val(0);
                $("#dis-amt"+id).val(0);
                $("#total-payable"+id).val(0);
            }
            calculateBill();
        }
        $(".final-bill-field").on('keyup',function(e){
            if(e.target.name == "bill_dis_amt"){
                $("#bill-in-per").val(0);
                finalBillCalculation();
            }else if(e.target.name == "bill_in_per"){
                let discountPer =  $(this).val();
                $(".billing-item-amount").each(function(){

                amtResult += Number($(this).val());
                });
                $("#bill-dis-amt").val(amtValue);
            }

        });
        $("#bill-item-search").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#bill-item-list tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
        $(".bill-item-add").on('click',function(){
            let id = $(this).attr('data-id');
            myElement2='';
            $.ajax({
                    url: "{{url('billingitems/')}}/"+id,
                    success: function (result) {
                        console.log(result);
                        if($("#qty"+result.item.id).val()){
                                    console.log($("#qty"+result.item.id).val())
                                    let qty = $("#qty"+result.item.id).val();
                                    let amt = $("#amt"+result.item.id).val();
                                    let disc_per = $("#dis-per"+result.item.id).val();
                                    let total_qty = Number(qty)+1;
                                    let total_amt = (Number(result.item.price)*total_qty).toFixed(2);
                                    let discount_amount = ((Number(disc_per)/100)*Number(result.item.price)).toFixed(2);
                                    let total_dis_amt = discount_amount*total_qty;
                                    let total_payable_amt = (total_amt- total_dis_amt).toFixed(2);

                                    $("#qty"+result.item.id).val(total_qty);
                                    $("#amt"+result.item.id).val(total_amt);
                                    $("#dis-amt"+result.item.id).val(total_dis_amt);
                                    $("#total-payable"+result.item.id).val(total_payable_amt);

                                    calculateBill();
                        }else{
                            let disc_amount = ((Number(result.item.discount_per)/100)*Number(result.item.price)).toFixed(2);
                            let  myElement =`<tr>
                                    <td>
                                        <input type="hidden" name="bill_item[]" value="${result.item.id}" />
                                        <input type="hidden" name="discountable[${result.item.id}]" value="${result.item.discountable}" />
                                        <input type="hidden" name="service_category_id[${result.item.id}]" value="${result.item.service_category_id}" />
                                        ${result.item.item_name}
                                    </td>
                                    <td id="price${result.item.id}">${result.item.price}</td>
                                    <td><input class="form-control form-control-sm billing-item-qty w-100 text-center" data-id="${result.item.id}" type="text" id="qty${result.item.id}" name="quantity[${result.item.id}]" value="1"></td>
                                    <td><input class="form-control form-control-sm billing-item-amount w-100 text-center" type="text" id="amt${result.item.id}" data-id="${result.item.id}" name="amount[${result.item.id}]" value="${Number(result.item.price)}" readonly></td>
                                    <td><input class="form-control form-control-sm billing-item-dis-per w-100 text-center" data-id="${result.item.id}" data-discountable="${result.item.discountable}" type="text" id="dis-per${result.item.id}" name="discount_per[${result.item.id}]" value="${result.item.discount_per}" ${Boolean(result.item.discountable)?"":"readonly"}></td>
                                    <td><input class="form-control form-control-sm billing-item-dis-amt w-100 text-center" data-id="${result.item.id}" type="text" id="dis-amt${result.item.id}" name="discount_amt[${result.item.id}]" value="${disc_amount}" ${Boolean(result.item.discountable)?"":"readonly"}></td>
                                    <td><input class="form-control form-control-sm billing-item-total-payable w-100 text-center" data-id="${result.item.id}" type="text" id="total-payable${result.item.id}" name="total_payable[${result.item.id}]" value="${(Number(result.item.price)-disc_amount).toFixed(2)}"></td>
                                    <td>
                                        <div class="input-group date  w-100" id="delivery_date${result.item.id}" data-target-input="nearest">
                                            <input type="text" class="form-control form-control-sm datetimepicker-input" data-target="#delivery_date${result.item.id}" name="delivery_date[${result.item.id}]"  readonly}/>
                                            <div class="input-group-append" data-target="#delivery_date${result.item.id}" data-toggle="datetimepicker">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger btn-xs remove-btn" title="Remove">
                                            <i class="fas fa-times p-1"></i>
                                        </button>
                                    </td>

                                    </tr>
                                `;
                                if(result.item.service_category_id == 2){
                                    $("#bill-item-add-list").append(myElement);
                                }else if(result.item.service_category_id == 3){
                                    $("#bill-equip-add-list").append(myElement);
                                }else if(result.item.service_category_id == 4){
                                    $("#bill-service-add-list").append(myElement);
                                }
                                calculateBill();
                                $(function () {
                                    let todaydate = new Date();
                                    $("#delivery_date"+result.item.id).datetimepicker({
                                        format: 'YYYY-MM-DD',
                                        defaultDate: todaydate.setDate(todaydate.getDate() + result.item.duration),
                                    });

                                });

                        }
                            if(result.equipments){
                                result.equipments.map(x=>{
                                    if($("#qty"+x.equip.id).val()){
                                        console.log($("#qty"+x.equip.id).val())
                                        let qty = $("#qty"+x.equip.id).val();
                                        let amt = $("#amt"+x.equip.id).val();
                                        let disc_per = $("#dis-per"+x.equip.id).val();
                                        let total_qty = Number(qty)+Number(x.quantity);
                                        let total_amt = (Number(x.equip.price)*total_qty).toFixed(2);
                                        let discount_amount = ((Number(disc_per)/100)*Number(x.equip.price)).toFixed(2);
                                        let total_dis_amt = discount_amount*total_qty;
                                        let total_payable_amt = (total_amt- total_dis_amt).toFixed(2);

                                        $("#qty"+x.equip.id).val(total_qty);
                                        $("#amt"+x.equip.id).val(total_amt);
                                        $("#dis-amt"+x.equip.id).val(total_dis_amt);
                                        $("#total-payable"+x.equip.id).val(total_payable_amt);

                                        calculateBill();
                                    }else{
                                         disc_amount = ((Number(x.equip.discount_per)/100)*Number(x.equip.price)).toFixed(2);

                                        myElement2 +=`<tr>
                                    <td>
                                        <input type="hidden" name="bill_item[]" value="${x.equip.id}" />
                                        <input type="hidden" name="discountable[${x.equip.id}]" value="${x.equip.discountable}" />
                                        <input type="hidden" name="service_category_id[${x.equip.id}]" value="${x.equip.service_category_id}" />
                                        ${x.equip.item_name}
                                    </td>
                                    <td id="price${x.equip.id}">${x.equip.price}</td>
                                    <td><input class="form-control form-control-sm billing-item-qty w-100 text-center" data-id="${x.equip.id}" type="text" id="qty${x.equip.id}" name="quantity[${x.equip.id}]" value="${x.quantity}"></td>
                                    <td><input class="form-control form-control-sm billing-item-amount w-100 text-center" type="text" id="amt${x.equip.id}" name="amount[${x.equip.id}]" value="${Number(x.equip.price)}" readonly></td>
                                    <td><input class="form-control form-control-sm billing-item-dis-per w-100 text-center" data-id="${x.equip.id}" data-discountable="${x.equip.discountable}" type="text" id="dis-per${x.equip.id}" name="discount_per[${x.equip.id}]" value="${x.equip.discount_per}" ${Boolean(x.equip.discountable)?"":"readonly"}></td>
                                    <td><input class="form-control form-control-sm billing-item-dis-amt w-100 text-center" data-id="${x.equip.id}" type="text" id="dis-amt${x.equip.id}" name="discount_amt[${x.equip.id}]" value="${disc_amount}" ${Boolean(x.equip.discountable)?"":"readonly"}></td>
                                    <td><input class="form-control form-control-sm billing-item-total-payable w-100 text-center" data-id="${x.equip.id}" type="text" id="total-payable${x.equip.id}" name="total_payable[${x.equip.id}]" value="${(Number(x.equip.price)-disc_amount).toFixed(2)}"></td>
                                    <td>
                                        <div class="input-group date  w-100" id="delivery_date${x.equip.id}" data-target-input="nearest">
                                            <input type="text" class="form-control form-control-sm datetimepicker-input" data-target="#delivery_date${x.equip.id}" name="delivery_date[${x.equip.id}]" readonly/>
                                            <div class="input-group-append" data-target="#delivery_date${x.equip.id}" data-toggle="datetimepicker">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger btn-xs remove-btn" title="Remove">
                                            <i class="fas fa-times p-1"></i>
                                        </button>
                                    </td>

                                    </tr>
                                `;
                                        $("#bill-equip-add-list").append(myElement2);
                                        calculateBill();
                                        $(function () {
                                            let todaydate = new Date();
                                        $("#delivery_date"+x.equip.id).datetimepicker({
                                            format: 'YYYY-MM-DD',
                                            defaultDate: todaydate,
                                        });

                                });
                                    }
                                });
                            }
                            $(".billing-item-qty").on('keyup',function(e){
                                let id = $(this).data('id');
                                billItemotalCal(id);
                            })
                            $(".billing-item-dis-per").on('keyup',function(e){
                                let id = $(this).data('id');
                                billItemotalCal(id);
                            })
                            $(".billing-item-dis-amt").on('keyup',function(e){
                                let id = $(this).data('id');
                                billItemotalCal(id);
                            })
                            $(".billing-item-total-payable").on('keyup',function(e){
                                let id = $(this).data('id');
                                billItemotalCal(id);
                            })
                            $('.billing-item-amount').on('keyup',function(e){
                                calculateBill();
                            });
                            $('.remove-btn').on('click',function(e){
                                console.log("Prottoy");
                                $(this).closest("tr").remove();
                                calculateBill();
                            });
                    },
                    error: function (req, status, error) {
                     var err = req.responseText;
                     console.log(err);
                     }

                });
        });
        $("#new_billing_details_create").submit(function(e){
            e.preventDefault();
            let formdata = $('#new_billing_details_create').serialize();
            let check = $("#bill_main_id").val();
                if(check){
                    $.ajax({
                    type: "POST",
                    url: "{{url('billingdetails')}}",
                    data: formdata,
                    success: function(response) {
                        if('error' in response){
                            toastr.error(response.error);
                        }else{
                            console.log(response);
                            toastr.success('Bill Details Saved');

                            }
                    },
                    error:function(req,status,err){
                        console.log(err);
                    }
                });
                }else{
                    toastr.error('Please Select Bill');
                }


        });
        function editBill(id){
                $("#bill-item-add-list").empty();
                $("#bill-equip-add-list").empty();
                $("#bill-service-add-list").empty();

            console.log(id);
            $.ajax({
                    url: "{{url('billing/')}}/"+id,
                    success: function (response) {
                        console.log(response);
                        $("#patient-id").text(response.main.patient_id);
                        $("#patient-name").text(response.main.patient_name);
                        $("#patient-gender").text(response.main.patient.sex=='M'?'Male':(response.main.patient.sex=='F'?'Female':'Other'));
                        $("#patient-age").text(response.main.patient.age);
                        $("#bill-date").text(response.main.bill_date);
                        $("#bill-no").text(response.main.bill_id);
                        $("#bill_main_id").val(response.main.bill_id);
                        $("#bill-amount").val(Number(response.main.total_amount).toFixed(2));
                        $("#bill-dis-amt").val(Number(response.main.discount_amount).toFixed(2));
                        $("#bill-in-per").val(Number(response.main.discount_percent).toFixed(2));
                        $("#bill-total-amount").val(Number(response.main.payable_amount).toFixed(2));
                        $("#bill-paid-amount").val(Number(response.main.paid_amount).toFixed(2));
                        $("#bill-due-amount").val(Number(response.main.due_amount).toFixed(2));

                        response.details.map(x=>{
                          let  myElement =`<tr>
                                    <td>
                                        <input type="hidden" name="bill_item[]" value="${x.item_id}" />
                                        <input type="hidden" name="service_category_id[${x.item_id}]" value="${x.service_category_id}" />
                                        ${x.item_name}
                                    </td>
                                    <td id="price${x.item_id}">${x.item_rate}</td>
                                    <td><input class="form-control form-control-sm billing-item-qty w-100 text-center" data-id="${x.item_id}" type="text" id="qty${x.item_id}" name="quantity[${x.item_id}]" value="${x.quantity}"></td>
                                    <td><input class="form-control form-control-sm billing-item-amount w-100 text-center" type="text" id="amt${x.item_id}" name="amount[${x.item_id}]" value="${Number(x.price)}" readonly></td>
                                    <td><input class="form-control form-control-sm billing-item-dis-per w-100 text-center" data-id="${x.item_id}" data-discountable="${x.is_gov_rate}" type="text" id="dis-per${x.item_id}" name="discount_per[${x.item_id}]" value="${x.discount_percent}"></td>
                                    <td><input class="form-control form-control-sm billing-item-dis-amt w-100 text-center" data-id="${x.item_id}" type="text" id="dis-amt${x.item_id}" name="discount_amt[${x.item_id}]" value="${x.discount_amount}"></td>
                                    <td><input class="form-control form-control-sm billing-item-total-payable w-100 text-center" data-id="${x.item_id}" type="text" id="total-payable${x.item_id}" name="total_payable[${x.item_id}]" value="${Number(x.final_price).toFixed(2)}"></td>
                                    <td>
                                        <div class="input-group date  w-100" id="delivery_date${x.item_id}" data-target-input="nearest">
                                            <input type="text" class="form-control form-control-sm datetimepicker-input" data-target="#delivery_date${x.item_id}" name="delivery_date[${x.item_id}]"  readonly}/>
                                            <div class="input-group-append" data-target="#delivery_date${x.item_id}" data-toggle="datetimepicker">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger btn-xs remove-btn" title="Remove">
                                            <i class="fas fa-times p-1"></i>
                                        </button>
                                    </td>
                                    </tr>
                                `;
                                if(x.service_category_id == 2){
                                    $("#bill-item-add-list").append(myElement);
                                }else if(x.service_category_id == 3){
                                    $("#bill-equip-add-list").append(myElement);
                                }else if(x.service_category_id == 4){
                                    $("#bill-service-add-list").append(myElement);
                                }

                                $(function () {
                                    let todaydate = new Date(x.delivery_date);
                                    $("#delivery_date"+x.item_id).datetimepicker({
                                        format: 'YYYY-MM-DD',
                                        defaultDate: todaydate,
                                    });

                                });
                        });
                        $(".billing-item-qty").on('keyup',function(e){
                                let id = $(this).data('id');
                                billItemotalCal(id);
                            })
                            $(".billing-item-dis-per").on('keyup',function(e){
                                let id = $(this).data('id');
                                billItemotalCal(id);
                            })
                            $(".billing-item-dis-amt").on('keyup',function(e){
                                let id = $(this).data('id');
                                billItemotalCal(id);
                            })
                            $(".billing-item-total-payable").on('keyup',function(e){
                                let id = $(this).data('id');
                                billItemotalCal(id);
                            })
                            $('.billing-item-amount').on('keyup',function(e){
                                calculateBill();
                            });


                            $('.remove-btn').on('click',function(e){
                                console.log("Prottoy");
                                $(this).closest("tr").remove();
                                calculateBill();
                            });
                    }
                });

        }
        $(".bill-edit").on('click',function(e){
            let id = $(this).attr('data-bill-id');
                editBill(id);

        });

        $("#billListbtn").on('click',function(e){
            $.ajax({
                    type: 'PUT',
                    dataType: "json",
                    url: "{{url('billing')}}/",
                    data:{
                        'search':"",
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (result) {
                        console.log(result);
                        let element = "";
                        result.forEach(x =>{
                                element+= `<tr>
                                <td id="main-bill-id${x.id}">${x.bill_id}</td>
                                <td id="main-patient-id${x.id}">${x.patient_id}</td>
                                <td id="main-patient-name${x.id}">${x.patient_name}</td>
                                <td id="main-bill-date${x.id}">${x.bill_date}</td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-primary bill-edit" data-id="${x.id}" data-bill-id="${x.bill_id}" >Edit
                                        <i class="fas fa-edit edit-delete-icon" style="color:#eef4f7;" data-id="${x.id}"></i>
                                    </a>
                                    <a class="btn btn-sm btn-secondary" href="{{url('billing-pdf')}}/${x.bill_id}" target="_blank" data-id="${x.id}">Print
                                        <i class="fas fa-print edit-delete-icon" style="color:#ecf3f7;" data-id="${x.id}"></i>
                                    </a>
                                </td>
                            </tr>`
                        });
                        $("#bill_search_list").empty();
                        $("#bill_search_list").append(element);

                        $(".bill-edit").on('click',function(e){
                            let id = $(this).attr('data-bill-id');
                            editBill(id);
                        });
                    }
                });
        })


        function stockEntry(id){
              let storeQty = $('#storeqty'+id).val();
              let medecineID = $('#storeqty'+id).attr('data-id');
              let stockID = $('#storeqty'+id).attr('data-stock-id');
            console.log(id);
            $.ajax({
                    type: 'post',
                    dataType: "json",
                    url: "{{url('medecinestock')}}",
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
                            toastr.success('Stock Updated Successfully for '+response.success.name);

                        }

                    }
                });

        }

        // $("#medecinelist").on('keyup',function(e){
        //     let ch_data = $("#medecinelist").val();
        //     console.log(ch_data);
        //     if((ch_data != '') &&( ch_data.length >= 3)){
        //     $.ajax({
        //             type: 'PUT',
        //             dataType: "json",
        //             url: "{{url('medecinestock')}}/",
        //             data:{
        //                 'search':ch_data,
        //                 '_token': '{{ csrf_token() }}',
        //             },
        //             success: function (result) {
        //                 console.log(result);
        //                 let element = "";
        //                 result.forEach(x =>{
        //                         element += `<tr>
        //                         <td id="main-bill-id${x.id}">${x.bill_id}</td>
        //                         <td id="main-patient-id${x.id}">${x.patient_id}</td>
        //                         <td id="main-patient-name${x.id}">${x.patient_name}</td>
        //                         <td id="main-bill-date${x.id}">${x.bill_date}</td>
        //                         <td class="text-center">
        //                             <a class="btn btn-sm btn-primary bill-edit" data-id="${x.id}" data-bill-id="${x.bill_id}" >Edit
        //                                 <i class="fas fa-edit edit-delete-icon" style="color:#eef4f7;" data-id="${x.id}"></i>
        //                             </a>
        //                             <a class="btn btn-sm btn-secondary" href="{{url('billing-pdf')}}/${x.bill_id}" target="_blank" data-id="${x.id}">Print
        //                                 <i class="fas fa-print edit-delete-icon" style="color:#ecf3f7;" data-id="${x.id}"></i>
        //                             </a>
        //                         </td>
        //                     </tr>`
        //                 });
        //                 $("#bill_search_list").empty();
        //                 $("#bill_search_list").append(element);

        //                 $(".bill-edit").on('click',function(e){
        //                     let id = $(this).attr('data-bill-id');
        //                     editBill(id);
        //                 });
        //             }
        //         });
        //     }

        // });

        $("#medecine-search-btn").on('click',function(e){
            let ch_data = $("#medecinelist").val();
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
                                <td id="name${x.id}">${x.name}</td>
                                <td id="type${x.id}">${x.type}</td>
                                <td id="manufacturer${x.id}">${x.manufacturer}</td>
                                <td id="generic${x.id}">${x.generic}</td>
                                <td id="strength${x.id}">${x.strength}</td>
                                <td id="use-for${x.id}">${x.use_for}</td>
                                <td id="current-stock${x.id}">${x.current_stock==null? 0 : x.current_stock}</td>
                                <td><input class="form-control form-control-sm w-100 text-center" data-id="${x.id}" data-stock-id="${x.stock_id}" type="text" id="storeqty${x.id}" name="qty[${x.item_id}]" value="0"></td>
                                <td class="text-center">
                                    <a class="btn btn-xs btn-success stock-medecine" data-id="${x.id}" data-bill-id="${x.bill_id}" >Save
                                        <i class="fas fa-edit edit-delete-icon pb-1" style="color:#eef4f7;" data-id="${x.id}"></i>
                                    </a>
                                </td>
                            </tr>`
                        });
                        $("#medecine-item-list").empty();
                        $("#medecine-item-list").append(element);

                        $(".stock-medecine").on('click',function(e){
                            let id = $(this).attr('data-id');
                            stockEntry(id);
                        });
                    }
                });
            }

        });


    });

</script>

@endpush
