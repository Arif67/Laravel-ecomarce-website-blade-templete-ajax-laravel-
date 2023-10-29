
<nav style=" margin-left:10px; margin-top:100px;" class="navbar navbar-light bg-light ">
  <div class="container-fluid">
  <h3> <a class="navbar-brand"> All Sub Category </a></h3> 
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
    <button type="button" class=" ms-5 me-5 btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#exampleModal1">
      Add New Sub Category
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
      <th>Image</th>
      <th>Title</th>
      <th> Category</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
  @foreach($data['subcategory'] as $item)
   

    <tr>
      <td>
        <div class="d-flex align-items-center">
          <img
              src="{{ Storage::url($item->banner) }}"
              alt="{{ $item->name }}"
              style = "width: 100px; height: 100px;"
              class = ""
              />
        </div>
      </td>
      <td>
        <h6 class="fw-normal mb-1">{{$item->name}}</h6>
      </td>
      <td>  

        <h6 class="fw-normal mb-1">{{ $item->category->name}}</h6>  
      </td>
      <td>
        <span class="badge badge-success rounded-pill d-inline"> <b> {{$item->status}}  </b></span>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Sub Category</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <form method="POST"  action="{{ route('subcategory.update', ['id' => $item->id]) }}" enctype="multipart/form-data">
                        @csrf 
                        @method('PUT')
                        <!-- Category Name input -->
                        <div class="form-outline mb-4">
                        
                            <input name="name" type="text" id="form1Example1" class="form-control" value="{{$item->name}}" />
                            <label class="form-label" for="form1Example1">Sub Category Name</label>
                        </div>

                       
                        <div class="form-outline mb-4">
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="" disabled selected>Select a Category</option>
                                @foreach ($data['category'] as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            
                        </div>
                        <!-- Banner input -->
                        <label class="form-label" for="form1Example2">Banner</label>
                        <div class="form-outline mb-4">
                            <input name="banner" type="file" id="form1Example2" class="form-control" />
                        </div>
                        <label class="form-label" for="category_id">Status</label>
                        <div class="form-outline mb-4">
                            <select name="status" id="category_id" class="form-control">
                                <option value="" disabled selected>Select a Status</option>
                                <option value="active"><b>Active</b></option>
                                <option value="inactive"><b>In Active</b></option>
                            </select> 
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-block">Edit Category</button>
                    </form>
                      <div class="modal-footer">
                        <button type="button" class="btn ms-5 me-5 btn-secondary" data-mdb-dismiss="modal">Close</button>
                      </div>
                  </div>
                
                </div>
              </div>
            </div>
          <form method="POST" action="{{ route('subcategory.update', ['id' => $item->id]) }}" style="display: inline;">
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
<div class="modal fade mt-5" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Sub Category  </h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form method="POST" action="{{ route('subcategory.store') }}" enctype="multipart/form-data">
             @csrf 
             <div class="form-outline mb-4">
                <input name="name" type="text" id="form1Example3" class="form-control" />
                <label class="form-label" for="form1Example3"> Sub Category Name </label>
            </div>
            <!-- Category Name input -->
            <label class="form-label" for="category_id">Select Category</label>
            <div class="form-outline mb-4">
                <select name="category_id" id="category_id" class="form-control">
                    <option value="" disabled selected>Select a Category</option>
                    @foreach ($data['category'] as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                
            </div>

            <!-- Banner input -->
            <label class="form-label" for="form1Example2"> Image </label>
            <div class="form-outline mb-4">
                <input name="banner" type="file" id="form1Example2" class="form-control" />
            </div>

            <!-- Description input -->
           

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block">Add Category</button>
        </form>
          <div class="modal-footer">
            <button type="button" class="btn ms-5 me-5 btn-secondary" data-mdb-dismiss="modal">Close</button>
          </div>
      </div>
     
    </div>
  </div>
</div>

