<section>
    <div class="container">
                <div class="row">
                <table class="table">
  <caption>List of orders</caption>
  <thead>
    <tr>
      <th scope="col">Order Id</th>
      <th scope="col">Phone</th>
      <th scope="col">SubTotal</th>
      <th scope="col">Total</th>
     <th scope="col">Biling Address</th>
     <th scope="col">Status</th>
     <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
   @foreach($orders as $order)
   @php
   $status = match($order?->status){
    1=>'<span class="badge badge-secondary">Pending</span>',
    2=>'<span class="badge badge-success">Shipped</span>',
    3=>'<span class="badge badge-dark">Completed</span>',
    default=>'<span class="badge badge-secondary">Pending</span>'
   }
   @endphp
    <tr>
      <th scope="row">{{ encryptOrderNumber($order?->id)}}</th>
      <td>{{$order?->billing_phone_number}}</td>
      <td>{{$order?->sub_total}}</td>
      <td>{{$order?->grand_total}}</td>
      <td>{{$order?->billing_address}}</td>
      <th scope="row">{!! $status !!}</th>
      <td> <a href='{{route('order-invoice',['order'=>$order?->id,'back_url'=>'account'])}}' class="btn btn-success">View Invoice</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
                    
                </div>
            </div>
</section>


