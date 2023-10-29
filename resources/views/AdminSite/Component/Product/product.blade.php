
<nav style=" margin-left:10px; margin-top:100px;" class="navbar navbar-light bg-light ">
  <div class="container-fluid">
  <h3> <a class="navbar-brand"> All Product </a></h3> 
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
      Add New Product 
    </button>
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
      <th> Product Image </th>
      <th> Title </th>
      <th> Brand </th>
      <th> Category </th>
      <th> Sub Category </th>
      <th> Selling Price </th>
      <th> Status </th>
      <th> Actions </th>
    </tr>
  </thead>
  <tbody>
  @foreach($data['productData'] as $item)
   

    <tr>
      <td>
        <div class="d-flex align-items-center">
        <img
              src="{{ Storage::url($item->image) }}"
              alt="{{ $item->name }}"
              style = "width: 100px; height: 100px;"
              class = ""
              />
        </div>
      </td>
      <td><h6>{{$item->product_name}}</h6></td>
      <td>
        <h6 class="fw-normal mb-1">{{$item->brand->name}}</h6>
      </td>
      <td>
        <p>
          {{$item->category->name}}
        </p>
      </td>
      <td>
        <h5>
          {{$item->subcategory->name}}
        </h5>
      </td>
      <td>
        <h5>
        {{$item->stock->selling_price}}
        </h5>
      </td>
      <td>
        <h5>
         {{$item->status}}
        </h5>
      </td>
      <td>
        <h5>
         
        </h5>
      </td>
      <td>
    
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>



<!-- Add new Product  modal  -->


<!-- Modal -->
<div class="modal fade mt-5" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Product </h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
             @csrf 

            <!-- Category Name input -->
            <div class="form-outline mb-4">
                <input name="product_name" type="text" id="form1Example1" class="form-control" />
                <label class="form-label" for="form1Example1">Product Name </label>
            </div>

            <!-- Banner input -->
            <label class="form-label" for="form1Example2">Product Image </label>
            <div class="form-outline mb-4">
                <input name="image" type="file" id="form1Example2" class="form-control" />
            </div>

            <!-- Description input -->
            <div class="form-outline mb-4">
                <input name="buying_price" type="number" id="form1Example3" class="form-control" />
                <label class="form-label" for="form1Example3"> Buying Price </label>
            </div>
            <div class="form-outline mb-4">
                <input name="selling_price" type="number" id="form1Example3" class="form-control" />
                <label class="form-label" for="form1Example3"> Selling Price </label>
            </div>
            <div class="form-outline mb-4">
                <input name="discount_percentage" type="number" id="form1Example3" class="form-control" />
                <label class="form-label" for="form1Example3"> Discount Percentage </label>
            </div>
            <div class="form-outline mb-4">
                <input name="quantity" type="number" id="form1Example3" class="form-control" />
                <label class="form-label" for="form1Example3"> Quantity  </label>
            </div>
            <div class="form-outline mb-4">
                <select name="category_id" id="category_id" class="form-control">
                    <option value="" disabled selected>Select a Category</option>
                      @foreach($data['category'] as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                      @endforeach
                </select>
            </div>
            <div class="form-outline mb-4">
                <select name="subcategory_id" id="subcategory_id" class="form-control">
                  <option value="" disabled selected>Select a Sub Category</option>
                </select>
            </div>
         
            <div class="form-outline mb-4">
                <select name="brand_id" id="" class="form-control">
                    <option value="" disabled selected>Select a sub Brand</option>
                    @foreach ($data['brand'] as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-outline mb-4">
                <select name="seller_id" id="" class="form-control">
                    <option value="" disabled selected>Select Seller </option>
                    @foreach ($data['seller'] as $seller)
                        <option value="{{ $seller->id }}">{{ $seller->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-outline mb-4">
                <select name="status" id="" class="form-control">
                    <option value="" disabled selected>Select a Status</option>
                    <option value="active"><b>Active</b></option>
                    <option value="inactive"><b>In Active</b></option>
                </select> 
            </div>
            <div class="form-outline mb-4">
                <input name="preparedby" type="text" id="form1Example3" class="form-control" />
                <label class="form-label" for="form1Example3"> Prepared By </label>
            </div>
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block">Add Product </button>
        </form>
          <div class="modal-footer">
            <button type="button" class="btn ms-5 me-5 btn-secondary" data-mdb-dismiss="modal">Close</button>
          </div>
      </div>
     
    </div>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categorySelect = document.getElementById('category_id');
        const subcategorySelect = document.getElementById('subcategory_id');

        categorySelect.addEventListener('change', function () {
            const categoryId = this.value;
             console.log(categoryId)
            subcategorySelect.innerHTML = '<option value="" disabled selected>Select a Subcategory</option>';

            if (!categoryId) {
                return; 
            }

            fetch(`/subcategory/${categoryId}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
              console.log(data)
              data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id; 
                    option.textContent = item.name;
                    subcategorySelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching subcategories:', error);
            });
        });
    });
</script>