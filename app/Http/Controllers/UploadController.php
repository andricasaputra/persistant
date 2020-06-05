<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;
use App\Repositories\Uploads\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

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
		$upload = Factory::init($request);

		if ($upload === false){
			return back()->withWarning("Terjadi kesalahan pada server, silahkan coba beberapa saat lagi");
		}
			
		$setting = auth()->user()->setting()->first();
		
		if ($setting->upload_setting == 'sync'){
			return back()->withSuccess("$upload data berhasil diupload ke E-Personal anda");
		}
			
		return back()->withSuccess("$upload data berhasil dimasukkan ke dalam antrian untuk diupload ke E-personal");
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
