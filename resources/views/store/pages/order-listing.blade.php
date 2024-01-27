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
    1=>'Pending',
    2=>'Shipped',
    3=>'Completed',
    default=>'Pending'
   }
   @endphp
    <tr>
      <th scope="row">{{ encryptOrderNumber($order?->id)}}</th>
      <td>{{$order?->billing_phone_number}}</td>
      <td>{{$order?->sub_total}}</td>
      <td>{{$order?->grand_total}}</td>
      <td>{{$order?->billing_address}}</td>
      <td>{{$status}}</td>
      <td>View Order</td>
    </tr>
    @endforeach
  </tbody>
</table>
                    
                </div>
            </div>
</section>


