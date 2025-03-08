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
    <x-breadcumb title="Sales"/>
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
                        <div class="col-sm-4">
                            <a class="btn btn-sm btn-primary float-right" href="{!! route('todaystock.home') !!}" target="_blank" id="print-bill-top">Today Sales Entry</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-sm-12 search-list" style="font-size:14px;height:550px;">
                        <table class="table table-sm">
                            <thead>
                                <th style="width:16%;">Name</th>
                                <th style="width:8%;">Type</th>
                                <th style="width:16%;">Manufacturer</th>
                                <th style="width:8%;">Generic</th>
                                <th style="width:8%;">Cell</th>
                                <th style="width:8%;">MRP Price</th>
                                <th style="width:8%;">Stock</th>
                                <th style="width:8%;">Trade Price</th>
                                <th style="width:8%;">Quantity</th>
                                <th style="width:8%;">Amount</th>
                                <th style="width:6%;">Action</th>
                            </thead>
                            <tbody class="bill-item-list-cl" id="medecine-item-list">
                                @foreach ($medecineList as $item)
                                    <tr>
                                        <td id="name{{$item->id}}">{{$item->name}}</td>
                                        <td id="type{{$item->id}}">{{$item->type}}</td>
                                        <td id="manufacturer{{$item->id}}">{{$item->manufacturer}}</td>
                                        <td id="generic{{$item->id}}">{{$item->generic}}</td>
                                        <td><input class="form-control form-control-sm w-100" data-id="{{$item->id}}" type="text" id="stock-cell{{$item->id}}" name="stock_cell" value="{{$item->stock_cell}}"></td>
                                        <td><input class="form-control form-control-sm w-100" data-id="{{$item->id}}" type="text" id="mrp-rate{{$item->id}}" name="mrp_rate" value="{{$item->mrp_rate}}"></td>
                                        <td><input class="form-control form-control-sm w-100" data-id="{{$item->id}}" type="text" id="current-stock${x.id}" name="qty[${x.current_stock}]" value="{{$item->current_stock}}"></td>
                                        <td><input class="form-control form-control-sm w-100 sale-cel-value" data-id="{{$item->id}}" type="text" id="tp-rate{{$item->id}}" name="tp_rate" value="{{$item->tp_rate}}"></td>
                                        <td><input class="form-control form-control-sm w-100 sale-cel-value" data-id="{{$item->id}}" type="text" id="quantity{{$item->id}}" name="quantity" value="0"></td>
                                        <td><input class="form-control form-control-sm w-100" data-id="{{$item->id}}" type="text" id="amount{{$item->id}}" name="amount" value="0"></td>
                                        <td class="text-center">
                                            <a class="btn btn-xs btn-success sale-medecine" data-id="{{$item->id}}" >sale
                                                {{-- <i class="fas fa-edit edit-delete-icon pb-1" style="color:#eef4f7;" data-id="${x.id}"></i> --}}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <form action="{{route('sales.save')}}" method="post" enctype="multipart/form-data" id="new_billing_details_create">
                    @csrf
                <div class="card-body">

                    <div class="col-sm-12 search-list" style="font-size:14px;height:550px;">
                        <table class="table table-sm">
                            <thead>
                                <th style="width:16%;">Name</th>
                                <th style="width:16%;">Type</th>
                                <th style="width:16%;">MRP Price</th>
                                <th style="width:16%;">Trade Price</th>
                                <th style="width:16%;">Quantity</th>
                                <th style="width:16%;">Amount</th>
                                <th style="width:16%;">Action</th>
                            </thead>
                            <tbody class="bill-final-list-cl" id="medecine-final-list">

                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive mt-5" style="font-size:14px;">
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <th style="text-align: right;">Discount in Amount :</th>
                                    <td><input class="form-control form-control-sm final-bill-field" type="number" step="any" value="0" name="bill_dis_amt" id="bill-dis-amt" /></td>
                                    <th style="text-align: right;">Total Amount :</th>
                                    <td><input class="form-control form-control-sm final-bill-field" type="number" step="any" value="0" name="bill_amount" id="bill-amount" /></td>
                                    <th style="text-align: right;">Total Paid :</th>
                                    <td><input class="form-control form-control-sm final-bill-field" type="number" step="any" value="0" name="bill_paid_amount" id="bill-paid-amount"/></td>
                                </tr>
                                <tr>
                                    <th style="text-align: right;">Discount in Percentage :</th>
                                    <td><input class="form-control form-control-sm final-bill-field" type="number" step="any" value="0" name="bill_in_per" id="bill-in-per"/></td>
                                    <th style="text-align: right;">Net Payable Amount :</th>
                                    <td><input class="form-control form-control-sm final-bill-field" type="number" step="any" value="0" name="bill_total_amount" id="bill-total-amount"/></td>
                                    <th style="text-align: right;">Total Due :</th>
                                    <td><input class="form-control form-control-sm final-bill-field" type="number" step="any" value="0" name="bill_due_amount" id="bill-due-amount"/></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-right m-0 p-1">
                    <button type="reset" class="btn btn-sm btn-danger float-left">&nbsp;Clear&nbsp;</button>
                    <button type="submit" class="btn btn-sm btn-success">&nbsp;Save&nbsp;</button>
                </div>
            </form>
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

        function calculatebill(){

        }

        function saleEntry(id){
              let tp_rate = $('#tp-rate'+id).val();
              let quantity = $('#quantity'+id).val();
              let amount = $('#amount'+id).val();
              let mrp_rate = $('#mrp-rate'+id).val();
              let name = $('#name'+id).text();
              let type = $('#type'+id).text();
              console.log({tp_rate,
                quantity});
                let element = `<tr>
                            <td id="s-name${id}">${name}</td>
                            <td id="s-type${id}">${type}</td>
                            <td><input class="form-control form-control-sm w-100" data-id="${id}" type="text" id="s-mrp-rate${id}" name="mrp_rate" value="${mrp_rate}"></td>
                            <td><input class="form-control form-control-sm w-100 sale-cel-value" data-id="${id}" type="text" id="s-tp-rate${id}" name="tp_rate" value="${tp_rate}"></td>
                            <td><input class="form-control form-control-sm w-100 sale-cel-value" data-id="${id}" type="text" id="s-quantity${id}" name="quantity" value="${quantity}"></td>
                            <td><input class="form-control form-control-sm w-100" data-id="${id}" type="text" id="s-amount${id}" name="amount" value="${amount}"></td>
                            <td class="text-center">
                                 <button type="button" class="btn btn-danger btn-xs remove-btn" title="Remove">
                                                <i class="fas fa-times p-1"></i>
                                            </button>
                            </td>
                        </tr>`
                $("#medecine-final-list").append(element);
                $('.remove-btn').on('click',function(e){
                                    console.log("Prottoy");
                                    $(this).closest("tr").remove();

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
                    url: "{{url('stockmedecine')}}/",
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
                                    <td><input class="form-control form-control-sm w-100" data-id="${x.id}" type="text" id="stock-cell${x.id}" name="stock_cell" value="${x.stock_cell}"></td>
                                    <td><input class="form-control form-control-sm w-100" data-id="${x.id}" type="text" id="mrp-rate${x.id}" name="mrp_rate" value="${x.mrp_rate}"></td>
                                    <td><input class="form-control form-control-sm w-100" data-id="${x.id}" type="text" id="current-stock${x.id}" name="current_stock" value="${x.current_stock}"></td>
                                    <td><input class="form-control form-control-sm w-100 sale-cel-value" data-id="${x.id}" type="text" id="tp-rate${x.id}" name="tp_rate" value="${x.tp_rate}"></td>
                                    <td><input class="form-control form-control-sm w-100 sale-cel-value" data-id="${x.id}" type="text" id="quantity${x.id}" name="quantity" value="0"></td>
                                    <td><input class="form-control form-control-sm w-100" data-id="${x.id}" type="text" id="amount${x.id}" name="amount" value="0"></td>
                                    <td class="text-center">
                                        <a class="btn btn-xs btn-info sale-medecine" data-id="${x.id}" >Update
                                            {{-- <i class="fas fa-edit edit-delete-icon pb-1" style="color:#eef4f7;" data-id="${x.id}"></i> --}}
                                        </a>
                                    </td>
                                </tr>`
                        });
                        $("#medecine-item-list").empty();
                        $("#medecine-item-list").append(element);

                        $(".sale-medecine").on('click',function(e){
                            let id = $(this).attr('data-id');
                            saleEntry(id);
                        });

                        $('.sale-cel-value').on('keyup',function(e){
                            let id = $(this).attr('data-id');
                            let rate = $('#tp-rate'+id).val();
                            let qty = $('#quantity'+id).val();
                            $('#amount'+id).val(Number(rate)*Number(qty));

                        })
                    }
                });
            }

        });

        $(".sale-medecine").on('click',function(e){
            let id = $(this).attr('data-id');
            console.log(id);
            saleEntry(id);
        });

        $('.sale-cel-value').on('keyup',function(e){
            let id = $(this).attr('data-id');
            let rate = $('#tp-rate'+id).val();
            let qty = $('#quantity'+id).val();
            $('#amount'+id).val(Number(rate)*Number(qty));

        })

        $('.remove-btn').on('click',function(e){
                                    console.log("Prottoy");
                                    $(this).closest("tr").remove();

                                });
    });

</script>

@endpush
