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
        <th>Customer</th>
        <th>Lokasi</th>
        <th>Jatuh Tempo</th>
        <th>Biaya</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($salesReport->content as $i => $item)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $item['customer'] }}</td>
            <td>{{ $item['address'] }}</td>
            <td>{{ now()->parse($item['invoices'][0]['due'])->format('d/m/Y') }}</td>
            <td>{{ number_format($item['invoices'][0]['total']) }}</td>
            <td>{{ $item['invoices'][0]['status'] }}</td>
        </tr>
        @foreach($item['invoices'] as $i => $invoice)
            @if($i != 0)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ now()->parse($invoice['due'])->format('d/m/Y') }}</td>
                <td>{{ number_format($invoice['total']) }}</td>
                <td>{{ $invoice['status'] }}</td>
            </tr>
            @endif
        @endforeach
    @endforeach
    </tbody>
</table>
