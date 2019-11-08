@extends('layouts.main')

@section('breadcrumb')

<div class="row page-titles">
    <div class="col-md-6 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Paket</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">List Order Paket</li>
        </ol>
    </div>
</div>

@endsection

@section('content')
	
	<div class="row">
		<div class="col-md-6">
			<h3>Order detail</h3>
			<table cellpadding="10" cellspacing="10">
				<tr>
					<td>ID Order</td>
					<td>:</td>
					<td>{{ $status->order_id }}</td>
				</tr>
				<tr>
					<td>Total</td>
					<td>:</td>
					<td>{{ $status->gross_amount }}</td>
				</tr>
				<tr>
					<td>Type pembayaran</td>
					<td>:</td>
					<td>{{ $status->payment_type }}</td>
				</tr>
			</table>
		</div>
		<div class="col-md-6">
			<h3>Status Pembayaran</h3>
			<table cellpadding="10" cellspacing="10">
				<tr>
					<td>Status</td>
					<td>:</td>
					<td><b>{{ $status->transaction_status }}</b></td>
				</tr>
				<tr>
					<td>Waktu transaksi</td>
					<td>:</td>
					<td>{{ $status->transaction_time }}</td>
				</tr>
				<tr>
					<td>Currenncy</td>
					<td>:</td>
					<td>{{ $status->currency }}</td>
				</tr>
			</table>
		</div>
	</div>	

	<div class="row" style="margin-top: 30px">
		<div class="col-md-12">
			<div class="text-center">
				<a href="{{ route('package.list') }}" class="btn btn-primary">Kembali</a>
			</div>
		</div>
	</div>

@endsection
