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

                                <div class="widget stick-widget">
                                    <h4 class="widget-title">Edit info</h4>

                                </div><!-- settings widget -->
                            </aside>
                        </div><!-- sidebar -->
                        <div class="col-lg-6">
                            <div class="central-meta">
                                <div class="editing-info">
                                    <h5 class="f-title"><i class="ti-info-alt"></i> Edit Basic Information</h5>
                                    <form action="{{route('profile.updateProfile')}}" method="post">
                                        @csrf
                                        @if(session()->has('errors'))
                                            <p class="alert alert-danger">
                                                <strong>{{ session()->get('errors')->first() }}</strong>
                                            </p>
                                        @endif
                                        <input name="user_id" value="{{$user->id}}" hidden/>
                                        <div class="form-group half">
                                            <input type="text" name="name" value="{{decrypt_string($user->name)}}"
                                                   required="required"/>
                                            <label class="control-label">Name</label><i class="mtrl-select"></i>
                                        </div>
                                        <div class="form-group half">
                                            <input type="email" name="email"
                                                   placeholder="{{decrypt_string($user->email)}}"
                                                   value="{{decrypt_string($user->email)}}"
                                                   required="required"/>
                                            <label class="control-label">Email</label><i class="mtrl-select"></i>
                                        </div>
                                        <div class="submit-btns">
                                            <button type="button" class="mtr-btn"><span>Cancel</span></button>
                                            <button type="submit" class="mtr-btn"><span>Update</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div><!-- centerl meta -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
