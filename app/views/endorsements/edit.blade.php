@extends('layouts.scaffold')

@section('main')

<h1>Edit Endorsement</h1>
{{ Form::model($endorsement, array('method' => 'PATCH', 'route' => array('endorsements.update', $endorsement->id))) }}
	<ul>
        <li>
            {{ Form::label('user_id', 'User_id:') }}
            {{ Form::input('number', 'user_id') }}
        </li>

        <li>
            {{ Form::label('article_id', 'Article_id:') }}
            {{ Form::input('number', 'article_id') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('endorsements.show', 'Cancel', $endorsement->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
