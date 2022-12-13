@if(sizeof($gifts)>0)
    <table class="table table-bordered data-table" id="table">
        <thead>
        <tr>
            <th>@lang("Date")</th>
            <th>@lang("ID")</th>
            <th>@lang("Amount")</th>
            <th>@lang("Item")</th>
            <th>@lang("Description")</th>
        </tr>
        </thead>
        <tbody>
        @foreach($gifts as $gift)
            <tr>
                <td><a href="/giving/gift/{{$gift->txn_id}}">{{date('d M y',strtotime($gift->created_at))}}</a></td>
                <td><a href="/giving/gift/{{$gift->txn_id}}">{{$gift->txn_id}}</a></td>
                <td>{{$gift->amount}}</td>
                <td>{{$gift->item}}</td>
                <td>{{$gift->desc}}</td>
            </tr>
        @endforeach
        </tbody>

    </table>

@else
    <hr/>
    <div class="alert alert-danger">@lang("No records found")</div>
@endif
@include('partials.datatables')