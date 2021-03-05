@extends('application')

@section('content')
<div class="d-flex justify-content-center flex-column" style="height: calc(100vh - 56px)">
	<table class="table table-dark">
		<thead>
			<tr>
				<th scope="column">Name</th>
				<th class="text-center" scope="column">Join / Leave</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($tours as $tour)
				<tr>
					<td>{{ $tour->name }}</td>
					<td class="text-center">
						@if ($tour->rankings->contains('user_id', auth()->user()->id))
						<button type="submit" class="btn btn-sm btn-danger" id="action" onclick="handleTourAction(this, {{ $tour->id }})" data-action="leave">Leave</button>
						@else
						<button type="submit" class="btn btn-sm btn-success" id="action" onclick="handleTourAction(this, {{ $tour->id }})" data-action="join">Join</button>
						@endif
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection

@push('scripts')
<script>
const handleTourAction = (e, id) => {
	let self = jQuery(e),
		action = self.data('action'),
		ajax = null

	switch (action) {
		case 'join':
			ajax = axios.post

			self.removeClass('btn-success')
			break;

		case 'leave':
			ajax = axios.delete

			self.removeClass('btn-danger')
			break;
	
		default:
			break;
	}

	self.addClass('btn-secondary')
	
	ajax('/api/tour/' + id)
		.then( ({ data }) => {
			if ( data.status == 'joined' ) {
				self.addClass('btn-danger').removeClass('btn-success').text('Leave')

				self.attr('data-action', 'leave')
			}
			else if ( data.status == 'leaved' ) {
				self.addClass('btn-success').removeClass('btn-danger').text('Join')

				self.attr('data-action', 'join')
			}
		})
		.catch( error => {
			if ( action == 'join' )
				self.addClass('btn-success')
			else if ( action == 'leave' )
				self.addClass('btn-danger')
		})
		.finally( () => {
			self.removeClass('btn-secondary')
		})
}
</script>
@endpush