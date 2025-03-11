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
    <x-breadcumb title="Store Medecine"/>
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
                            <a class="btn btn-sm btn-primary float-right" id="add-new-item">
                                <i class="fas fa-plus mr-2"></i>
                                ADD NEW
                            </a>
                            <div class="modal fade" id="modal-default-add">
                                <div class="modal-dialog modal-xl m-10">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">ADD NEW ITEM</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card">
                                                <div class="card-header p-2">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control form-control-sm" id="medecinelistnew" name="medecine_list_new" placeholder="Search">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <button class="btn btn-sm btn-warning float-left" id="medecine-search-btn-new">search</button>
                                                        </div>
                                                    </div>
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
                                                                <th style="width:6%;">Action</th>
                                                            </thead>
                                                            <tbody class="bill-item-list-cl" id="medecine-item-list-new">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between" id="up-pl">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-warning">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-8 search-list" style="font-size:14px;height:550px;">
                            <table class="table table-sm">
                                <thead>
                                    <th style="width:16%;">Name</th>
                                    <th style="width:8%;">Type</th>
                                    <th style="width:16%;">Manufacturer</th>
                                    <th style="width:8%;">Generic</th>
                                </thead>
                                <tbody class="bill-item-list-cl" id="medecine-item-list">
                                    @foreach ($medecineList as $item)
                                        <tr>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->type}}</td>
                                            <td>{{$item->manufacturer}}</td>
                                            <td>{{$item->generic}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-4">
                            <table>
                                <thead>
                                    <th style="width:50%;">Attribute</th>
                                    <th style="width:50%;">Value</th>
                                </thead>
                                <tbody>
                                    <tr><td style="width:50%;">Name</td><td style="width:50%;"><input class="form-control form-control-sm w-100" data-id="{{$item->id}}" type="text" id="stock-cell{{$item->id}}" name="stock_cell" value="{{$item->stock_cell}}"></td></tr>
                                    <tr><td style="width:50%;">Cell</td><td style="width:50%;"><input class="form-control form-control-sm w-100" data-id="{{$item->id}}" type="text" id="stock-cell{{$item->id}}" name="stock_cell" value="{{$item->stock_cell}}"></td></tr>
                                    <tr><td style="width:50%;">MRP Price</td><td style="width:50%;"><input class="form-control form-control-sm w-100" data-id="{{$item->id}}" type="text" id="mrp-rate{{$item->id}}" name="mrp_rate" value="{{$item->mrp_rate}}"></td></tr>
                                    <tr><td style="width:50%;">Trade Price</td><td style="width:50%;"><input class="form-control form-control-sm w-100" data-id="{{$item->id}}" type="text" id="tp-rate{{$item->id}}" name="tp_rate" value="{{$item->tp_rate}}"></td></tr>
                                    <tr><td style="width:50%;">Stock Percentage</td><td style="width:50%;"><input class="form-control form-control-sm w-100" data-id="{{$item->id}}" type="text" id="stock_per{{$item->id}}" name="stock_per" value="{{$item->stock_per}}"></td></tr>
                                    <tr><td style="width:50%;">Last Stock</td><td style="width:50%;"><input class="form-control form-control-sm w-100" data-id="{{$item->id}}" type="text" id="last-stock{{$item->id}}" name="last_stock" value="{{$item->last_stock}}"></td></tr>
                                    <tr><td style="width:50%;">Current Stock</td><td style="width:50%;"><input class="form-control form-control-sm w-100" data-id="{{$item->id}}" type="text" id="current-stock${x.id}" name="qty[${x.current_stock}]" value="{{$item->current_stock}}"></td></tr>
                                </tbody>
                            </table>
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
                            $('#storeqty'+id).attr('data-stock-id',response.success.id);
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
                                    <td>${x.name}</td>
                                    <td>${x.type}</td>
                                    <td>${x.manufacturer}</td>
                                    <td>${x.generic}</td>
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

    });

</script>

@endpush
