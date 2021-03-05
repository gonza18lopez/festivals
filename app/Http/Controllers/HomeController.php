<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	/**
	 * Handle the incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function __invoke(Request $request)
	{
		return view('home.ranking', [
			'users' => $this->getUserList()
		]);
	}

	private function getUserList()
	{
		return User::orderBy('score', 'desc')->paginate(10);
	}
}
