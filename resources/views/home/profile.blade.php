@extends('application')

@section('content')
<div class="d-flex justify-content-center flex-column" style="height: calc(100vh - 56px)">
	<div class="row">
		<div class="col-12 col-md-4">
			<div class="card border-light">
				<img src="{{ asset("storage/avatar/{$profile->id}") }}" class="card-img-top" alt="DJ Profile">

				<div class="card-body">
					<h5 class="card-title">{{ $profile->stage_name }}</h5>
					<h6 class="card-subtitle mb-2 text-muted">#{{ $profile->position }} in the ranking</h6>

					<p class="card-text">{{ $profile->age }} years old.</p>
				</div>
			</div>
		</div>

		<div class="col-12 col-md-8">
			<h3 class="text-white">Last two concerts</h3>

			<ul class="list-group">
				@foreach ($profile->rankings as $event)
				<li class="list-group-item list-group-item-action">{{ $event->festival->name }}</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>
@endsection