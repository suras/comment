@extends('layouts.scaffold')

@section('main')

<h1>Show Endorsement</h1>

<p>{{ link_to_route('endorsements.index', 'Return to all endorsements') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>User_id</th>
				<th>Article_id</th>
		</tr>
	</thead>

	<tbody>
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
	</tbody>
</table>

@stop
