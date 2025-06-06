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
                            <input type="text" class="form-control form-control-md" id="medecinelist" name="medecine_list" placeholder="Search">
                        </div>
                        <div class="col-sm-1">
                            <button class="btn btn-md btn-warning" id="medecine-search-btn">search</button>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <select class="form-control form-control-xs"  name="manufacturer" id="manufacturer">
                                    <option value="" disabled selected>Please select</option>
                                    @foreach($manufacturer as $item )
                                        <option value="{{$item->name_eng}}">{{$item->name_eng}}</option>
                                    @endforeach
                                </select>
                              </div>
                        </div>
                        <div class="col-sm-4">
                            <a class="btn btn-md btn-primary float-right" id="add-new-item">
                                <i class="fas fa-plus mr-2"></i>
                                ADD NEW
                            </a>
                            <div class="modal fade" id="modal-default-add">
                                <div class="modal-dialog modal-xl m-10">
                                    <div class="modal-content" style="width: 1300px;">
                                        <div class="modal-header">
                                            <h4 class="modal-title">ADD NEW ITEM</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                 <div class="col-sm-7">
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control form-control-sm" id="medecinelistnew" name="medecine_list_new" placeholder="Search">
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-sm btn-warning float-left" id="medecine-search-btn-new">search</button>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 search-list mt-2" style="font-size:14px;height:550px;">
                                                <table class="table table-sm">
                                                    <thead>
                                                        <th style="width:20%;">Name</th>
                                                        <th style="width:10%;">Type</th>
                                                        <th style="width:20%;">Manufacturer</th>
                                                        <th style="width:20%;">Use For</th>
                                                        <th style="width:20%;">Generic</th>
                                                        <th style="width:20%;">Category</th>
                                                        <th style="width:6%;">Action</th>
                                                    </thead>
                                                    <tbody class="bill-item-list-cl" id="medecine-item-list-new">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-9 search-list" style="font-size:14px;height:400px;">
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
                                            <input class="form-control form-control-md w-100" type="text" id="name" name="name" value="" readonly>
                                            <input type="hidden" id="item-id" name="item_id" value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:30%;">Cell</td>
                                        <td style="width:70%;">
                                            <input class="form-control form-control-md w-100" type="text" id="stock-cell" name="stock_cell" value="">
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
                                            <input class="form-control form-control-md w-100" type="text" id="tp-rate" name="tp_rate" value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:30%;">Stock Percentage</td>
                                        <td style="width:70%;">
                                            <input class="form-control form-control-md w-100" type="text" id="stock_per" name="stock_per" value=""  readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:30%;">Current Stock</td>
                                        <td style="width:70%;">
                                            <input class="form-control form-control-md w-100" type="text" id="current-stock" data-current-stock="" name="current_stock" value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:30%;">Stock Quantity</td>
                                        <td style="width:70%;">
                                            <input class="form-control form-control-md w-100" type="text" id="stock-quantity" name="stock_quantity" value="">
                                        </td>
                                    </tr>
                                    <tr><td style="width:30%;">Expire Date</td>
                                        <td style="width:70%;">
                                            <div class="input-group date" id="birth_date" data-target-input="nearest">
                                                <input type="text" class="form-control form-control-sm datetimepicker-input" data-target="#birth_date" name="expire_date" id="expire-date"/>
                                                <div class="input-group-append" data-target="#birth_date" data-toggle="datetimepicker">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="card-footer text-right pl-0 pr-0">
                                <button type="reset" class="btn btn-sm btn-danger float-left">&nbsp;Clear&nbsp;</button>
                                <button type="submit" class="btn btn-sm btn-success" id="save-btn">&nbsp;Save&nbsp;</button>
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
           
            $('#birth_date').datetimepicker({
                format: 'YYYY-MM-DD',
            });
        });


        $('#stock-quantity').on('keyup',function(e){
            let currentStock =  $("#current-stock").attr("data-current-stock");
            let stockQuantity = $("#stock-quantity").val();
            $("#current-stock").val((Number(currentStock)+Number(stockQuantity)));
        });

        $("#save-btn").on("click",function(e){

            let itemId = $("#item-id").val();
            let name = $("#name").val();
            let stockCell = $("#stock-cell").val();
            let mrpRate = $("#mrp-rate").val();
            let tpRate = $("#tp-rate").val();
            let stockPer = $("#stock_per").val();
            let currentStock = $("#current-stock").val();
            let stockQuantity = $("#stock-quantity").val();
            let expireDate = $("#expire-date").val();
            console.log(expireDate);
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
                    toastr.success('Item Updated Successfully for '+response.success.name);
                    $("#item-id").val(response.success.id);
                        $("#name").val(response.success.name);
                        $("#stock-cell").val(response.success.stock_cell);
                        $("#mrp-rate").val(response.success.mrp_rate);
                        $("#tp-rate").val(response.success.tp_rate);
                        $("#stock_per").val(response.success.stock_per);
                        $("#current-stock").val(response.success.current_stock);
                        $("#current-stock").attr("data-current-stock",response.success.current_stock);
                        $("#stock-quantity").val(0);
                        $("#expire-date").val("");

                }
            });

        });

        function setItem(id){
            console.log(id);
            $.ajax({
                    type: 'get',
                    dataType: "json",
                    url: "{{url('medecinestock')}}/"+id,
                    success: function (result) {
                        console.log(result);
                        $("#item-id").val(result.id);
                        $("#name").val(result.name);
                        $("#stock-cell").val(result.stock_cell);
                        $("#mrp-rate").val(result.mrp_rate);
                        $("#tp-rate").val(result.tp_rate);
                        $("#stock_per").val(result.stock_per);
                        $("#current-stock").val(result.current_stock);
                        $("#current-stock").attr("data-current-stock",result.current_stock);
                        $("#stock-quantity").val(0);
                        $("#expire-date").val("");
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
            let use_for = $("#use_for"+id).val();
            let category = $("#category"+id).val();
            console.log({
                    'name':name,
                    'type':type,
                    'manufacturer':manufacturer,
                    'generic':generic,
                    'use_for':use_for,
                    'category':category,
                    '_token': '{{ csrf_token() }}',
                });
            $.ajax({
                type: 'post',
                dataType: "json",
                url: "{{url('medecinestock')}}",
                data:{
                    'name':name,
                    'type':type,
                    'manufacturer':manufacturer,
                    'generic':generic,
                    'use_for':use_for,
                    'category':category,
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

    });

</script>

@endpush
