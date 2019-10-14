<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;
use App\Repositories\UploadRepository;

class UploadController extends Controller
{
	protected $destinationUri;

	public function __construct()
	{
		$this->destinationUri = config('e-persistant.uri.log');
	}

    public function upload()
	{
		return view('upload');
	}

	public function create(UploadRequest $request)
	{
		$upload = (new UploadRepository)->make($this->destinationUri);

		if ($upload === false) {

			return back()->withWarning("Terjadi kesalahan pada server, silahkan coba beberapa saat lagi");
		}

		return back()->withSuccess("$upload data berhasil diupload ke E-Personal anda");
	}
}
