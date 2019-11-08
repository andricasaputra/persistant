@extends('layouts.main')

@section('breadcrumb')

<div class="row page-titles">
    <div class="col-md-9 align-self-center">
    	<div class="alert alert-info" style="font-weight: 400">
    		<b>Info!</b> Jika anda telah melakukan pembayaran namun status tetap pending, silahkan klik tombol status.
    	</div>
    </div>
    <div class="col-md-3 align-self-center">
    	<a href="{{ route('package.index') }}" class="btn pull-right hidden-sm-down btn-danger"><i class="fa fa-gift m-r-10" aria-hidden="true"></i> Beli Paket</a>
    </div>
</div>

@endsection

@section('content')
	
	<style>
		table thead tr th{
			text-align: center;
		}

		table tbody tr td, table tbody tr td:nth-child(7) > a, table tbody tr td:nth-child(7) > button{
			font-weight: 400;
			color: #000
		}
	</style>

	<table class="table table-bordered text-center" id="list">
		<thead class="thead-inverse">
			<tr>
	            <th>ID</th>
	            <th>Nama</th>
	            <th>Email</th>
	            <th>Jumlah</th>
	            <th>Paket</th>
	            <th>Status</th>
	            <th>Tanggal Pesan</th>
	            <th>Action</th>
	        </tr>
		</thead>
		<tbody>

			@forelse ($payments as $payment)
		        <tr>
		            <td><code>{{ $payment->id }}</code></td>
		            <td>{{ $payment->name }}</td>
		            <td>{{ $payment->email }}</td>
		            <td>Rp. {{ number_format($payment->amount) }},-</td>
		            <td>{{ ucwords(str_replace('_', ' ', $payment->package_type)) }}</td>
		            <td>{{ ucfirst($payment->status) }}</td>
		            <td>{{ $payment->created_at }}</td>
		            <td>
		                @if ($payment->status == 'pending')
		                	<button class="btn btn-success" onclick="orderDetails('{{ $payment->snap_token }}')" style="margin-bottom: 10px">Info pembayaran</button>
		                @endif
		                <a href="{{ route('payment.status', $payment->id) }}" class="btn btn-warning">Status</a>
		            </td>

		        </tr>
	        @empty
	        	<tr>
	        		<td colspan="6">Anda belum pernah melakukan pembelian</td>
	        	</tr>
	        @endforelse

	        <tr>
	            <td colspan="6">{{ $payments->links() }}</td>
	        </tr>
		</tbody>
       
    </table>

@endsection

@section('extra_script')
	<script src="{{ !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
	<script>
		function orderDetails(token)
		{
			snap.pay(token, {
                // Optional
                onSuccess: function (result) {
                },
                // Optional
                onPending: function (result) {
                },
                // Optional
                onError: function (result) {
                }
            });

		}
	</script>
@endsection