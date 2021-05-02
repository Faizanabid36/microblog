@extends('layouts.main')

@section('content')
    <section>
        <div class="gap gray-bg">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row" id="page-contents">
                            <div class="col-lg-3">
                                <aside class="sidebar static">
                                    <div class="widget">
                                        <h4 class="widget-title">Content</h4>

                                    </div><!-- Shortcuts -->

                                </aside>
                            </div><!-- sidebar -->
                            <div class="col-lg-6">
                                @if(Auth()->check())
                                    @if(session()->has('errors'))
                                        <div>
                                            <p class="alert alert-danger">{{session('errors')->first()}}</p>
                                        </div>
                                    @endif
                                    <div class="central-meta">
                                        <div class="new-postbox">
                                            <figure>
                                                <img src="{{auth()->user()->avatar??asset('assets/images/avatar.png')}}"
                                                     alt="">
                                            </figure>
                                            <div class="newpst-input">
                                                <form action="{{route('post.add')}}" method="post">
                                                    @csrf
                                                    <textarea rows="2" name="post_body"
                                                              placeholder="write something"></textarea>
                                                    <div class="attachments">
                                                        <ul>

                                                            <li>
                                                                <button type="submit">Post</button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div><!-- add post new box -->
                                @endif
                                <div class="loadMore" id="loadMore">
                                    @if(count($posts)>0)
                                        @foreach($posts as $post)
                                            <div class="central-meta item">
                                                <div class="user-post">
                                                    <div class="friend-info">
                                                    @if(Auth()->check() && auth()->user()->id==$post->user->id)
                                                    <p><a href="{{route('post.delete',$post->id)}}"><i class="fa fa-trash" aria-hidden="true" style="float:right"></i></a></p>
                                                    @endif
                                                        <figure>
                                                            <img
                                                                src="{{$post->user->avatar??asset('assets/images/avatar.png')}}"
                                                                alt="">
                                                        </figure>
                                                        <div class="friend-name">
                                                            <a href="{{route('timeline',$post->user->id)}}"
                                                               title="{{decrypt_string($post->user->name)}}">
                                                                <b>
                                                                    {{decrypt_string($post->user->name)}}
                                                                </b>
                                                            </a>

                                                            <span>published: {{$post->created_at->diffForHumans()}}</span>
                                                        </div>
                                                        <div class="post-meta">
                                                            <div class="description">

                                                                <p>

                                                                    {{decrypt_string($post->post_body)}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div><!-- centerl meta -->
                            <!-- sidebar-->
                            <div class="col-lg-3">
                                <div class="widget">
                                    <div class="banner medium-opacity bluesh">
                                        <div class="bg-image"
                                             style="background-image: url({{asset('assets/images/resources/baner-widgetbg.jpg')}})"></div>
                                        <div class="baner-top">
                                            <span><img alt="" src="{{asset('assets/images/book-icon.png')}}"></span>
                                            <i class="fa fa-ellipsis-h"></i>
                                        </div>
                                        <div class="banermeta">
                                            <p>
                                                create your own favourite page.
                                            </p>
                                            <span>like them all</span>
                                            <a data-ripple="" title="" href="#">start now!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')

    <script>
        $(document).ready(function () {
            let page = 1;
            let SITEURL = "{{ url('/') }}";
            let should_load = true;
            // load_more(page)


            $(window).scroll(function () {
                console.log('ere')
                if ($(window).scrollTop() + $(window).height() + 200 >= $(document).height()) {
                    page++;
                    if (should_load)
                        load_more(page);
                }
            });

            function load_more(page) {
                $.ajax({
                    url: SITEURL + "?page=" + page,
                    type: "get",
                    datatype: "html",
                })
                    .done(function (data) {
                        console.log(data.length)
                        if (data.length === 0) {
                            if (should_load) {
                                $("#loadMore").append($(`<div class="central-meta item">
                                            <div class="user-post">
                                                <div class="friend-info">

                                                    <div class="friend-name">
                                                        <ins><a href="time-line.html" title="">No blogs to show</a>
                                                        </ins>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>`));
                            }
                            should_load = false
                        } else {
                            $("#loadMore").append(data); //append data into #results element
                        }
                    })
                    .fail(function (jqXHR, ajaxOptions, thrownError) {
                        alert('No response from server');
                    });
            }
        })
    </script>
@endsection
