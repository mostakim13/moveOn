@extends('layouts.master')

@section('content')
    <div class="sl-mainpanel">
        {{-- <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="index.html">MoveOn</a>
            <span class="breadcrumb-item active">Post</span>
        </nav> --}}

        <div class="sl-pagebody">
            <div class="row row-sm">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Newsfeed</h4>
                        </div>

                        @foreach ($posts as $post)
                            <div class="card-body">

                                <h6>{{ $post->user->first_name }} {{ $post->user->last_name }}</h6>
                                <p>{{ $post->post_content }}</p>
                                @foreach ($pageposts as $pagepost)
                                    <h6>{{ $pagepost->page->page_name }}</h6>
                                    <p>{{ $pagepost->post_content }}</p>
                                @endforeach

                            </div>
                        @endforeach

                        <div class="d-flex justify-content-end mr-4">
                            {!! $posts->links() !!}
                        </div>
                    </div><!-- card -->

                </div>


                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-body">
                                @php
                                    $users = App\Models\User::where('id', '!=', Auth::user()->id)->get();
                                    $pages = App\Models\Page::all();
                                    $follows = App\Models\Follow::where('person_id', Auth::id())->first();

                                    $followpages = App\Models\Followpage::where('person_id', Auth::id())->first();

                                @endphp


                                <div>
                                    <div>
                                        <h5>Persons</h5>
                                    </div>

                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Person Name</th>
                                                <th scope="col">Follow</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <form action="{{ route('follow-person') }}" method="POST">
                                                @csrf
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <input type="hidden" name="following_id"
                                                            value="{{ $user->id }}">
                                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>

                                                        <td>
                                                            @isset($follows->following_id)
                                                                <button type="submit" class="btn btn-sm btn-primary"
                                                                    disabled>Following</button>
                                                            @else
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-primary">Follow</button>
                                                            @endisset



                                                        </td>


                                                    </tr>
                                                @endforeach

                                            </form>

                                        </tbody>
                                    </table>
                                </div>

                                <div>
                                    <div>
                                        <h5>Pages</h5>
                                    </div>
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Page Name</th>
                                                <th scope="col">Follow</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <form action="{{ route('follow-page') }}" method="POST">
                                                @csrf

                                                @foreach ($pages as $page)
                                                    <tr>
                                                        <input type="hidden" name="following_id"
                                                            value="{{ $page->id }}">
                                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                                        <td>{{ $page->page_name }}</td>
                                                        <td>
                                                            @isset($followpages->following_id)
                                                                <button type="submit" class="btn btn-sm btn-primary"
                                                                    disabled>Following</button>
                                                            @else
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-primary">Follow</button>
                                                            @endisset
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </form>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
