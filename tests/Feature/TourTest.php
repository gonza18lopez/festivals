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

	/**
	 * Check if user can enter to /tour path
	 */
	public function test_user_can_enter_tour()
	{
		$user = User::factory()->create();

		$response = $this->actingAs($user)->get('/tour');

		$response
			->assertSee('tour')
			->assertOk();
	}

	/**
	 * Check if user can participate in event
	 */
	public function test_user_can_participate()
	{
		$user = User::factory()->create();
		$tour = Festival::factory()->create();

		$response = $this->actingAs($user, 'api')->postJson("/api/tour/{$tour->id}");

		$response
			->assertCreated()
			->assertJsonStructure([
				'status'
			]);
	}
}
