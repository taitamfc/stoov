<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Arr;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function setSuccessMessage($msg): void
	{
    	session()->flash('msg',$msg);
    	session()->flash('type','success');
	}
	public function setErrorMessage($msg): void
	{
		session()->flash('msg',$msg);
		session()->flash('type','danger');
	}

	public function valid($validator): array
	{
		$errors = [];
		foreach ($validator->errors()->toArray() as $field => $message) {
			$errors[] = Arr::first($message);
		}
		
		return $errors;
	}
}
