@extends('backend.layout.main')
@section('body-part')
<div class="content-wrapper">
    <x-breadcumb title="Other Products"/>
    <div class="content">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Other Products</h3>
                </div>
                <form action="{{route('otherproducts.save')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                <label>Product Type</label>
                                <select class="form-control form-control-sm"  name="product_type_id" id="product_type_id" required>
                                    <option value="" selected disabled>Please select</option>
                                        @foreach ($product_types as $item )
                                            <option value="{{$item->id}}">{{$item->name_eng}}</option>
                                        @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                  <label>Product Category</label>
                                  <select class="form-control form-control-sm"  name="product_category_id" id="product_category_id" required>
                                        <option value="" selected disabled>Please select</option>
                                        {{-- @foreach ($product_categories as $item )
                                            <option value="{{$item->id}}">{{$item->name_eng}}</option>
                                        @endforeach --}}
                                  </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                  <label>Product Sub-Category</label>
                                  <select class="form-control form-control-sm"  name="product_sub_category_id" id="product_sub_category_id" required>
                                        <option value="" selected disabled>Please select</option>
                                        {{-- @foreach ($product_sub_categories as $item )
                                            <option value="{{$item->id}}">{{$item->name_eng}}</option>
                                        @endforeach --}}
                                  </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" class="form-control form-control-sm" name='name' placeholder="Product Name">
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
                            <th style="width: 5%">
                                SL
                            </th>
                            <th style="width: 25%" class="text-center">
                                Product Name
                            </th>
                            <th style="width: 20%" class="text-center">
                                Manufacturer
                            </th>
                            <th style="width: 10%" class="text-center">
                                Type
                            </th>
                            <th style="width: 10%" class="text-center">
                               Category
                            </th>
                            <th style="width: 10%" class="text-center">
                               Sub-Category
                            </th>
                            <th class="text-center" style="width: 25%">
                                Action
                            </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $item)
                            <tr>
                                <td>
                                   #
                                </td>
                                <td class="text-center" style="font-weight:bold;">
                                    {!! $item->name !!}
                                </td>
                                <td class="text-center" style="font-weight:bold;">
                                    {!! $item->manufacturer !!}
                                </td>
                                <td class="text-center" style="font-weight:bold;">
                                    {!! $item->product_type !!}
                                </td>
                                <td class="text-center" style="font-weight:bold;">
                                    {!! $item->product_category !!}
                                </td>
                                <td class="text-center" style="font-weight:bold;">
                                    {!! $item->product_sub_category !!}
                                </td>
                                <td class="project-actions text-center">
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
                    {{ $products->links('pagination::bootstrap-4')}}
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
                                @csrf
                                <div class="card-body">
                                     <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Product Name</label>
                                                <input type="text" class="form-control form-control-sm" name='name' id="u-name" placeholder="Product Name">
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
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                            <label>Product Type</label>
                                            <select class="form-control form-control-sm"  name="product_type_id" id="u-product_type_id">
                                                <option value="" selected disabled>Please select</option>
                                                    @foreach ($product_types as $item )
                                                        <option value="{{$item->id}}">{{$item->name_eng}}</option>
                                                    @endforeach
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                            <label>Product Category</label>
                                            <select class="form-control form-control-sm"  name="product_category_id" id="u-product_category_id">
                                                    <option value="" selected disabled>Please select</option>
                                                    @foreach ($product_categories as $item )
                                                        <option value="{{$item->id}}">{{$item->name_eng}}</option>
                                                    @endforeach
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                            <label>Product Sub-Category</label>
                                            <select class="form-control form-control-sm"  name="product_sub_category_id" id="u-product_sub_category_id">
                                                    <option value="" selected disabled>Please select</option>
                                                    @foreach ($product_sub_categories as $item )
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
        $(".delete").on('click',function(e){
            let id = $(this).attr("data-id");
            let link = "{{url('otherproducts/')}}/"+id;
            $('#modal-default-delete').modal('show');
            $('#delete-modal').attr('action',link);
        });
        $(".update").on('click',function(e){
            let id = $(this).attr("data-id");
                $.ajax({
                    url: "{{url('otherproducts/')}}/"+id,
                    success: function (result) {
                        console.log(result);
                        $('#u-name').val(result.name)
                        $('#u-manufacturer').val(result.manufacturer)
                        $('#u-product_type_id').val(result.product_type_id)
                        $('#u-product_sub_category_id').val(result.product_sub_category_id)
                        $('#u-product_category_id').val(result.product_category_id)

                    }
                });
            let link = "{{url('otherproducts/')}}/"+id;
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
