@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            {{isset($post) ? 'Edit Post' : 'Create Post'}}
        </div>

        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-group">
                        @foreach($errors->all() as $error)


                            <li class="list-group-item text-danger">
                                {{$error}}
                            </li>

                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{isset($post) ? route('posts.update',$post->id) :route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($post))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" id="title" class="form-control" name="title" value="{{isset($post) ? $post->title : ''}}">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea  id="decription" class="form-control" cols="5" rows="5" name="decription" >{{isset($post) ? $post->decription : ''}}</textarea>
                </div>
                <div class="form-group">
                    <label>Content</label>

                    <input id="content" type="hidden" name="content" value="{{isset($post) ? $post->content : ''}}">
                    <trix-editor input="content"></trix-editor>
                </div>
                <div class="form-group">
                    <label>Published At</label>
                    <input type="text" id="publish_at" class="form-control" name="publish_at" value="{{isset($post) ? $post->publishes_at	 : ''}}">
                </div>

                @if(isset($post))
                    <div class="form-group">
                        <img src="{{URL::asset('storage/'.$post->image)}}" alt="" width="60px" height="60px" />
                    </div>
                @endif
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" id="image" class="form-control" name="image">
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="category" id="category">
                        <option>Select Category</option>
                        @foreach($category as $cat)

                            <option value="{{$cat->id}}"
                           @if(isset($post))
                           @if($cat->id = $post->category_id)
                           selected
                           @endif
                           @endif
                            >
                                {{$cat ->name}}
                            </option>
                         @endforeach
                    </select>

                        @if($tags->count() > 0)
                            <div class="form-group">
                                <label>Tags</label>
                                <select name="tags[]" id="tags" class="form-control tag-selector" multiple>
                                    @foreach($tags as $tag)

                                        <option value="{{$tag->id}}"
                                                @if(isset($tag))
                                                @if($tag->id = $tag->tag_id)
                                                selected
                                            @endif
                                            @endif>
                                            {{$tag -> name}}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        @endif


                <div class="form-group">


                    <button class="btn btn-success" style="color: white">{{isset($post) ? 'Update Post' : 'Add Post'}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.1.1/trix.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
            <script>
                flatpickr('#publish_at',{
                    enableTime: true,
                    enableSeconds : true
                })
                $(document).ready(function() {
                    $('.tag-selector').select2();
                })
            </script>
@endsection

@section('css')
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.1.1/trix.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />


@endsection
