@extends("layouts.admin")

@section("title")
    User List
@endsection

@section("css")
    
@endsection

@section("content")
   
  <div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
            <th style="text-align: center;"><strong style="font-size: 20px;">Users</strong></th>
            </tr>
        </thead>
        <tbody>
            @foreach($userlist as $category)
            <tr>
                <td>{{ $category->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

  </div>

@endsection

@section("js")

@endsection
