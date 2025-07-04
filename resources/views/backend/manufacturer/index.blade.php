@extends('backend.layout.main')
@section('body-part')
<div class="content-wrapper">
    <x-breadcumb title="Manufacturer"/>
    <div class="content">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Manufacturer</h3>
                </div>
                <form action="{{route('manufacturer.save')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label> Manufacturer Name</label>
                                    <input type="text" class="form-control form-control-sm" name='name_eng' placeholder="Manufacturer Name">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                <label>Product Type</label>
                                <select class="form-control form-control-sm"  name="product_type_id" id="product_type_id">
                                    <option value="" selected disabled>Please select</option>
                                        @foreach ($product_types as $item )
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
                    <h3 class="card-title">manufacturer</h3>
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
                    <table class="table table-sm table-striped projects" id="example1">
                        <thead>
                            <tr>
                                <th style="width: 5%">
                                    SL
                                </th>
                                <th style="width: 30%" class="text-center">
                                    Manufacturer Name
                                </th>
                                <th style="width: 5%">
                                    Product Type
                                </th>
                                <th class="text-center" style="width: 25%">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($manufacturer as $item)
                            <tr>
                                <td>
                                    {!! $item->id !!}
                                </td>
                                <td class="text-center" style="font-weight:bold;">
                                    {!! $item->name_eng !!}
                                </td>
                                <td class="text-center" style="font-weight:bold;">
                                    {!! $item->product_type_id==0?"All":$item->producttype->name_eng !!}
                                </td>
                                <td class="project-actions text-center">
                                    <a class="btn btn-info btn-sm update" data-id="{{$item->id}}">
                                        <i style="font-size:10px;" class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a class="btn btn-danger btn-sm delete" href="#" data-id="{{$item->id}}" data-toggle="modal" data-target="#modal-default">
                                        <i style="font-size:10px;" class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="modal fade" id="modal-default-delete">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <form action="" method="post" id="delete-modal">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header">
                                <h4 class="modal-title">Delete manufacturer</h4>
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
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form action="" method="post" id="update-modal">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h4 class="modal-title">Update manufacturer Information</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label>Manufacturer Name</label>
                                                <input type="text" class="form-control form-control-sm" id='u-name_eng' name='name_eng' placeholder="manufacturer Name" required>
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
            let link = "{{url('manufacturer/')}}/"+id;
            $('#modal-default-delete').modal('show');
            $('#delete-modal').attr('action',link);
        });
        $(".update").on('click',function(e){
            let id = $(this).attr("data-id");
                $.ajax({
                    url: "{{url('manufacturer/')}}/"+id,
                    success: function (result) {
                        console.log(result);
                        $('#u-product_type_id').val(result.product_type_id);
                        $('#u-name_eng').val(result.name_eng);

                    }
                });
            let link = "{{url('manufacturer/')}}/"+id;
            $('#update-modal').attr('action',link);
            $('#modal-default-update').modal('show');

        });

        $("#example1").DataTable({"order": [[0, 'desc']],
        "responsive": true, "lengthChange": false, "autoWidth": false,
        //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');



    });

</script>

@endpush
