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
    <x-breadcumb title="Stock Entry"/>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-9">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>MRR NO.</label>
                                        <input type="text" class="form-control form-control-sm" name='mrr_no' id="mrr_no" placeholder="MRR NO" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="dropdown">
                                        <div class="form-group">
                                            <label>Supplier </label>
                                            <input type="text" class="form-control form-control-sm" name='supplier_name' id="supplier_name" placeholder="Supplier Name">
                                        </div>
                                        <div class="dropdown-menu w-100" style="max-height:350px;overflow-y:scroll;" id="suuplier-dropdown-menu" aria-labelledby="dLabel">
                                            @foreach($suppliers as $item)
                                                <li class="dropdown-item" >{{$item->name_eng}}</li>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Challan No.</label>
                                        <input type="text" class="form-control form-control-sm" name='challan_no' id="challan_no" placeholder="Challan No">
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="reset" class="btn btn-sm btn-info" id="mrr_create_new">&nbsp;Create New&nbsp;</button>
                                <button type="submit" class="btn btn-sm btn-success" id="add-new-mrr">&nbsp;Save&nbsp;</button>
                                <button type="submit" class="btn btn-sm btn-danger" id="done-mrr">&nbsp;Done&nbsp;</button>

                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="form-group">
                                <label>Search MRR NO.</label>
                                <input type="text" class="form-control form-control-sm" name='mrr_no_search' id="mrr_no_search" placeholder="MRR NO">
                            </div>
                            <div class="dropdown-menu w-100" style="max-height:350px;overflow-y:scroll;" id="mrr_dropdown-menu" aria-labelledby="dLabel">
                               
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
                        <div class="col-sm-2">
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
                                            <div class="dropdown">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm" name='search_new_data' id="search_new_data" placeholder="Medicine Name">
                                                </div>
                                                <div class="dropdown-menu" style="max-height:350px;min-width:100%;overflow-y:scroll;" id="search_new_dropdown-menu" aria-labelledby="dLabel">
                                                    
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Medecine Name</label>
                                                            <input type="text" class="form-control form-control-sm" name='name' id='item_name' placeholder="Medecine Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="dropdown">
                                                            <div class="form-group">
                                                                <label>Manufacturer Name</label>
                                                                <input type="text" class="form-control form-control-sm" name='manufacturer' id="manufacturer" placeholder="Manufacturer Name">
                                                            </div>
                                                            <div class="dropdown-menu w-100" style="max-height:350px;overflow-y:scroll;" id="dropdown-menu" aria-labelledby="dLabel">
                                                                @foreach($manufacturers as $item)
                                                                    <li class="dropdown-item" >{{$item->name_eng}}</li>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Generic Name</label>
                                                            <input type="text" class="form-control form-control-sm" name='generic' id='generic' placeholder="Generic Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Strength Name</label>
                                                            <input type="text" class="form-control form-control-sm" name='strength' id='strength' placeholder="Strength">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                        <label>Category</label>
                                                        <select class="form-control form-control-sm"  name="product_category_id" id="product_category_id">
                                                                <option value="" selected disabled>Please select</option>
                                                                @foreach ($product_categories as $item )
                                                                    <option value="{{$item->id}}">{{$item->name_eng}}</option>
                                                                @endforeach
                                                        </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                        <label>Medicine Type</label>
                                                        <select class="form-control form-control-sm"  name="product_sub_category_id" id="product_sub_category_id">
                                                            <option value="" selected disabled>Please select</option>
                                                                @foreach ($product_types as $item )
                                                                    <option value="{{$item->id}}">{{$item->name_eng}}</option>
                                                                @endforeach
                                                        </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                        <label>Use For</label>
                                                        <select class="form-control form-control-sm"  name="medicine_use_for_id" id="medicine_use_for_id">
                                                                <option value="" selected disabled>Please select</option>
                                                                @foreach ($medecineusages as $item )
                                                                    <option value="{{$item->id}}">{{$item->name_eng}}</option>
                                                                @endforeach
                                                        </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-right">
                                                <button type="reset" class="btn btn-sm btn-danger float-left">&nbsp;Clear&nbsp;</button>
                                                <button type="submit" class="btn btn-sm btn-success" id="new_add_button">&nbsp;Save&nbsp;</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                        <div class="col-sm-9 search-list" style="font-size:14px;height:400px;">
                            <table class="table table-sm">
                                <thead>
                                    <th style="width:20%;">Name</th>
                                    <th style="width:20%;">MFG Date</th>
                                    <th style="width:25%;">Expire Date</th>
                                    <th style="width:25%;">Stock Quantity</th>
                                    <th style="width:10%;">Action</th>
                                </thead>
                                <tbody class="bill-item-list-cl" id="medecine-item-list">
                                    
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
                                            <input class="form-control form-control-md w-100" type="text" id="stock-location" name="stock_location" value="">
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
                                     <tr>
                                        <td style="width:30%;">Manufacture Date</td>
                                        <td style="width:70%;">
                                            <div class="input-group date" id="manufacture_date" data-target-input="nearest">
                                                <input type="text" class="form-control form-control-sm datetimepicker-input" data-target="#manufacture_date" name="manufacture_date" id="manufacture-date"/>
                                                <div class="input-group-append" data-target="#manufacture_date" data-toggle="datetimepicker">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:30%;">Expire Date</td>
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

        //Add New Mrr No.
        $("#mrr_create_new").on('click',function(){
            $("#mrr_no").val("");
            $("#supplier_name").val("");
            $("#challan_no").val("");
            $("#add-new-mrr").show();
        });
        //Save New Mrr No.
        $("#add-new-mrr").on('click',function(){
            let supplier = $("#supplier_name").val();
            let challan =   $("#challan_no").val();
            if(!supplier || !challan){
                toastr.error('Enter Supplier And Challan No. Both');
            }
            
            $.ajax({
                type: 'post',
                dataType: "json",
                url: "{{url('mrr')}}",
                data:{
                    '_token': '{{ csrf_token() }}',
                    'supplier_name': supplier,
                    'challan_no': challan,
                },
                success: function (response) {
                    console.log(response);
                    $("#mrr_no").val(response.mrr_id);
                    $("#supplier_name").val(response.supplier_name);
                    $("#challan_no").val(response.challan_no);
                    toastr.success('MRR Created Successfully');
                    $("#add-new-mrr").hide();
                    $("#medecine-item-list").empty();

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
                                element += `<li class="dropdown-item" >${x.mrr_id}</li>`;
                        });
                        $("#mrr_dropdown-menu").empty();
                        $("#mrr_dropdown-menu").append(element);
                        $("#mrr_dropdown-menu li").on('click',function(e){
                            $("#mrr_no_search").val('');
                            let mrr_no = $(this).text();
                            $.ajax({
                                type: 'get',
                                dataType: "json",
                                url: "{{url('mrr')}}/"+mrr_no,
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
                                                        <input class="form-control form-control-sm w-100" type="text" id="stock_qty${x.id}"" name="stock_per" value="${x.stock_qty}">
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
                                        $("#medecine-item-list").append(element);
                                        $('.update').off('click').on('click',function(e){
                                            let id = $(this).attr('data-id');
                                            updateStockEntry(id);
                                        })
                                        $('.delete').off('click').on('click',function(e){
                                            let id = $(this).attr('data-id');
                                            deleteStockEntry(id);
                                        })
                                        $(".item-select").off('click').on('click',function(e){
                                            let id = $(this).attr('data-medicine-id');
                                            setItem(id);
                                        });

                                    

                                    $("#add-new-mrr").hide();
                                }
                            });
                            $("#mrr_dropdown-menu").hide();
                        });
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
                        $("#stock-location").val(result.stock_location);
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
                                                <span>${x.product_category}</span>
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
                            toastr.warning(response.message);
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
                let stockCell = $("#stock-location").val();
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
                            'stock_location':stockCell,
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