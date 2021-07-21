<table>
    <thead>
    <tr>
        <th colspan="2" rowspan="3"></th>
        <th colspan="4" style="text-align: center;">Miss Renovation</th>
    </tr>
    <tr>
        <th colspan="4" style="text-align: center;">Jln. Mahogani Raya Poris Plawad Kec. Cipondoh</th>
    </tr>
    <tr>
        <th colspan="4" style="text-align: center;">Kota Tangerang - 081290728311</th>
    </tr>
    <tr>
        <th colspan="6"></th>
    </tr>
    <tr>
        <th>No</th>
        <th>Jatuh Tempo</th>
        <th>Customer</th>
        <th>Lokasi</th>
        <th>Biaya</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($salesReport->content as $i => $item)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ now()->parse($item['due'])->format('m/d/Y') }}</td>
            <td>{{ $item['customer'] }}</td>
            <td>{{ $item['address'] }}</td>
            <td>{{ number_format($item['total']) }}</td>
            <td>{{ $item['status'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
