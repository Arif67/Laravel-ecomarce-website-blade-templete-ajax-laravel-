<div class="container my-5 py-5">

  <!--Section: Design Block-->
  <section>

    <div class="row">
      <div  class="col-md-6 ">
      <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0 text-font text-uppercase">Delivery address</h5>
          </div>
          <div class="card-body">
            <form>

              <div class="row mb-4">
                <div class="col">
                  <div class="form-outline">
                   <label class="form-label" for="form11Example1" >First name</label>
                    <input name="first_name" type="text" id="form11Example1"  placeholder=" First Name " class="form-control" />
                
                  </div>
                </div>
                <div class="col">
                  <div class="form-outline">
                   <label class="form-label" for="form11Example2">Last name</label>
                    <input  name="last_name" type="text" id="form11Example2" placeholder=" Last Name " class="form-control" />
                
                  </div>
                </div>
              </div>

              <!-- Text input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="form11Example3">Phone </label>
                <input name="phone" type="text" id="form11Example3" class="form-control" placeholder="phone " />
                
              </div>
                <!-- Email input -->
                <div class="form-outline mb-4">
                <label class="form-label" for="form11Example5">Email</label>
                <input name="email" type="email" id="form11Example5" class="form-control" placeholder="email" />
                
              </div>
              <!-- Text input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="form11Example4">Address</label>
                <input name="address" type="text" id="form11Example4" class="form-control"  placeholder="Address"/>
              </div>

              <!-- Message input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="form11Example7">Additional information</label>
                <textarea name="additional_info" class="form-control" id="form11Example7" rows="4"></textarea>
              </div>
            </form>
          </div>

        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-success button-order col-md-10">Place order</button>
        </div>

        @php
           $user_guestToken = request()->cookie('guest_token');
           $guestProductItems =App\Models\ProudctCart::where('guest_token',$user_guestToken)->get();
           $totalCost = 0;
        @endphp



      </div>
      <div class="col-md-5">
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0 text-font">1 item <span class="float-end mt-1"
                style="font-size: 13px ;">Edit</span></h5>
          </div>
          <div class="card-body">
          @foreach($guestProductItems as $item)
            <div class="row">
              <div class="col-md-4">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Vertical/12a.webp"
                  class="rounded-3" style="width: 100px;" alt="Blue Jeans Jacket" />
              </div>
              <div class="col-md-6 ms-3 p-2">
                  <p class="mb-0 text-descriptions">Name :  {{$item->name}} </p>
                    <span class="mb-0 text-price">Price :  ${{$item->price * $item->quantity}}</span>
                  <br>
                    <span class="text-descriptions fw-bold"> Quantity : {{$item->quantity}}</span> 
                    </p>
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
              </div>
              <div class="col-md-2 p-2 ">
                <form action="{{ route('cart.delete', ['id' => $item->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-times"></i></button>
                </form>
              </div>
            </div>
           
          @endforeach
          @foreach ($guestProductItems as $item)
              @php
              $itemTotal = $item->price * $item->quantity;
              $totalCost += $itemTotal; // Add the item's total to the total cost
              @endphp
          @endforeach
            <div class="card-footer mt-4 p-4">
              <ul class="list-group list-group-flush">
                <li
                  class=" p-3 list-group-item d-flex justify-content-between align-items-start border-0 px-0 pb-0 text-muted">
                  Subtotal
                  <span>${{ $totalCost }}</span>
                </li>
                <li
                  class=" p-3 list-group-item d-flex justify-content-between align-items-start border-0 px-0 pb-0 text-muted">
                  shipping charge :
                  <span> $5 </span>
                </li>
                <li
                  class=" p-3 list-group-item d-flex justify-content-between align-items-start border-0 px-0 pb-0 text-muted">
                  Total payble  :
                  <span>  $ {{$totalCost + 5 }} </span>
                </li>
               
              </ul>
            </div>


          </div>
        </div>
      </div>

      <div class="col-md-8 mb-4">
        


    </div>

  </section>
  <!--Section: Design Block-->

</div>