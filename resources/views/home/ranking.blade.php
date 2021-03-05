@extends('application')

@section('content')
<div class="d-flex align-items-center justify-content-center flex-column" style="height: calc(100vh - 56px)">
	<table class="table table-dark table-hover">
		<thead>
			<tr>
				<th class="text-center" scope="column">#</th>
				<th scope="column">Name</th>
				<th class="text-center" scope="column">Score</th>
			</tr>
		</thead>
	
		<tbody>
			@foreach($users as $index => $user)
			<tr>
				<th class="text-center" scope="row">{{ ($users->currentPage() * $users->perPage() + $index + 1) - $users->perPage() }}</th>
				<td><a href="{{ route('profile', $user->id) }}">{{ $user->stage_name }}</a></td>
				<td class="text-center">{{ $user->score }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	
	<div class="d-flex justify-content-center">
		{{ $users->links() }}
	</div>
</div>
@endsection