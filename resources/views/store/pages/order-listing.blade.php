<section>
    <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-xl-7 m-r-auto m-b-50">
                        <div class="m-l-25 m-r--38 m-lr-0-xl">
                            <div class="wrap-table-shopping-cart">
                                <table class="table-shopping-cart">
                                    <tr class="table_head">
                                        <th class="column-1">Order ID</th>
                                        <th class="column-3">Phone</th>
                                        <th class="column-4">SubTotal</th>
                                        <th class="column-5">Total</th>
                                        <th class="column-5">Action</th>
                                    </tr>
                                    @foreach($orders as $order)
                                   
                                    <tr class="table_row">
                                        <td class="column-1">
                                            {{$order?->id}}
                                        </td>
                                        <td class="column-2">{{$order?->billing_phone_number}}</td>
                                        <td class="column-3">$ {{$order?->sub_total}}</td>
                                        <td class="column-4">
                                            {{$order?->grand_total}}
                                        </td>
                                        <td class="column-5 item-total-price-{{$order?->id}}">$ {{'100'}}</td>
                                        <td class="column-5"><a class="btn btn-danger" onclick="removeToCart('{{$order?->id}}')"> <i class="zmdi zmdi-delete"></i></a></td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>

                            <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                                <div class="flex-w flex-m m-r-20 m-tb-5 d-none">
                                    <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">

                                    <div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                        Apply coupon
                                    </div>
                                </div>

                                <div class="d-none flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                    Update Cart
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
</section>


