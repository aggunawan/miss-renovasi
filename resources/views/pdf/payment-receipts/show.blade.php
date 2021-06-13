<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Receipt {{ $receipt->id }}</title>
</head>
<body style="font-size: 14px;">
	<table style="width: 100%; padding: 0.5rem; border: 1px solid black; background-color: yellow;">
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
	<table style="width: 100%; padding: 0.5rem; border: 1px solid black; border-bottom: none; border-top: none;">
		<tr>
			<td width="10%" style="background-color: yellow; text-align: center;">
				<strong>No. <span>{{ $receipt->id }}</span></strong>
			</td>
			<td width="90%" style="text-align: center;">KWITANSI</td>
		</tr>
	</table>
	<table style="width: 100%; padding: 0.5rem; border: 1px solid black; border-top: none; border-bottom: none;">
		<tr>
			<td width="25%">Telah terima dari</td>
			<td width="75%" style="border-bottom: 1px solid black;">: <strong>{{ $receipt->customer->name }}</strong></td>
		</tr>
	</table>
	<table style="width: 100%; padding: 0.5rem; border: 1px solid black; border-top: none; border-bottom: none;">
		<tr>
			<td width="25%">Uang Sejumlah</td>
			<td width="75%" style="border-bottom: 1px solid black; background-color: gainsboro;">: {{ $receipt->counted }}</td>
		</tr>
	</table>
	<table style="width: 100%; padding: 0.5rem; border: 1px solid black; border-top: none; border-bottom: none;">
		<tr>
			<td width="25%">Untuk Pembayaran</td>
			<td width="75%" style="border-bottom: 1px solid black;">: {{ $receipt->note }}</td>
		</tr>
	</table>
	<table style="width: 100%; padding: 0.5rem; border: 1px solid black; border-top: none; border-bottom: none;">
		<tr>
			<td width="70%">
				Rp. <strong style="text-decoration: underline; background-color: gainsboro;">{{ number_format($receipt->amount) }}</strong>
			</td>
			<td width="30%" style="text-align:center;">
				<span style="text-decoration:underline;">Tangerang, {{ $receipt->created_at->format('d F Y') }}</span>
			</td>
		</tr>
	</table>
	<table style="width: 100%; padding: 0.5rem; border: 1px solid black; border-top: none; padding-top: 5rem;">
		<tr>
			<td width="70%"></td>
			<td width="30%" style="text-align:center;">
				<span style="text-decoration:underline;">({{ $receipt->user->name }})</span>
			</td>
		</tr>
	</table>
 </body>
</html>