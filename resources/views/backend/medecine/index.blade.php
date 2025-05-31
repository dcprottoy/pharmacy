@extends('backend.layout.main')
@section('body-part')
<div class="content-wrapper">
    <x-breadcumb title="Medecine"/>
    <div class="content">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Medecine</h3>
                </div>
                <form action="{{route('medecine.save')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Medecine Name</label>
                                    <input type="text" class="form-control form-control-sm" name='name' placeholder="Medecine Name">
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
                                    <input type="text" class="form-control form-control-sm" name='generic' placeholder="Generic Name">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Strength Name</label>
                                    <input type="text" class="form-control form-control-sm" name='strength' placeholder="Strength">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                  <label>Type</label>
                                  <select class="form-control form-control-sm"  name="type" id="type">
                                    <option value="" selected disabled>Please select</option>
                                        @foreach ($medecinetypes as $item )
                                            <option value="{{$item->id}}">{{$item->name_eng}}</option>
                                        @endforeach
                                  </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                  <label>Category</label>
                                  <select class="form-control form-control-sm"  name="category" id="category">
                                        <option value="" selected disabled>Please select</option>
                                        @foreach ($medecinecategories as $item )
                                            <option value="{{$item->id}}">{{$item->name_eng}}</option>
                                        @endforeach
                                  </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                  <label>Use For</label>
                                  <select class="form-control form-control-sm"  name="use_for" id="use_for">
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
                    <h3 class="card-title">Store</h3>
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
                    <table class="table table-sm table-striped projects">
                        <thead>
                            <tr>
                            <th style="width: 5%">
                                SL
                            </th>
                            <th style="width: 25%" class="text-center">
                                Mdecine Name
                            </th>
                            <th style="width: 20%" class="text-center">
                                Manufacturer
                            </th><th style="width: 10%" class="text-center">
                                Generic
                            </th><th style="width: 10%" class="text-center">
                                Strength
                            </th><th style="width: 10%" class="text-center">
                                Type
                            </th><th style="width: 10%" class="text-center">
                               Use For
                            </th>
                            </th><th style="width: 10%" class="text-center">
                               Category
                            </th>
                            <th class="text-center" style="width: 25%">
                                Action
                            </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($medecines as $item)
                            <tr>
                                <td>
                                   #
                                </td>
                                <td class="text-center" style="font-weight:bold;">
                                    {!! $item->name !!}
                                </td>
                                <td class="text-center" style="font-weight:bold;">
                                    {!! $item->manufacturer !!}
                                </td><td class="text-center" style="font-weight:bold;">
                                    {!! $item->generic !!}
                                </td><td class="text-center" style="font-weight:bold;">
                                    {!! $item->strength !!}
                                </td><td class="text-center" style="font-weight:bold;">
                                    {!! $item->type !!}
                                </td><td class="text-center" style="font-weight:bold;">
                                    {!! $item->use_for !!}
                                </td>
                                </td><td class="text-center" style="font-weight:bold;">
                                    {!! $item->category=='alo'?"Allopathy":"" !!}
                                </td>
                                <td class="project-actions text-center">
                                    <a class="btn btn-info btn-sm update" data-id="{{$item->id}}">
                                        <i style="font-size:10px;" class="fas fa-pencil-alt">
                                        </i>

                                    </a>
                                    <a class="btn btn-danger btn-sm delete" href="#" data-id="{{$item->id}}" data-toggle="modal" data-target="#modal-default">
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
                                <h4 class="modal-title">Update Medecine Information</h4>
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
                                                    <label>Medecine Name</label>
                                                    <input type="text" class="form-control form-control-sm" name='name' id="u-name" placeholder="Medecine Name">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Manufacturer Name</label>
                                                    <input type="text" class="form-control form-control-sm" name='manufacturer' id="u-manufacturer" placeholder="Manufacturer Name">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Generic Name</label>
                                                    <input type="text" class="form-control form-control-sm" name='generic' id="u-generic" placeholder="Generic Name">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Strength Name</label>
                                                    <input type="text" class="form-control form-control-sm" name='strength' id="u-strength" placeholder="Strength">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Type</label>
                                                    <input type="text" class="form-control form-control-sm" name='type' id="u-type" placeholder="Type">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Use For</label>
                                                    <input type="text" class="form-control form-control-sm" name='use_for' id="u-use_for" placeholder="Use For">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                  <label>Category</label>
                                                  <select class="form-control form-control-sm"  name="category" id="category" id="u-category">
                                                    <option value="" disabled>Please select</option>
                                                    <option value="alo">Allopathy</option>

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
                        $('#u-type').val(result.type)
                        $('#u-use_for').val(result.use_for)
                        $('#u-category').val(result.category)

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



    });

</script>

@endpush
