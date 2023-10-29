<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row">
      <div class="col">
        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
          </ol>
        </nav>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3">{{Auth::user()->name}}</h5>
           
          </div>
        </div>
        <div class="card mb-4 mb-lg-0">
          <div class="card-body p-0">
            <ul class="list-group list-group-flush rounded-3">
            <ul class="list-group list-group-light list-group-small">
              <li class="list-group-item"> my profile </li>
              <li class="list-group-item"> my order list </li>
              <li class="list-group-item"> billing address </li>
              <li class="list-group-item"> shipping address</li>
              <li class="list-group-item"> setting </li>
            </ul>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{Auth::user()->name}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{Auth::user()->email}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Phone</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{Auth::user()->mobile}}</p>
              </div>
            </div>
            <hr>
            
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Address</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{Auth::user()->address}}</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                <p class="mb-4"><span class="text-primary font-italic me-1"></span> billing address
                </p>
                <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                
                <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
               
                <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                
                <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                
                <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                <p class="mb-4"><span class="text-primary font-italic me-1"></span> shipping address
                </p>
                <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                
                <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
               
                <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
               
                <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                
                <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</section>