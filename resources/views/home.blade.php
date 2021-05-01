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
								<div class="central-meta">
									<div class="new-postbox">
										<figure>
											<img src="{{Auth()->user()->avatar??asset('assets/images/resources/admin2.jpg')}}" alt="">
										</figure>
										<div class="newpst-input">
											<form action="{{route('post.add')}}" method="post">
                                                @csrf
												<textarea rows="2" name="post_body" placeholder="write something"></textarea>
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
											<figure>
												<img src="{{asset('assets/images/resources/friend-avatar10.jpg')}}" alt="">
											</figure>
											<div class="friend-name">
												<ins><a href="time-line.html" title="">{{$post->user->name}}</a></ins>
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
												<ins><a href="time-line.html" title="">No blogs to show</a></ins>
											</div>
										
										</div>
										
									</div>
								</div>
                                @endif
								
								
								</div>
							</div><!-- centerl meta -->
							<!-- sidebar-->
						</div>	
					</div>
				</div>
			</div>
		</div>	
	</section>
@endsection
