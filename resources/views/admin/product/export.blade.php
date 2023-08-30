<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Produk</th>
            <th>Tipe</th>
            <th>Price</th>
            <th>Stock</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($product as $index => $row)
        <tr>
            <td scope="row">{{ $index + 1 }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->type }}</td>
            <td>{{ $row->price }}</td>
            <td>{{ $row->stock }}</td>
        </tr>
        @endforeach
    </tbody>
</table>