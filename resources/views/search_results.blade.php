@if (count($data) > 0)
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No results found.</p>
@endif
