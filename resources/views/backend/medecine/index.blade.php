@extends('backend.layout.main')
@section('body-part')
<div class="content-wrapper">
    <x-breadcumb title="Product"/>
    <div class="content">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Product</h3>
                </div>
                <form action="{{route('medecine.save')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" class="form-control form-control-sm" name='name' placeholder="Medecine Name" >
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
                            <div class="col-sm-2">
                                <div class="form-group">
                                  <label>Product Type</label>
                                  <select class="form-control form-control-sm"  name="product_type_id" id="product_type_id" >
                                    <option value="" selected disabled>Please select</option>
                                        @foreach ($product_types as $item )
                                            <option value="{{$item->id}}">{{$item->name_eng}}</option>
                                        @endforeach
                                  </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                  <label>Category</label>
                                  <select class="form-control form-control-sm"  name="product_category_id" id="product_category_id" >
                                        <option value="" selected disabled>Please select</option>
                                        {{-- @foreach ($product_categories as $item )
                                            <option value="{{$item->id}}">{{$item->name_eng}}</option>
                                        @endforeach --}}
                                  </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                  <label>Sub Category</label>
                                  <select class="form-control form-control-sm"  name="product_sub_category_id" id="product_sub_category_id" >
                                        <option value="" selected disabled>Please select</option>
                                        {{-- @foreach ($product_categories as $item )
                                            <option value="{{$item->id}}">{{$item->name_eng}}</option>
                                        @endforeach --}}
                                  </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                  <label>Store Location</label>
                                  <select class="form-control form-control-sm"  name="stock_location_id" id="stock_location">
                                        <option value="" selected disabled>Please select</option>
                                        {{-- @foreach ($store_locations as $item )
                                            <option value="{{$item->id}}">{{$item->name_eng}}</option>
                                        @endforeach --}}
                                  </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>MRP Rate</label>
                                    <input type="text" class="form-control form-control-sm" name='mrp_rate' placeholder="MRP Rate" >
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>TP Rate</label>
                                    <input type="text" class="form-control form-control-sm" name='tp_rate' placeholder="TP Rate" >
                                </div>
                            </div>
                            <div class="col-sm-4 show-hide" style="display: none;">
                                <div class="form-group">
                                    <label>Generic Name</label>
                                    <input type="text" class="form-control form-control-sm" name='generic' id='generic' placeholder="Generic Name">
                                </div>
                            </div>
                            <div class="col-sm-4  show-hide" style="display: none;">
                                <div class="form-group">
                                    <label>Strength Name</label>
                                    <input type="text" class="form-control form-control-sm" name='strength' id='strength' placeholder="Strength">
                                </div>
                            </div>
                            <div class="col-sm-4 show-hide" style="display: none;">
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
                        <button type="submit" class="btn btn-sm btn-success">&nbsp;Save&nbsp;</button>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Medicines</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0" style = "min-height:500px;">
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                            <th style="width: 25%" class="text-center">
                                Product Name<br>Manufacturer
                            </th>
                            <th style="width: 10%" class="text-center">
                                Product Type<br>Category
                            </th>
                            <th style="width: 10%" class="text-center">
                                Sub Category<br>Generic
                            </th>
                            <th style="width: 10%" class="text-center">
                               Stock Location<br>Use For
                            </th>
                            </th>
                            <th style="width: 10%" class="text-center">
                               Stock Quantity <br> Stock Percentage
                            </th>
                            <th style="width: 10%" class="text-center">
                               MRP Rate <br> TP Rate
                            </th>
                            <th class="text-center" style="width: 10%">
                                Action
                            </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($medecines as $item)
                            <tr>
                                <td class="text-center" style="font-weight:bold;">
                                    <blockquote class="blockquote  m-0">
                                        <p class="mb-0">{!! $item->name !!}</p>
                                        <footer class="blockquote-footer">{!! $item->manufacturer !!}</footer>
                                    </blockquote>
                                </td>
                                <td class="text-center align-middle ">
                                    {!! $item->product_type !!}<br>{!! $item->product_category !!}
                                </td>
                                <td class="text-center align-middle ">
                                    <span style="font-weight:bold;">{!! $item->product_sub_category !!}</span><br>{!! $item->generic !!}
                                </td>
                                <td class="text-center align-middle " >
                                   <span class="badge badge-secondary" style="font-size:18px;">{!! $item->stock_location!!}</span><br>{!! $item->use_for !!}
                                </td>
                                <td class="text-center align-middle " style="font-weight:bold;">
                                    <span class="badge {{$item->stock_per >= 50?'badge-success':( $item->stock_per >= 30 ?'badge-warning':'badge-danger')}}" style="font-size:18px;">{!! $item->current_stock !!}</span><br>{!! $item->stock_per !!}%
                                </td>
                                <td class="text-center align-middle " style="font-weight:bold;">
                                    <span class="badge badge-primary" style="font-size:18px;">{!! $item->mrp_rate !!}</span> <br> {!! $item->tp_rate !!}
                                </td>
                                <td class="project-actions text-center align-middle ">
                                    <a class="btn btn-info btn-sm update p-1" data-id="{{$item->id}}">
                                        <i style="font-size:10px;" class="fas fa-pencil-alt">
                                        </i>

                                    </a>
                                    <a class="btn btn-danger btn-sm delete p-1" href="#" data-id="{{$item->id}}" data-toggle="modal" data-target="#modal-default">
                                        <i style="font-size:10px;" class="fas fa-trash">
                                        </i>

                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="m-3">
                    {{ $medecines->links('pagination::bootstrap-4')}}
                </div>
            </div>
            <div class="modal fade" id="modal-default-delete">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <form action="" method="post" id="delete-modal">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header">
                                <h4 class="modal-title">Delete Medecine</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>One fine body&hellip;</p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-default-update">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <form action="" method="post" id="update-modal">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h4 class="modal-title">Update Product Information</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Product Name</label>
                                                <input type="text" class="form-control form-control-sm" name='name' id="u-name" placeholder="Medecine Name" >
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="dropdown">
                                                <div class="form-group">
                                                    <label>Manufacturer Name</label>
                                                    <input type="text" class="form-control form-control-sm" name='manufacturer' id="u-manufacturer" placeholder="Manufacturer Name">
                                                </div>
                                                <div class="dropdown-menu w-100" style="max-height:350px;overflow-y:scroll;" id="u-dropdown-menu" aria-labelledby="dLabel">
                                                    @foreach($manufacturers as $item)
                                                        <li class="dropdown-item" >{{$item->name_eng}}</li>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                            <label>Product Type</label>
                                            <select class="form-control form-control-sm"  name="product_type_id" id="u-product_type_id" >
                                                <option value="" selected disabled>Please select</option>
                                                    @foreach ($product_types as $item )
                                                        <option value="{{$item->id}}">{{$item->name_eng}}</option>
                                                    @endforeach
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control form-control-sm"  name="product_category_id" id="u-product_category_id" >
                                                    <option value="" selected disabled>Please select</option>
                                                    @foreach ($product_categories as $item )
                                                        <option value="{{$item->id}}">{{$item->name_eng}}</option>
                                                    @endforeach
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                            <label>Sub Category</label>
                                            <select class="form-control form-control-sm"  name="product_sub_category_id" id="u-product_sub_category_id" >
                                                    <option value="" selected disabled>Please select</option>
                                                    @foreach ($product_sub_categories as $item )
                                                        <option value="{{$item->id}}">{{$item->name_eng}}</option>
                                                    @endforeach
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                            <label>Store Location</label>
                                            <select class="form-control form-control-sm"  name="stock_location_id" id="u-stock_location_id">
                                                    <option value="" selected disabled>Please select</option>
                                                    @foreach ($store_locations as $item )
                                                        <option value="{{$item->id}}">{{$item->name_eng}}</option>
                                                    @endforeach
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>MRP Rate</label>
                                                <input type="text" class="form-control form-control-sm" name='mrp_rate' id="u-mrp_rate" placeholder="MRP Rate" >
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>TP Rate</label>
                                                <input type="text" class="form-control form-control-sm" name='tp_rate' id="u-tp_rate" placeholder="TP Rate" >
                                            </div>
                                        </div>
                                        <div class="col-sm-4 show-hide" style="display: none;">
                                            <div class="form-group">
                                                <label>Generic Name</label>
                                                <input type="text" class="form-control form-control-sm" name='generic' id='u-generic' placeholder="Generic Name">
                                            </div>
                                        </div>
                                        <div class="col-sm-4  show-hide" style="display: none;">
                                            <div class="form-group">
                                                <label>Strength Name</label>
                                                <input type="text" class="form-control form-control-sm" name='strength' id='u-strength' placeholder="Strength">
                                            </div>
                                        </div>
                                        <div class="col-sm-4 show-hide" style="display: none;">
                                            <div class="form-group">
                                            <label>Use For</label>
                                            <select class="form-control form-control-sm"  name="medicine_use_for_id" id="u-medicine_use_for_id">
                                                    <option value="" selected disabled>Please select</option>
                                                    @foreach ($medecineusages as $item )
                                                        <option value="{{$item->id}}">{{$item->name_eng}}</option>
                                                    @endforeach
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between" id="up-pl">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-warning">Update</button>
                            </div>
                        </form>
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


        // $('#store_location').select2({
        //     theme: 'bootstrap4',
        //     });

        $('#stock_location').select2({
            placeholder: 'Search for a Product',
            minimumInputLength: 2, // API call triggers after 2 characters
            ajax: {
                type: 'put',
                url: 'stock_locations', // Your API endpoint
                dataType: 'json',
                cache: true, // Enable caching
                delay: 250, // delay in ms before request
                data: function (params) {
                    return {
                        'q': params.term,
                        '_token': "{{ csrf_token() }}" // search term
                    };
                },
                processResults: function (data) {
                    // Map your API response to { id, text }
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.name_eng
                        }))
                    };
                },
                cache: true
            }
        });

        
        // $('#stock_location').select2('open');
        setTimeout(function() {
            $('#stock_location').select2('open');
            }, 200);

    $('#stock_location').on('select2:open', function () {
            let searchField = document.querySelector('.select2-container--open .select2-search__field');
            if (searchField) {
                searchField.focus();
            }
        });

    setTimeout(() => {
        $('#stock_location').select2('close');
    }, 5000);




        $(".delete").on('click',function(e){
            let id = $(this).attr("data-id");
            let link = "{{url('medecine/')}}/"+id;
            $('#modal-default-delete').modal('show');
            $('#delete-modal').attr('action',link);
        });
        $(".update").on('click',function(e){
            let id = $(this).attr("data-id");
                $.ajax({
                    url: "{{url('medecine/')}}/"+id,
                    success: function (result) {
                        console.log(result);
                        $('#u-name').val(result.name)
                        $('#u-manufacturer').val(result.manufacturer)
                        $('#u-generic').val(result.generic)
                        $('#u-strength').val(result.strength)
                        $('#u-mrp_rate').val(result.mrp_rate)
                        $('#u-tp_rate').val(result.tp_rate)
                        $('#u-stock_location_id').val(result.stock_location_id)
                        $('#u-product_sub_category_id').val(result.product_sub_category_id)
                        $('#u-medicine_use_for_id').val(result.medicine_use_for_id)
                        $('#u-product_category_id').val(result.product_category_id)
                        $('#u-product_type_id').val(result.product_type_id)
                        if(result.product_type_id==1){
                            $('.show-hide').toggle();
                        }

                    }
                });
            let link = "{{url('medecine/')}}/"+id;
            $('#update-modal').attr('action',link);
            $('#modal-default-update').modal('show');

        });

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

        $("#product_type_id").on('change',function(e){
                let id = $("#product_type_id").val();
                console.log(id)
                if(id == 1){
                    $('.show-hide').toggle();
                }else{
                    $('.show-hide').hide();
                }
                $.ajax({
                    url: "{{url('productcategory/listbytype/')}}/"+id,
                    success: function (result) {
                        let element = `<option value="" selected disabled>Please select</option>`;
                        console.log(result);
                        result.forEach(x => {
                            element +=`<option value="${x.id}">${x.name_eng}</option>`;
                        });

                        $("#product_category_id").empty();
                        $("#product_category_id").append(element);
                    
                    }
                });
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

        $("#u-product_category_id").on('change',function(e){
            let id = $("#u-product_category_id").val();
                $.ajax({
                    url: "{{url('productsubcategory/listbycategory/')}}/"+id,
                    success: function (result) {
                        let element = `<option value="" selected disabled>Please select</option>`;
                        console.log(result);
                        result.forEach(x => {
                            element +=`<option value="${x.id}">${x.name_eng}</option>`;
                        });

                        $("#u-product_sub_category_id").empty();
                        $("#u-product_sub_category_id").append(element);
                       
                    }
                });
           

        });



        $("#u-manufacturer").on('keyup',function(){
            var value = $(this).val().toLowerCase();
            let result = false;
            $("#u-dropdown-menu li").filter(function() {
                if(!result) result = $(this).text().toLowerCase().indexOf(value) > -1;
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
            console.log(result);
            if(result) $("#u-dropdown-menu").show();
            else $("#u-dropdown-menu").hide();

            $('#u-dropdown-menu li').on('mouseenter', function() {
                $(this).css('background-color', 'lightgreen');
            });

            $('#u-dropdown-menu li').on('mouseleave', function() {
                $(this).css('background-color', 'white');
            });

        })
        $("#u-dropdown-menu li").on('click',function(e){
            $("#u-manufacturer").val($(this).text());
            $("#u-dropdown-menu").hide();
        })
        $("#u-manufacturer").on('focusout',function(){
            $("#u-dropdown-menu").fadeOut()
        })
        $("#u-manufacturer").on('focusin',function(){
            var value = $(this).val().toLowerCase();
            let result = false;
            $("#u-dropdown-menu li").filter(function() {
                if(!result) result = $(this).text().toLowerCase().indexOf(value) > -1;
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
            console.log(result);
            if(result) $("#u-dropdown-menu").show();
            else $("#u-dropdown-menu").hide();

            $('#u-dropdown-menu li').on('mouseenter', function() {
                $(this).css('background-color', 'lightgreen');
            });

            $('#u-dropdown-menu li').on('mouseleave', function() {
                $(this).css('background-color', 'white');
            });
        })

    });

</script>

@endpush
