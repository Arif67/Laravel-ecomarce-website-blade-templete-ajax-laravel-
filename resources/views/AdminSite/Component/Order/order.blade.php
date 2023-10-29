
<div class="row p-5 m-2">
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between px-md-1">
                <div class="align-self-center">
                  <i class="fas fa-pencil-alt text-info fa-3x"></i>
                </div>
                <div class="text-end">
                  <h3>278</h3>
                  <p class="mb-0">New Posts</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between px-md-1">
                <div class="align-self-center">
                  <i class="fas fa-pencil-alt text-info fa-3x"></i>
                </div>
                <div class="text-end">
                  <h3>278</h3>
                  <p class="mb-0">New Posts</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between px-md-1">
                <div class="align-self-center">
                  <i class="fas fa-pencil-alt text-info fa-3x"></i>
                </div>
                <div class="text-end">
                  <h3>278</h3>
                  <p class="mb-0">New Posts</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between px-md-1">
                <div class="align-self-center">
                  <i class="fas fa-pencil-alt text-info fa-3x"></i>
                </div>
                <div class="text-end">
                  <h3>278</h3>
                  <p class="mb-0">New Posts</p>
                </div>
              </div>
            </div>
          </div>
        </div>
</div>



<nav style=" margin-left:10px; margin-top:100px;" class="navbar navbar-light bg-light ">
  <div class="container-fluid">
  <h3> <a class="navbar-brand text-info"> Order  </a></h3> 
    <form class="d-flex m-auto input-group w-auto">
      <input
        type="search"
        class="form-control rounded"
        placeholder="Search"
        aria-label="Search"
        aria-describedby="search-addon"
      />
      <span class="input-group-text border-0" id="search-addon">
        <i class="fas fa-search"></i>
      </span>
     
    </form>
   
  </div>
</nav>

@if(session('success'))
    <div class="alert alert-success m-5">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div style=" margin:20px; ">
<table class="table align-middle mb-0 bg-white">
  <thead class="bg-light">
    <tr>
      <th> User Name </th>
      <th> Address </th>
      <th> Order ID </th>
      <th> Quantity </th>
      <th> Order Date</th>
      <th> Status </th>
      <th class="text-center"> Actions </th>
    </tr>
  </thead>
  <tbody>
  @foreach($data as $item)
   

   <tr>
     <td>
       <div class="d-flex align-items-center">
           <p>{{$item->user->name}}</p>
       </div>
     </td>
     <td>
       <div class=" align-items-center">
       @php
       $address= App\Models\Shipping_addresse::where('order_id',$item->id)->get();  
       @endphp
          email: {{$address[0]->email}} <br>
          mobile : {{$address[0]->mobile_no}} <br>
          address_line1 : {{$address[0]->address_line1}} <br>
          address_line2 : {{$address[0]->address_line2}}
       </div>
     </td>
     <td>
       <h6 class="fw-normal mb-1">{{$item->id}}</h6>
       
     </td>
     <td>
        @php
            $totalQty = 0; 
        @endphp
        @foreach($item->orderDetails as $orderDetail)
        @php
            $totalQty += $orderDetail->qty; 
        @endphp
        @endforeach
        {{$totalQty}}
     </td>
     <td>{{$item->orderDate}}</td>
     <td> <span class="badge badge-success rounded-pill d-inline">{{$item->status}}</span></td>
 
     <td>
        <button type="button" class=" ms-5 me-5 btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#exampleModal{{$item->id}}">
            Order Details  
        </button>

           <!-- Edite Modal -->
           <div class="modal fade mt-5" id="exampleModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog">
               <div class="modal-content">
                 <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Order Details </h5>
                   <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                
                    

                  <section class="h-100 gradient-custom">
                      <div class="container py-5 h-100">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                          <div class="">
                            <div class="card" style="border-radius: 10px;">
                              <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                  <p class="lead fw-normal mb-0" style="color: #a8729a;">Receipt</p>
                                  <p class="small text-muted mb-0">Receipt Voucher : 1KAU9-84UIL</p>
                                </div>
                                <div class="card shadow-0 border mb-4">
                                  <div class="card-body">
                                    @php
                                       $orderDetails = App\Models\OrderDetail::where('order_id',$item->id)->with('product')->get();
                                      
                                    @endphp
                                    
                                    @foreach($orderDetails as $orderDetails)
                                    <div class="row">
                                        <div class="col-md-3">
                                        <img
                                          src="{{ Storage::url($orderDetails->product->image) }}"
                                          alt="{{ $item->name }}"
                                          style = "width: 50px; height: 50px;"
                                          class = ""
                                          />
                                        </div>
                                        <div class="col-md-3 text-center d-flex justify-content-center align-items-center">
                                          <p class="text-muted mb-0">{{$orderDetails->name}}</p>
                                        </div>
                                        <div class="col-md-3 text-center d-flex justify-content-center align-items-center">
                                          <p class="text-muted mb-0 small">Qty: {{$orderDetails->qty}}</p>
                                        </div>
                                        <div class="col-md-3 text-center d-flex justify-content-center align-items-center">
                                          <p class="text-muted mb-0 small"> $ {{$orderDetails->total_price}}</p>
                                        </div>
                                       
                                      </div>
                                      <hr>
                                     @endforeach  
                                  </div>
                                </div>
                                
                                <div class="d-flex justify-content-between pt-2">
                                  <p class="fw-bold mb-0">Order Details</p>
                                  @php
                                  $orderDetails = App\Models\OrderDetail::where('order_id',$item->id)->with('product')->get();
                                      
                                  $total = 0;
                                      foreach ($orderDetails as $orderDetail) {
                                          $total += (float) $orderDetail->total_price;
                                      }
                                  @endphp
                                  <p class="text-muted mb-0"><span class="fw-bold me-4">Total</span> {{$total}}</p>
                                </div>

                                <div class="d-flex justify-content-between pt-2">
                                  <p class="text-muted mb-0">Invoice Number : 788152</p>
                                  <p class="text-muted mb-0"><span class="fw-bold me-4">Discount</span> $0</p>
                                </div>

                                <div class="d-flex justify-content-between">
                                  <p class="text-muted mb-0">Invoice Date : 22 Dec,2019</p>
                                  <p class="text-muted mb-0"><span class="fw-bold me-4">GST 18%</span> </p>
                                </div>

                                <div class="d-flex justify-content-between mb-5">
                                  <p class="text-muted mb-0">Recepits Voucher : 18KU-62IIK</p>
                                  <p class="text-muted mb-0"><span class="fw-bold me-4">Delivery Charges</span> Free</p>
                                </div>
                              </div>
                              <div class="card-footer border-0 px-3 py-3"
                                style="background-color: #a8729a; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                                <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">Total
                                 Payable <span class="h2 mb-0 ms-2">{{$total}}</span></h5>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </section>
  
                   
                 </div>
               
               </div>
             </div>
           </div>
         <form method="POST" action="" style="display: inline;">
            
             <button type="submit" class="text-white btn btn-danger btn-link btn-rounded">
                 Delete
             </button>
         </form>
     </td>
   </tr>
   @endforeach
  </tbody>
</table>
</div>

