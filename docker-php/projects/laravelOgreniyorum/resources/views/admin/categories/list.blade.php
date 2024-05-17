@extends("layouts.admin")
@section("title", "Category List")

@section("css")
@endsection

@section("content")

<div class="card">
    <div class="card-header">
        <h5 class="card-title" style="font-size: 24px; font-weight: bold;">Category List</h5>
    </div>
    <div class="card-body">
        <form action="">
            <div class="row">
                   <div class="col-2">
                <input type="text" class="form-control" placeholder="Name" name="name">
            </div>
            <div class="col-2">
                <input type="text" class="form-control" placeholder="Slug" name="slug">
            </div>
            <div class="col-2">
                <input type="text" class="form-control" placeholder="Description" name="description">
            </div>
            <div class="col-2">
                <input type="text" class="form-control" placeholder="Order" name="order">
            </div> 

            <hr>
            <div class="col-6 mb-2 d-flex">
               <button class="btn btn-primary w-50" type="submit">Filter</button>
            </div>
            </div>
        
        </form>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Feature Status</th>
                        <th>Description</th>
                        <th>Order</th>
                        <th>Parent Category</th>
                        <th>User</th>
                        <th>Actions</th> 
                    </tr>
                </thead>
                <tbody>

                    @foreach($list as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>
                          @if($category->status)
                          <a href="javascript:void(0)"  data-id="{{ $category->id }}" class="btn btn-success btn-sm btnChangeStatus">Active</a>
                          @else
                          <a href="javascript:void(0)"  data-id="{{ $category->id }}" class="btn btn-danger btn-sm btnChangeStatus">Passive</a>
                          @endif
                        </td> 
                        <td>
                        @if($category->feature_status)
                          <a href="javascript:void(0)"  data-id="{{ $category->id }}" class="btn btn-success btn-sm btnChangeFeatureStatus">Active</a>
                          @else
                          <a href="javascript:void(0)"  data-id="{{ $category->id }}" class="btn btn-danger btn-sm btnChangeFeatureStatus">Passive</a>
                          @endif
                        </td>
                        <td>{{ $category->description }}</td>
                        <td>{{ $category->order }}</td>
                        <td>{{ $category->parentCategory ? $category->parentCategory->name : '-' }}</td>
                        <td>{{ $category->user->name }}</td>
                        <td>
                            <a href="{{ route('categories.edit', ['id' => $category->id]) }}" class="btn btn-warning btn-sm"><i class="material-icons ms-0">edit</i></a>
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm btnDelete" data-id= "{{ $category->id }}" > <i class="material-icons ms-0">delete</i></a>
                        </td>

                    </tr>
                    @endforeach
                    
                </tbody>
               
            </table>

        </div>
        {{ $list->links() }}
    </div>
</div>
<form action="" method="POST" id="statusChangeForm">
        @csrf 
        <input type="hidden" name="id" id="inputStatus" value="">
</form>


@endsection

@section("js")
     <script>
        $(document).ready(function() {
            $(".btnChangeStatus").click(function() {
                let categoryID = $(this).data("id");
                
                Swal.fire({
                    title: "Do you want to change the status?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    denyButtonText: `No`
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#statusChangeForm").attr("action", "{{ route('categories.changeStatus') }}");
                        $("#inputStatus").val(categoryID);
                        $("#statusChangeForm").submit();
                    }
                    else if(result.isDenied) {
                        Swal.fire("Changes are not save", " ", "info") 

                    }
                });
            });
        });

        $(document).ready(function() {
            $(".btnChangeFeatureStatus").click(function() {
                let categoryID = $(this).data("id");
                
                Swal.fire({
                    title: "Do you want to change the Feature Status?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    denyButtonText: `No`
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#statusChangeForm").attr("action", "{{ route('categories.changeFeatureStatus') }}");
                        $("#inputStatus").val(categoryID);
                        $("#statusChangeForm").submit();
                    }
                    else if(result.isDenied) {
                        Swal.fire("Changes are not save", " ", "info") 

                    }
                });
            });
        });
   
          $(document).ready(function(){
            $(".btnDelete").click(function(){
                let categoryID = $(this).data("id");
              

                Swal.fire({
                    title: "Do you want to Delete?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    denyButtonText: `No`
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#statusChangeForm").attr("action", "{{ route('categories.delete') }}");
                        $("#inputStatus").val(categoryID);
                        $("#statusChangeForm").submit();
                    }
                    else if(result.isDenied) {
                        Swal.fire("Changes are not save", " ", "info") 

                    }
                });
            });

          }) ;


     </script>

     

@endsection
