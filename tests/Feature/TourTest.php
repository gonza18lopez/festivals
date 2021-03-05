<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Festival;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TourTest extends TestCase
{
	use RefreshDatabase;

	/**
	 * Check if user cannot enter to /tour path
	 *
	 * @return void
	 */
	public function test_user_cannot_tour()
	{
		$response = $this->get('/tour');

		$response
			->assertRedirect();
	}
}
