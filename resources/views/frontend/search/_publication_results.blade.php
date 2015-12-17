<thead>
  <tr class="hidden">
    <th>Title</th>
    <th>#</th>
  </tr>
</thead>

<tbody>
  @forelse($publicationResults as $publication)
    <tr>
      <td>

        <a href="{{ $article['source_url'] }}" style="color:#000">
          {{ $publication['title'] }}
        </a>

        {{-- <span class="fa fa-circle text-info fs14 mr10"></span> --}}

      </td>
      <td class="text-muted text-right">{{ $publication['publication_author'] }}</td>
    </tr>
  @empty
    <br>No publications to show<br>
  @endforelse
</tbody>
