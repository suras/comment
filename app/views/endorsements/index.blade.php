@extends('layouts.scaffold')

@section('main')

<h1>All Endorsements</h1>

<p>{{ link_to_route('endorsements.create', 'Add new endorsement') }}</p>

@if ($endorsements->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>User_id</th>
				<th>Article_id</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($endorsements as $endorsement)
				<tr>
					<td>{{{ $endorsement->user_id }}}</td>
					<td>{{{ $endorsement->article_id }}}</td>
                    <td>{{ link_to_route('endorsements.edit', 'Edit', array($endorsement->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('endorsements.destroy', $endorsement->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no endorsements
@endif

@stop
