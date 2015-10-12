@extends('frontend.layouts.master')

@section('content')
			<nav>
				<div id="welcome-division">

					<div id="welcome-division-category" class="row" style="background:
																	url('../images/backgrounds/divisions/{{$division->slug}}.jpg') no-repeat fixed 0% 70%;
																	-webkit-background-size: cover;
																	-moz-background-size: cover;
																	-o-background-size: cover;
																	background-size: cover;
																	overflow: hidden;"
																	>
						<div class="row" style="padding-top:52px;">
							<div id="welcome-division-menu" class="col-xs-12" style="opacity: 0.75;filter: alpha(opacity=75);padding:0px;">
								@foreach($nav_divisions as $category)

									<a href="{{url('division', array('id' => $category->id))}}">
										<div id="division_{{$category->id}}" style="opacity: 0.75;filter: alpha(opacity=75);background-color: #{{$category->bg_color}};min-height:67px;max-height:67px" class="col-md-2">
											<p style="text-align:center;padding-top:11px;text-transform:uppercase;">{{$category->name}}</p>
										</div>
									</a>

								@endforeach

						</div>
						</div>

				<div class="row">
					<div id="ph-name" class="col-md-4 col-md-offset-8 text-center" style="opacity: 0.75;filter: alpha(opacity=75)">
						<h1 style="background:#{{$division->bg_color}}">{{$division->name}}</h1>
					</div>
				</div>

			</div>

		</div>
	</nav>
	

	<div class="col-md-9 col-md-offset-1" style="overflow-x:hidden">

		<div id="ph-text" class="text-left">
			<?php
				$max = $news_feeds->get_item_quantity();
				for ($x = 0; $x < $max; $x++): $item = $news_feeds->get_item($x);
			?>

				<div class="col-md-12">
					<h3><a href="" data-toggle="modal" data-target="#myModal" style="color:#000">{{$item->get_title()}}</a></h3>

					<span class="label label-default" style="font-size:82%">{{$item->get_date('j F Y | g:i a')}}</span>
					<p><?php
						$description = $item->get_description();
						
 				   	 	 if (strlen($description) > 150){
							 
 				      	$str = substr($description, 0, 150) . '...';
						echo strip_tags($str, '<img>');
					 	}
						 else{
						
						echo strip_tags($description, '<img>');
						}
						
						 ?></p>
					<hr>
				</div>

			<?php endfor; ?>
		</div>

	</div>
@endsection

@section('after-scripts-end')
	<script>
		//Being injected from FrontendController
		console.log(test);
	</script>
@stop
