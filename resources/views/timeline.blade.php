@extends('layouts.main')

@section('content')
    <section>
        <div class="feature-photo">
            <figure><img src="{{asset('assets/images/resources/timeline-1.jpg')}}" alt=""></figure>
            <div class="add-btn">

            </div>
           
            <div class="container-fluid">
                <div class="row merged">
                    <div class="col-lg-2 col-sm-3">
                        <div class="user-avatar">
                            <figure style="height:250px">
                                <img src="{{$user->avatar??asset('assets/images/avatar.png')}}" alt="">
                                @if(Auth()->check() && auth()->user()->id==$user->id)
                                    <form id="dp-form" action="{{route('profile.changeDP')}}"
                                          enctype="multipart/form-data"
                                          method="post" class="edit-phto">
                                        @csrf
                                        <i class="fa fa-camera-retro"></i>
                                        <label class="fileContainer">
                                            Edit Display Photo
                                            <input id="change-dp" name="avatar" type="file"/>
                                        </label>

                                    </form>
                                @endif
                            </figure>
                        </div>
                    </div>
                    <div class="col-lg-10 col-sm-9">
                        <div class="timeline-info">
                            <ul>
                                <li class="admin-name">
                                    <h5>{{decrypt_string($user->name)}}</h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- top area -->
    <section>
        <div class="gap gray-bg">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row" id="page-contents">
                            <div class="col-lg-3">
                                <aside class="sidebar static">
                                    <div class="widget">
                                        <h4 class="widget-title">Shortcuts</h4>

                                    </div><!-- Shortcuts -->

                                </aside>
                            </div><!-- sidebar -->
                            <div class="col-lg-6">
                                @if(Auth()->check() && auth()->user()->id==$user->id)
                                    <div class="central-meta">
                                        <div class="new-postbox">
                                            <figure>
                                                <img src="{{Auth()->user()->avatar??asset('assets/images/avatar.png')}}"
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
                                <div class="loadMore">
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
                                                            <ins><a href="time-line.html"
                                                                    title="">{{(decrypt_string($post->user->name))}}</a>
                                                            </ins>
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
                                    @else
                                        <div class="central-meta item">
                                            <div class="user-post">
                                                <div class="friend-info">

                                                    <div class="friend-name">
                                                        <ins><a href="#" title="">No blogs to show</a></ins>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    @endif
                                </div><!-- centerl meta -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
