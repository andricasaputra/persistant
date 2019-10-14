@extends('layouts.main')

@section('breadcrumb')

<div class="row page-titles">
    <div class="col-md-6 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Paket</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">List Order Paket</li>
        </ol>
    </div>
    <div class="col-md-6 col-4 align-self-center">
    	<a href="{{ route('package.index') }}" class="btn pull-right hidden-sm-down btn-success">Pilih Paket</a>
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
		            <td>
		                @if ($payment->status == 'pending')
		                	<button class="btn btn-success" onclick="orderDetails('{{ $payment->snap_token }}')">Bayar</button>
		                @endif
		                <a href="#" class="btn btn-warning" target="_blank">Invoice</a>
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

    <pre><div id="result-json">JSON result will appear here after payment:<br></div></pre> 

@endsection

@section('extra_script')
	<script src="{{ !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
	<script>
		function orderDetails(token)
		{
		// 	const proxy = 'https://cors-anywhere.herokuapp.com/';
		// const midtransurl = `https://app.sandbox.midtrans.com/snap/v1/transactions/${token}`

		// $.get(proxy + midtransurl, function(data){
		// 	console.log(data)
		// });
			snap.pay(token, {
                // Optional
                onSuccess: function (result) {
                    //location.reload();
                    console.log('settlement')
                },
                // Optional
                onPending: function (result) {
                	console.log(result)
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    //location.reload();
                },
                // Optional
                onError: function (result) {
                    //location.reload();
                    console.log('error')
                }
            });

            //snap.hide();
		}
	</script>
@endsection