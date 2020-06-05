<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;
use App\Http\Requests\UploadRequest;
use Illuminate\Support\Facades\Artisan;
use App\Repositories\Uploads\UploadFactory as Factory;

class UploadController extends Controller
{
	public function __construct()
	{
		$this->middleware('user.setting')->only(['showFailedJob', 'action']);
	}

    public function upload()
	{
		return view('upload');
	}

	public function create(UploadRequest $request)
	{
		$factory = Factory::init($request);

		$upload = $factory->make();

		if ($upload === false) {

			return back()->withWarning("Terjadi kesalahan pada server, silahkan coba beberapa saat lagi");
		}

		return back()->withSuccess("$upload data berhasil diupload ke E-Personal anda");
	}

	public function showFailedJob()
	{
		$datas = auth()->user()->failedJob()->get();

		$datas->each(function($data){

			$data['datas'] = json_decode($data['datas'], true);

			return $data;
		});
		
		return view('failed')->withFails($datas);
	}

	public function action(Request $request)
	{
		if ($request->type == 'retry') {
			$this->retry($request);
		} elseif ($request->type == 'forget') {
			$this->forget($request);
		}
	}

	protected function retry(Request $request)
	{
		$retry = Artisan::call('queue:retry', ['id' => $request->id]);

		session()->flash('success', 'Data berhasil dimasukkan kembali ke dalam antrian upload');
		
		return response()->json($retry);
	}

	protected function forget(Request $request)
	{
		$forget = Artisan::call('queue:forget', ['id' => $request->id]);

		session()->flash('success', 'Data berhasil dihapus');

		return response()->json($forget);
	}

}
