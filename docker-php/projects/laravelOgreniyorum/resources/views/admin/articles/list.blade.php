@extends("layouts.admin")
@section("title", "ArticleList")

@section("css")
@endsection

@section("content")

<div class="card">
    <div class="card-header">
        <h5 class="card-title" style="font-size: 24px; font-weight: bold;">Article List</h5>
    </div>
    <div class="card-body">
        <form action="">
            <div class="row">
                   <div class="col-2">
                <input type="text" class="form-control" placeholder="Title" name="title">
            </div>

            <div class="col-2">
                <input type="text" class="form-control" placeholder="Slug" name="slug">
            </div>

            <div class="col-2">
                <input type="text" class="form-control" placeholder="Body" name="body">
            </div>

            <div class="col-2">
                <input type="text" class="form-control" placeholder="Tags" name="tags">
            </div> 


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
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Body</th>
                        <th>Tags</th>
                        <th>User</th>
                        <th>Actions</th> 
                    </tr>
                </thead>
                <tbody>
              
                @foreach($list as $article)  

               <tr>
                <td> {{ $article->title }}</td>
                <td> {{ $article->slug }}</td>
                 <td>
                    @if($article->status)
                    <a href="javascript:void(0)"  data-id="{{ $article->id }}" class="btn btn-success btn-sm btnChangeStatus">Active</a>
                    @else
                    <a href="javascript:void(0)"  data-id="{{ $article->id }}" class="btn btn-danger btn-sm btnChangeStatus">Passive</a>
                    @endif
                 </td>
                <td> {{ $article->body }}</td>
                <td> {{ $article->tags }}</td>
                <td> {{ $article->user->name }}</td>
                <td>
                <a href="{{ route('article.edit', ['id' => $article->id]) }}" class="btn btn-warning btn-sm"><i class="material-icons ms-0">edit</i></a>
                <a href="javascript:void(0)" class="btn btn-danger btn-sm btnDelete" data-id= "{{ $article->id }}" > <i class="material-icons ms-0">delete</i></a>
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
                let articleID = $(this).data("id");
                
                Swal.fire({
                    title: "Do you want to change the status?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    denyButtonText: `No`
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#statusChangeForm").attr("action", "{{ route('articles.changeStatus') }}");
                        $("#inputStatus").val(articleID);
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
                let articleID = $(this).data("id");

                Swal.fire({
                    title: "Do you want to Delete?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    denyButtonText: `No`
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#statusChangeForm").attr("action", "{{ route('articles.delete') }}");
                        $("#inputStatus").val(articleID);
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