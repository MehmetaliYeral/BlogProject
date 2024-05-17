@extends("layouts.admin")
@section("title","Article Create")
  
@section("css")
<link rel="stylesheet" href="{{ asset("assets/plugins/summernote/summernote-lite.min.css") }}" >
@endsection

@section("content")
<div class="card">
                                    <div class="card-header">
                                        <h2 class="card-title">  Article  {{ isset($article) ? "Update" : "Create" }}</h2>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-description">We offer some different custom styles for input fields to make your forms more beautiful.</p>
                                    <div class="example-container">
                                       <form action="{{ isset($article) ? route("article.edit",["id" => $article->id]) : route("article.create") }}" 
                                           method="POST" enctype="multipart/form-data"> 
                                        @csrf 
                                                <input type="text"                   
                                                 class="form-control form-control-solid-bordered m-b-sm" 
                                                 aria-describedby="solidBoderedInputExample" 
                                                 placeholder="Article Title"
                                                 name="title"
                                                 value="{{ isset($article) ? $article->title : "" }}" 
                                                 required
                                                >

                                                <input type="text"                   
                                                 class="form-control form-control-solid-bordered m-b-sm" 
                                                 aria-describedby="solidBoderedInputExample" 
                                                 placeholder="Tags"
                                                 name="tags"
                                                 value="{{ isset($article) ? $article->tags : "" }}" 
                                                 required 
                                                >
                                                
                                                <input type="text" 
                                                 class="form-control form-control-solid-bordered m-b-sm" 
                                                 aria-describedby="solidBoderedInputExample" 
                                                 placeholder="Article Slug"
                                                 name="slug"
                                                 value="{{ isset($article) ? $article->slug : "" }}" 
                                                >

                                                <textarea
                                                 class="form-control form-control-solid-bordered m-b-sm" 
                                                 name="description"
                                                 id=""
                                                 cols="30"
                                                 rows="5"
                                                 placeholder="Article Description"
                                                 style="resize: none">{{ isset($article) ? $article->description : "" }}</textarea>

                                                <textarea
                                                 class="form-control form-control-solid-bordered m-b-sm" 
                                                 name="seo_keywords"
                                                 id="seo_keywords"
                                                 cols="30" 
                                                 rows="5"
                                                 placeholder="Seo Keywords"
                                                 style="resize: none">{{ isset($article) ? $article->seo_keywords : "" }} </textarea>

                    

                                                 <textarea
                                                 class="form-control form-control-solid-bordered m-b-sm" 
                                                 name="seo_description"
                                                 id="seo_description"
                                                 cols="30"
                                                 rows="5"
                                                 placeholder="Seo Description"
                                                 style="resize: none">{{ isset($article) ? $article->seo_description : "" }}</textarea>

                                                 <select
                                            
                                                 class="form-select form-control form-control-solid-bordered m-b-sm"
                                                 name="category_id"
                                                 >
                                                 <option value="{{ null }}">Select Category</option>
                                                  @foreach($categories as $item)
                                                  <option value="{{ $item->id }}" {{ isset($article) && $article->category_id == $item->id ? "selected" : ""}}>
                                                     {{ $item->name }}
                                                  </option>
                                                  @endforeach 
                                                 </select>


                                                 <textarea name="body" id="summernote" class="m-b-sm">Summernote</textarea>   

                                                  <div class="form-check">
                                                  <input class="form-check-input" type="checkbox" name="status "value="1" id="status" {{ isset($category) && $category->status ? "checked" : "" }}>
                                                  <label class="form-check-label" for="status"> Should the article appear on the site?</label>
                                                  </div>
                                                    
                                                
                                                   <div class="col-6 mx-auto mt-5">
                                                     <button type="submit" class="btn btn-success btn-rounded w-100">,
                                                     {{ isset($article) ? "Update" : "Create" }}
                                                    </button>
                                                   </div>

                                       </form>

                                            <div class="example-content">
                                               
                                            </div>
                                            <div class="example-code">

                                            </div>
                                        </div>
                                    </div>
                                </div>

@endsection

@section("js")
 <script src="{{ asset("assets/plugins/summernote/summernote-lite.min.js") }}"></script> 
 <script src="{{ asset("assets/js/pages/text-editor.js") }}"></script> 

@endsection