@if(Auth::User()->getTable() == 'admins')
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>No#</th>
                <th>Product </th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total</th>


            <tr>
            </thead>
                <tbody>
                @foreach($OrderItemdata as $key=>$val)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$val->product->title}}</td>
                    <td>{{$val->quantity}}</td>
                    <td>{{$val->unit_price}}</td>
                    <td>{{$val->total}}</td>
                </tr>
                @endforeach
                </tbody>

        </table>
    </div>
@endif