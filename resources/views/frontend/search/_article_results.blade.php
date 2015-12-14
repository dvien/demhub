<div class="panel">

  <div class="panel-heading">
    <span class="panel-title">News</span>
  </div>

  <div class="panel-body">
    <table class="table mbn">

      <thead>
        <tr class="hidden">
          <th>Title</th>
          <th>#</th>
        </tr>
      </thead>

      <tbody>
        @forelse($articleResults as $article)
          <tr>
            <td class="va-m fw600 text-muted">
              <span class="fa fa-circle text-info fs14 mr10"></span>{{ $article['title'] }}
            </td>
            <td class="fs15 fw600 text-right">{{ $article['excerpt'] }}</td>
          </tr>
        @empty
          <br>No users to show<br>
        @endforelse
      </tbody>

    </table>
  </div>

</div>
