
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-2">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 150px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping Cart</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="/">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shopping Cart</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">

                    @foreach ($data['cartItem'] as $item)
                   
                        <tr>
                            <td class=""><img src="{{ Storage::url($item->product->image) }}" alt="" style="width: 50px;"> </td>
                            <td class="align-middle">{{$item->name}}</td>
                            <td class="align-middle">
                            <div style="display:flex; gap:10px; ">
                                 <form action="{{ route('cart.decrement', ['id' => $item->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-warning"><i class="fa fa-minus"></i></button>
                                 </form>
                                  <span>{{ $item->quantity }}</span>
                                 <form action="{{ route('cart.increment', ['id' => $item->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></button>
                                 </form>
                              
                            </div>
                            </td>
                            <td class="align-middle">{{$item->quantity*$item->price}}</td>
                            <td class="align-middle">
                            <form action="{{ route('cart.delete', ['id' => $item->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-times"></i></button>
                            </form>
                            
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <!-- <form class="mb-5" action="">
                    <div class="input-group">
                        <input type="text" class="form-control p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form> -->
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium">${{$data['totalAmount']}}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">{{ $sipping= 10}}</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold"> $ {{$data['totalAmount'] + $sipping }}</h5>
                        </div>
                        @php 
                        $user_guestToken = request()->cookie('guest_token');
                        if(Auth::check()){
                            $user = Auth::user()->id;
                        }else{
                            $user = $user_guestToken;
                        }

                        @endphp
                        <a href="{{ route('checkout', ['id' => $user]) }}" class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
