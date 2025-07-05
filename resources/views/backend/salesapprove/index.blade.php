@extends('backend.layout.main')
@section('body-part')
<div class="content-wrapper">
    <x-breadcumb title="Sales Approve All List"/>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Sales Approve Pending List</h3>
                        </div>
                        <div class="card-body p-0" style = "min-height:500px;font-size: 14px;">
                            <table class="table table-sm table-striped projects"  id="example1">
                                <thead>
                                    <tr>
                                        <th style="width: 10%" class="text-center">
                                            Invoice No
                                        </th>
                                        <th style="width: 10%" class="text-center">
                                            Customer Name
                                        </th>
                                        <th style="width: 10%" class="text-center">
                                            Contact No
                                        </th>
                                        <th style="width: 10%" class="text-center">
                                            Bill Date
                                        </th>
                                        <th style="width: 10%" class="text-center">
                                            Approve Status
                                        </th>
                                        <th style="width: 10%" class="text-center">
                                            Total Amount
                                        </th>
                                        <th style="width: 10%" class="text-center">
                                            Payable Amount
                                        </th>
                                        <th style="width: 10%" class="text-center">
                                            Paid Amount
                                        </th>
                                        <th style="width: 10%" class="text-center">
                                            Due Amount
                                        </th>
                                        <th class="text-center" style="width: 10%">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($invoices as $item)
                                    <tr>
                                        <td class="text-center">
                                        {!! $item->invoice_id !!}
                                        </td>
                                        <td class="text-center">
                                        {!! $item->customer_name !!}
                                        </td>
                                        <td class="text-center">
                                        {!! @$item->contact_no !!}
                                        </td>
                                        <td class="text-center">
                                        {!! $item->bill_date !!}
                                        </td>
                                         <td class="text-center">
                                            {!! $item->approve ? "<badge class='badge badge-success'>Approve</badge>":"<badge class='badge badge-danger'>Pending</badge>"!!}
                                        </td>
                                        <td class="text-center">
                                        {!! $item->total_amount!!}
                                        </td>
                                        <td class="text-center">
                                        {!! $item->payable_amount!!}
                                        </td>
                                        <td class="text-center">
                                        {!! $item->paid_amount!!}
                                        </td>
                                        <td class="text-center">
                                        {!! $item->due_amount!!}
                                        </td>
                                        <td class="project-actions text-center">
                                            <a class="btn btn-primary btn-xs update" data-id="{{$item->id}}">
                                                Approve
                                            </a>
                                            <a class="btn btn-secondary btn-xs delete" href="{{url('salesapprove/'.$item->id)}}" data-id="{{$item->id}}" >
                                                Details
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                 {{-- <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Stock Entry Approve Done List</h3>
                        </div>
                        <div class="card-body p-0" style = "min-height:500px;font-size: 14px;">
                            <table class="table table-sm table-striped projects"  id="example2">
                                <thead>
                                    <tr>
                                        <th style="width: 15%" class="text-center">
                                            Mrr No
                                        </th>
                                        <th style="width: 15%" class="text-center">
                                            Supplier Name
                                        </th>
                                        <th style="width: 10%" class="text-center">
                                            Challan No
                                        </th>
                                        <th style="width: 10%" class="text-center">
                                            Purchase Date
                                        </th>
                                         <th style="width: 10%" class="text-center">
                                            Done Status
                                        </th>
                                        <th style="width: 10%" class="text-center">
                                            Bill Amount
                                        </th>
                                        <th style="width: 10%" class="text-center">
                                            Paid Amount
                                        </th>
                                        <th style="width: 10%" class="text-center">
                                            Due Amount
                                        </th>
                                        <th class="text-center" style="width: 25%">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($mrrs as $item)
                                    <tr>
                                        <td class="text-center">
                                        {!! $item->mrr_id !!}
                                        </td>
                                        <td class="text-center">
                                        {!! $item->supplier_name !!}
                                        </td>
                                        <td class="text-center">
                                        {!! $item->challan_no !!}
                                        </td>
                                        <td class="text-center">
                                        {!! $item->purchase_date !!}
                                        </td>
                                        <td class="text-center">
                                        {!! $item->done?"<badge class='badge badge-success'>Done</badge>":"<badge class='badge badge-danger'>Pending</badge>"!!}
                                        </td>
                                        <td class="text-center">
                                        {!! $item->bill_amount!!}
                                        </td>
                                        <td class="text-center">
                                        {!! $item->paid_amount!!}
                                        </td>
                                        <td class="text-center">
                                        {!! $item->due_amount!!}
                                        </td>
                                        <td class="project-actions text-center">
                                            <a class="btn btn-warning btn-xs update" data-id="{{$item->id}}">
                                                Edit
                                            </a>
                                            <a class="btn btn-secondary btn-xs delete" href="#" data-id="{{$item->id}}" data-toggle="modal" data-target="#modal-default">
                                                Details
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        

      
    });

</script>

@endpush
