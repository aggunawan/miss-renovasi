<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Statement {{ $invoice->number }}</title>
</head>
<body style="font-size: 14px;">
	<table style="width: 100%; padding: 0.5rem; border: 1px solid black;">
		<tr>
			<td rowspan="3" width="25%">
				<img src="https://res.cloudinary.com/aggunawan/image/upload/v1623162330/Renovasi/logo.jpg" alt="Logo" width="100">
			</td>
			<td style="text-align: center;"><strong>CV MISS RENOVATION</strong></td>
			<td width="25%"></td>
		</tr>
		<tr>
			<td style="text-align: center;"><strong>Jln. Mahogani Raya Poris Plawad Kec. Cipondoh</strong></td>
			<td width="25%"></td>
		</tr>
		<tr>
			<td style="text-align: center;"><strong>Kota Tangerang - 081290728311</strong></td>
			<td width="25%"></td>
		</tr>
	</table>

	<table style="width: 100%; padding: 0.5rem; border-right: 1px solid black; border-left: 1px solid black;">
		<tr>
			<td style="text-align: center;"><strong>INVOICE</strong></td>
		</tr>
	</table>

	<table style="width: 100%; border-right: 1px solid black; border-left: 1px solid black; padding: 0 0.5rem;">
		<tr>
			<td width="50%">Tagihan Kepada</td>
			<td width="20%">No. Invoice</td>
			<td width="30%"> : {{ $invoice->number }}</td>
		</tr>
	</table>

	<table style="width: 100%; border-right: 1px solid black; border-left: 1px solid black; padding: 0 0.5rem; padding-bottom: 2rem;">
		<tr>
			<td width="10%">Nama</td>
			<td width="40%">: {{ $invoice->customer->name }}</td>
			<td width="20%">Tanggal</td>
			<td width="30%"> : {{ $invoice->date->format('d F Y') }}</td>
		</tr>
		<tr>
			<td width="10%">Alamat</td>
			<td width="40%">: {{ $invoice->customer->address }}</td>
			<td width="20%">No. Kontrak</td>
			<td width="30%"> : {{ $invoice->contract_number }}</td>
		</tr>
		<tr>
			<td width="10%">Phone</td>
			<td width="40%">: {{ $invoice->customer->phone }}</td>
			<td width="20%">Jatuh Tempo</td>
			<td width="30%"> : {{ $invoice->due->format('d F Y') }}</td>
		</tr>
	</table>

	<table style="width: 100%; padding: 0.5rem 1rem; border-right: 1px solid black; border-left: 1px solid black;" cellspacing="">
		<tr>
			<td style="text-align: center; border: 1px solid black;" width="10%">No</td>
			<td style="text-align: center; border: 1px solid black;" width="70%">Deskripsi</td>
			<td style="text-align: center; border: 1px solid black;" width="20%">Total</td>
		</tr>

		@foreach ($invoice->contents as $i => $item)
		<tr>
			<td style="text-align: center; border: 1px solid black;" width="10%">{{ $i + 1 }}</td>
			<td style="border: 1px solid black;" width="70%">{{ $item['name'] }}</td>
			<td style="text-align: right; border: 1px solid black;" width="20%">{{ $item['price'] }}</td>
		</tr>
		@endforeach
	</table>

	<table style="width: 100%; border-right: 1px solid black; border-left: 1px solid black; padding: 1rem 0.5rem;">
		<tr>
			<td>Pembayaran tersebut harus dilakukan melalui transfer ke rekening :</td>
		</tr>
		<tr>
			<td>Penerima : {{ $invoice->bankAccount->holder }}</td>
		</tr>
		<tr>
			<td>Bank : {{ $invoice->bankAccount->bank }}</td>
		</tr>
		<tr>
			<td>No rekening  : {{ $invoice->bankAccount->number }}</td>
		</tr>
	</table>
	<table style="width: 100%; padding: 0.5rem; border: 1px solid black;">
		<tr>
			<td style="text-align: right;">Tangerang, {{ $invoice->date->format('d F Y') }}</td>
		</tr>
		<tr>
			<td style="text-align: right; padding: 0 1rem;">
				<img src="https://res.cloudinary.com/aggunawan/image/upload/v1623162330/Renovasi/logo.jpg" alt="Logo" width="100">
			</td>
		</tr>
		<tr>
			<td style="text-align: right;">{{ $invoice->user->name . ' (Admin)' }}</td>
		</tr>
	</table>
 </body>
</html>