@extends('backend.layout.main')
@section('body-part')
<div class="content-wrapper">
    <x-breadcumb title="Stock Entry Report"/>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Stock Entry Reportt</h3>
                        </div>
                        <div class="card-body p-0" style = "min-height:500px;font-size: 14px;">
                            <table class="table table-sm table-striped projects"  id="example1">
                                <thead>
                                   <tr style="font-size: 16px;">
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
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($mrrs as $item)
                                        <tr style="{{$item->approved?"background-color: #b0eea0;":"background-color: #f7bb93;"}}font-size: 15px;font-style: italic;font-weight: bold;">
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
                                        </tr>
                                        <tr>
                                            <td collspan="8">&nbsp;</td>
                                        </tr>
                                    @php
                                        $stockDetails = collect($stock_entry_logs)->where('mrr_id','=',$item->mrr_id);
                                        // dd($stockDetails);
                                    @endphp
                                     <tr style="background-color: #f5ece6;font-size: 14px;">
                                        <th style="widtd: 15%" class="text-center">
                                           
                                        </th>
                                        <th style="widtd: 15%" class="text-center">
                                            Product Name
                                        </th>
                                        <th style="widtd: 10%" class="text-center">
                                            Product Generic
                                        </th>
                                        <th style="widtd: 10%" class="text-center">
                                            Current Stock
                                        </th>
                                        <th style="widtd: 10%" class="text-center">
                                            Purchase Date
                                        </th>
                                        <th style="widtd: 10%" class="text-center">
                                            Manufacture Date
                                        </th>
                                        <th style="widtd: 10%" class="text-center">
                                            Expire Date
                                        </th>
                                        <th style="widtd: 10%" class="text-center">
                                            Stock Qty
                                        </th>
                                    </tr>
                                    @foreach ($stockDetails as $details)
                                        <tr>
                                            <td class="text-center">
                                                
                                            </td>
                                            <td class="text-center">
                                                {!! $details->name !!}
                                            </td>
                                            <td class="text-center">
                                                {!! $details->product_sub_category !!}
                                            </td>
                                            <td class="text-center">
                                                {!! $details->generic !!}
                                            </td>
                                            <td class="text-center">
                                                {!! $details->stock_date !!}
                                            </td>
                                            <td class="text-center">
                                                {!! $details->manufacture_date!!}
                                            </td>
                                            <td class="text-center">
                                                {!! $details->manufacture_date!!}
                                            </td>
                                            <td class="text-center">
                                                {!! $details->stock_qty!!}
                                            </td>
                                        
                                    @endforeach
                                    <tr >
                                        <td colspan="8">&nbsp;</td>
                                        
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
