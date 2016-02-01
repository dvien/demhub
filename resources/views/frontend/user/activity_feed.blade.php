@extends('frontend.layouts.master')

@section('content')
<div class="container-fluid row">
	<h3 class="text-center" style="color: #ccc">Latest</h3>

	<div id="activity-feed" class="col-xs-12 col-sm-offset-3 col-sm-6" data-page="0" data-url="{{url('get_activities')}}" style="border:none">
		<?php // populated by jquery, takes partial render of _activity_feed_item view ?>
	</div>
</div>

<script>

function twitterActivate (item) {
	var twitterElement;
  twitterElement=$(item).find($(".article_twitter"));
	$(twitterElement).addClass("twitter-share-button");
	!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(document.body){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');

};
	$(document).ready(function(){
		get_activities();
	});
	var timeOut = 0;
	var topCheck=false;
	$(window).on("scroll", function(){		// this might be anything else depends on what container has the scroll bar
		// if (jQuery(this).scrollTop() + jQuery(this).innerHeight() >= jQuery(this)[0].scrollHeight - 300) { //just a guess as starting point, has to be tested
		// 	get_activities();
		// }
		var a = $("#activity-feed").offset().top;
		var b = $("#activity-feed").height();
		var c = $(window).height();
		var scrollTop = $(window).scrollTop();
		var scrollBottom = $(window).scrollTop() + a;

		if ((c+scrollTop)>(a+b) && timeOut!==1) {
			timeOut = 1;
			get_activities();
		}

		if ( scrollBottom<-1 && timeOut!==1) {
            //alert( $(this).text() + ' was scrolled to the top' );
						timeOut = 1;
						topCheck=true;
						get_activities();
        }
	});



	function get_activities()
	{
		var activity_feed = $("#activity-feed");
		var current_page = activity_feed.attr("data-page");		// add this to the div when available
		if (topCheck==1){
			var new_page = 0;
		}
		else{
			var new_page =  parseInt(current_page)+1;
		};
		$.ajax({
			type: "get",
			url: activity_feed.attr("data-url")+"?page="+new_page,
			async: true,
			beforeSend: function(){
				$(".loading").show();
			},
			complete: function(jqHXR, status){
				//
				$("#loading-content").fadeOut(200);
			},
			success: function(response) {
				if(topCheck==true){
					$(activity_feed).html(response);
				}
				else {
					activity_feed.append(response);
				};
				setTimeout(function(){timeOut=0; topCheck=false;},550);
				activity_feed.attr("data-page", new_page);

				// if (response.status == 'ok') {
				// 	activity_feed.attr("data-page", new_page);
				// 	$.each(response.data, function(index, value){
				//
				// 	});
				// } else {
				//
				// }
			}
		});
	}
</script>
@endsection