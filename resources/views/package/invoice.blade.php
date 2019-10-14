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

	<table class="table table-bordered text-center" id="invoice">
		<tbody></tbody>
    </table>

    <pre><div id="result-json">JSON result will appear here after payment:<br></div></pre> 

@endsection

@section('extra_script')
	<script src="{{ !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
	<script>
		const snap_token = '{{ $payment->snap_token }}'
		const midtransurl = `https://app.sandbox.midtrans.com/snap/v1/transactions/${snap_token}`

		$.post(midtransurl, function(data){
			console.log(data)
		});
	</script>
@endsection