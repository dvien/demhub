@extends('frontend.layouts.master')

@section('content')
  <section id="content_wrapper" style="margin-top: 60px;">
    <!-- Begin: Content -->
    <div id="content" class="animated fadeIn col-sm-offset-2" style="">

      <a type="button" class="btn btn-style-alt" href="{{ route('connections') }}">
        <span class="fa fa-users"></span> MY NETWORK
      </a>

      <div class="row center-block mt10">

        @include('frontend.user._user-card')

      </div>

    </div>
  </section>
@endsection
