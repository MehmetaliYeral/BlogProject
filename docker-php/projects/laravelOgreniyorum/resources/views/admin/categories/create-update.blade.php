
@extends("layouts.admin")
 @section("title")

    Article  {{ isset($category) ? "Update" : "Create" }}
@section("css")
@endsection

@section("content")
                        <div class="card">
                                    <div class="card-header">
                                        <h2 class="card-title">  Category  {{ isset($category) ? "Update" : "Create" }}</h2>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-description">We offer some different custom styles for input fields to make your forms more beautiful.</p>
                                    <div class="example-container">
                                       <form action="{{ isset($category) ? route("categories.edit",["id" => $category->id]) : route("category.create") }}" method="POST">
                                        @csrf 
                                                <input type="text" 
                                                 class="form-control form-control-solid-bordered m-b-sm" 
                                                 aria-describedby="solidBoderedInputExample" 
                                                 placeholder="Category Name"
                                                 name="name"
                                                 value="{{ isset($category) ? $category->name : "" }}" 
                                                 required 
                                                >

                                                <input type="text" 
                                                 class="form-control form-control-solid-bordered m-b-sm" 
                                                 aria-describedby="solidBoderedInputExample" 
                                                 placeholder="Category Slug"
                                                 name="slug"
                                                 value="{{ isset($category) ? $category->slug : "" }}" 
                                                >

                                                <textarea
                                                 class="form-control form-control-solid-bordered m-b-sm" 
                                                 name="description"
                                                 id=""
                                                 cols="30"
                                                 rows="5"
                                                 placeholder="Category Description"
                                                 style="resize: none">{{ isset($category) ? $category->description : "" }}</textarea>

                                                 <input type="number" 
                                                 class="form-control form-control-solid-bordered m-b-sm" 
                                                 aria-describedby="solidBoderedInputExample" 
                                                 placeholder="Category Order"
                                                 name="order"
                                                 value="{{ isset($category) ? $category->order : "" }}" 
                                                >

                                                <textarea
                                                 class="form-control form-control-solid-bordered m-b-sm" 
                                                 name="seo_keywords"
                                                 id="seo_keywords"
                                                 cols="30"
                                                 rows="5"
                                                 placeholder="Seo Keywords"
                                                 style="resize: none">{{ isset($category) ? $category->seo_keywords : "" }} </textarea>

                                                 <textarea
                                                 class="form-control form-control-solid-bordered m-b-sm" 
                                                 name="seo_description"
                                                 id="seo_description"
                                                 cols="30"
                                                 rows="5"
                                                 placeholder="Seo Description"
                                                 style="resize: none">{{ isset($category) ? $category->seo_description : "" }}</textarea>


                                                  <div class="form-check">
                                                  <input class="form-check-input" type="checkbox" name="status "value="1" id="status" {{ isset($category) && $category->status ? "checked" : "" }}>
                                                  <label class="form-check-label" for="status"> Should the category appear on the site?</label>
                                                  </div>
 
                                                  <div class="form-check">
                                                  <input class="form-check-input" type="checkbox" name="featue_status "value="1" id="feaure_status" {{ isset($category) && $category->feature_status ? "checked" : "" }}>
                                                  <label class="form-check-label" for="feature_status"> Should the category be featured on the homepage? </label>
                                                  </div>

                                                   <div class="col-6 mx-auto mt-5">
                                                     <button type="submit" class="btn btn-success btn-rounded w-100 btnSave" >,
                                                     {{ isset($category) ? "Update" : "Create" }}
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

@endsection