@extends('layouts.master')

@section('content')
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="index.html">MoveOn</a>
            <span class="breadcrumb-item active">Create Post</span>
        </nav>

        <div class="sl-pagebody">
            <div class="row row-sm">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Create a Post</div>
                        <div class="card-body">
                            <form action="{{ route('store-post') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Post Content</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="post_content"
                                        placeholder="Post here ..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div><!-- card -->
                </div>

            </div>
        </div>
    </div>
@endsection
