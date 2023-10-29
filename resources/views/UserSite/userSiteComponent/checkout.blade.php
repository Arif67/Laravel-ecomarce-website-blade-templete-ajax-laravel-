@extends('musterLayout.musterlayout')
@section('content')


    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Checkout</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        <div class="row">
            <div class="col-12">
                 <div class="container-fluid pt-5">
                <div class="row px-xl-5">
                    <div class="col-lg-6 table-responsive mb-5"></div>
                    <div class="col-lg-6 table-responsive mb-5">
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
        </div>
        <div class="row px-xl-5">
            <div class="col-lg-6" style="margin-top:-160px;">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Billing Address</h4>

                    <form action="{{ route('placeOrder') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>First Name</label>
                                <input required class="form-control" type="text" placeholder="John" name="fist_name" value="">
                            </div>
                        <div class="col-md-6 form-group">
                            <label>Last Name</label>
                            <input required class="form-control" type="text" placeholder="Doe" name="last_name" >
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input required class="form-control" type="text" placeholder="example@email.com" name="email" value="">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input required class="form-control" type="text" placeholder="+123 456 789"   name="mobile_no"  >
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 1</label>
                            <input required class="form-control" type="text" placeholder="123 Street" name="address_line1">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 2</label>
                            <input required class="form-control" type="text" placeholder="123 Street" name="address_line2">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Country</label>
                            <select required name="country" class="custom-select">
                                <option  selected>United States</option>
                                <option value="Afghanistan" >Afghanistan</option>
                                <option value="Albania">Albania</option>
                                <option value="Algeria">Algeria</option>
                                <option value="Bangladesh">Bangladesh</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input required class="form-control" type="text" name="city" placeholder="New York">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>State</label>
                            <input required class="form-control" type="text" name="state" placeholder="New York">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ZIP Code</label>
                            <input required class="form-control" type="text" name="zipcode" placeholder="123">
                        </div>
                     
                        <div class="col-md-12 form-group">
                            <div class="custom-control custom-checkbox">
                                <input required type="checkbox" class="custom-control-input" id="shipto">
                                <label class="custom-control-label" for="shipto"  data-toggle="collapse" data-target="#shipping-address">Ship to different address</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="collapse mb-4" id="shipping-address">
                    <h4 class="font-weight-semi-bold mb-4">Shipping Address</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>First Name</label>
                            <input required name="sfirst_name" class="form-control" type="text" placeholder="John">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Last Name</label>
                            <input required name="slast_name" class="form-control" type="text" placeholder="Doe">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input required name="semail" class="form-control" type="text" placeholder="example@email.com">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input required name="smobile_no" class="form-control" type="text" placeholder="+123 456 789">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 1</label>
                            <input required name="saddress_line1" class="form-control" type="text" placeholder="123 Street">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 2</label>
                            <input required name="saddress_line2" class="form-control" type="text" placeholder="123 Street">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Country</label>
                            <select required name="scountry" class="custom-select">
                                <option selected>United States</option>
                                <option value="Afghanistan">Afghanistan</option>
                                <option value="Bangladesh">Albania</option>
                                <option value="india">Algeria</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input required name="scity" class="form-control" type="text" placeholder="New York">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>State</label>
                            <input required name="sstate" class="form-control" type="text" placeholder="New York">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ZIP Code</label>
                            <input required name="spostal_code" class="form-control" type="text" placeholder="123">
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-lg-6">
                <div class="card border-secondary mb-5">
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <p class="font-weight-bold">shipping cost</p>
                            <p class="font-weight-bold">${{$shipping = 10 }} </p>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">${{$data['totalAmount'] + $shipping}} </h5>
                        </div>
                    </div>
                </div>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Payment</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="paypal" value="bikash">
                                <label class="custom-control-label" for="paypal">Paypal</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="directcheck" value="cash on delivary">
                                <label class="custom-control-label" for="directcheck">Direct Check</label>
                            </div>
                        </div>
                       
                    </div>
                    <div class="form-group">
                        <div class="custom-control ">
                            <input type="hidden" value="{{$data['totalAmount'] + $shipping}}" name="total_price" class="form-control mr-5" type="text">
                            <input  name="transection_id" class="form-control mr-5" type="text" placeholder="Transection Id ">
                            <label>Transection Id</label>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                    <button type="submit" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Place Order</button>
                    </div>
                 </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout End -->




@endsection