@extends('frontend.layouts.master')

@section('content')
	<div class="row">

		<ul>
			@foreach($sectors as $sector)
        <li>{{ $sector->name }}</li>
    	@endforeach
		</ul>

	</div><!-- row -->
@endsection

@section('after-scripts-end')
	<script>
		//Being injected from FrontendController
		console.log(test);
	</script>
@stop
