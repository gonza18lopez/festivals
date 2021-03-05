<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use App\Models\Ranking;
use Illuminate\Http\Request;

class TourController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api')->except('all');
	}
	
	public function all(Request $request)
	{
		return view('home.tour', [
			'tours' => Festival::orderBy('id', 'desc')->get()
		]);
	}

	public function join(Request $request, Festival $festival)
	{
		$user = $request->user();
		$ranking = Ranking::where('user_id', $user->id)->where('festival_id', $festival->id)->first();

		if ( $ranking ) {
			$ranking->delete();

			$user->score -= $festival->points;
			$user->save();

			return response()->json([
				'status' => 'leaved'
			], 200);
		}

		$user->rankings()->create([
			'festival_id' => $festival->id
		]);

		$user->score += $festival->points;
		$user->save();

		return response()->json([
			'status' => 'joined'
		], 201);
	}

	public function leave(Request $request, Festival $festival)
	{
		$user = $request->user();

		$ranking = Ranking::where('user_id', $request->user()->id)->where('festival_id', $festival->id)->first();
		$ranking->delete();

		$user->score -= $festival->points;
		$user->save();

		return response(null, 200);
	}
}
