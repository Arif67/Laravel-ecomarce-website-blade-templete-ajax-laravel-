
<nav style=" margin-left:10px; margin-top:100px;" class="navbar navbar-light bg-light ">
  <div class="container-fluid">
  <h3> <a class="navbar-brand"> All Seller </a></h3> 
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
    <button type="button" class=" ms-5 me-5 btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#exampleModal">
      Add New Seller 
    </button>
  </div>
</nav>

@if(session('success'))
    <div class="alert alert-success m-2">
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
      <th> Name </th>
      <th> Email </th>
      <th> Phone Number </th>
      <th> Address </th>
      <th> Actions </th>
    </tr>
  </thead>
  <tbody>
  @foreach($data as $item)
   

    <tr>
      <td>
        <div class="d-flex align-items-center">
          <h3>{{$item->name}}</h3>
        </div>
      </td>
      <td>
        <h6 class="fw-normal mb-1">{{$item->email}}</h6>
        
      </td>
      <td>
        <p>{{$item->phone_number}}</p>
      </td>
      <td>
        <h4>{{$item->address}}</h4>
      </td>
      <td>
         <button type="button" class=" ms-5 me-5 btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#exampleModal{{$item->id}}">
             Edit  
         </button>

            <!-- Edite Modal -->
            <div class="modal fade mt-5" id="exampleModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Edit Category </h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <form method="POST"  action="{{ route('seller.update', ['id' => $item->id]) }}" enctype="multipart/form-data">
                        @csrf 
                        @method('PUT')
                        <!-- Category Name input -->
                        <div class="form-outline mb-4">
                        
                            <input name="name" type="text" id="form1Example1" class="form-control" value="{{$item->name}}"/>
                            <label class="form-label" for="form1Example1"> Seller Name </label>
                        </div>

                        <!-- Banner input -->
                        <label class="form-label" for="form1Example2">email</label>
                        <div class="form-outline mb-4">
                            <input name="email" type="email" id="form1Example2" class="form-control" value="{{$item->email}}" />
                        </div>

                        <!-- Description input -->
                        <div class="form-outline mb-4">
                            <input name="phone_number" type="text" id="form1Example3" class="form-control" value="{{$item->phone_number}}" />
                            <label class="form-label" for="form1Example3"> Phone Number </label>
                        </div>
                        <div class="form-outline mb-4">
                            <input name="address" type="text" id="form1Example3" class="form-control"  value="{{$item->address}}"/>
                            <label class="form-label" for="form1Example3"> Address </label>
                        </div>
                     
                    

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-block">Edit Seller Info </button>
                    </form>
                      <div class="modal-footer">
                        <button type="button" class="btn ms-5 me-5 btn-secondary" data-mdb-dismiss="modal">Close</button>
                      </div>
                  </div>
                
                </div>
              </div>
            </div>
          <form method="POST"  action="{{ route('seller.destroy', ['id' => $item->id]) }}" style="display: inline;">
              @csrf
              @method('DELETE')
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



<!-- Add new category  modal  -->


<!-- Modal -->
<div class="modal fade mt-5" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Seller </h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form method="POST"  action="{{ route('seller.store', ['id' => $item->id]) }}" enctype="multipart/form-data">
             @csrf 

            <!-- Category Name input -->
            <div class="form-outline mb-4">
                <input name="name" type="text" id="form1Example1" class="form-control" />
                <label class="form-label" for="form1Example1"> Seller Name </label>
            </div>

            <!-- Banner input -->
            <label class="form-label" for="form1Example2"> Email </label>
            <div class="form-outline mb-4">
                <input name="email" type="text" id="form1Example2" class="form-control" />
            </div>

            <!-- Description input -->
            <div class="form-outline mb-4">
                <input name="phone_number" type="text" id="form1Example3" class="form-control" />
                <label class="form-label" for="form1Example3"> Phone Number </label>
            </div>
            <div class="form-outline mb-4">
                <input name="address" type="text" id="form1Example3" class="form-control" />
                <label class="form-label" for="form1Example3"> Address  </label>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block"> Add Seller </button>
        </form>
          <div class="modal-footer">
            <button type="button" class="btn ms-5 me-5 btn-secondary" data-mdb-dismiss="modal">Close</button>
          </div>
      </div>
     
    </div>
  </div>
</div>

