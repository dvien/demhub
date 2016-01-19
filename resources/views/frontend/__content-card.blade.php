<div class = "feed_width">
@foreach($items as $item)
  <div class="col-xs-12 col-sm-6 col-md-4 col-lg-feed">
    <?php
      $articleDivs = array_filter(preg_split("/\|/", $item['divisions']));
      if ($articleDivs) {
        sort($articleDivs);
        $width = 100/count($articleDivs);
        $marginLeft = 0;
      }

    ?>

    <div class = "feedsbox">

      @forelse($articleDivs as $div)
        <a style="width:{{$width}}%; margin-left:{{$marginLeft}}%;" href="{{url('division', $allDivisions[$div-1]->slug)}}" class="color-label division_{{$allDivisions[$div-1]->slug}} col-xs-6"></a>

      @empty
        <div class="color-label division_{{$currentDivision->slug}}"></div>
      @endforelse

      <div class="inner-peoplebox">
        <div class="article-background" style=
        <?php
        $neededSearchValue=$item["id"];
        $neededObject = array_filter(
          $articleMediaArray,
          function ($e) use (&$neededSearchValue){
            if ($e->article_id == $neededSearchValue){
              return $e;

            }
          }
        );

        if (isset($neededObject[0])){
          echo '"background-image:url('.$neededObject[0]->filename.');
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            margin-top:8px;
            margin-left:-10px;
            margin-right:-10px;
            height:230px;
            background-position-y: 30%;
                              "';
        }
        else {
          echo '""';
        }
        ?>>
      <div style=
      @if (isset($neededObject[0]))
      "background-color:rgba(200, 200, 200, 0.5);height:230px;"
      @else
      ""
      @endif
      >
    </div>
  </div>

        <h3 class=
        @if (isset($neededObject[0]))
        "article-title-box article-link"
        @else
        ""
        @endif
        style="padding-top:0px;margin-bottom:0px"
        >
          <a
            @if(Auth::check())
              target="_blank" href="{{ $item['url'] }}"
            @else
              href="" data-toggle="modal" data-target="#DEMHUBModal"
            @endif
          class="main-blue-color">
          <?php
            if (strlen($item['name']) > 66){
              $str = substr($item['name'], 0, 66) . '...';
              echo $str;
            } else{
              echo $item['name'];
            }
          ?>
          </a>
        </h3>

        <span class=
        @if (isset($neededObject[0]))
          "article-title-box"
        @endif
        "" style="font-size:82%;color:#777777;">
          {{ date_format(new DateTime($item['publish_date']), 'j F Y | g:i a') }}
        </span>

        <span
          @if (isset($neededObject[0]))
            class= "article-title-box"
          @endif
            style="font-size:82%;color:#000;padding-left:5%">
          <?php
            $parse=parse_url($item['url']);
            $host=$parse['host'];
            $host=substr($host,4);

            if (substr_count($host,".") <= 1){
              echo '<a target="_blank" href="http://www.'.$host.'">'.$host.'</a>';
            }
          ?>
        </span>



        <p style="padding-top:10px">
          <?php
          $description = $item['description'];

            if (isset($neededObject[0]) && strlen($description) > 127){
              $str = substr($description, 0, 127) . '...';
              echo strip_tags($str);
            }
             else{
              echo strip_tags($description);
            }
          ?>
        </p>
        <div style="bottom:50px; position:absolute;width:100%;">

          <?php
          $keywords = array_filter(preg_split("/\|/", $item['keywords']));
          ?>
          @if(count($keywords) > 4)
            @include('division.__keyword-dropup-foreach')
          @elseif(count($keywords) <5)
            @foreach($keywords as $key=>$keyword)
              @if ($key ==1)

              <a class="label label-default triangle-right" style="font-size:82%;margin-right:2px;" href="?query_term={{$keyword}}">
                {{ $keyword }}
              </a>


              @elseif ($key >1)
              <a class="label label-default triangle-right" style="font-size:82%;margin-right:2px;" href="?query_term={{$keyword}}">
                {{ $keyword }}
              </a>

              @endif
            @endforeach

          @endif
        </div>
        <div style="width:100%; height:42px; bottom:0px; position:absolute;">
          @include('division.__article_buttons')
        </div>

      </div>
      </div>
    </div> <!-- the div that closes the box -->


@endforeach
</div>
