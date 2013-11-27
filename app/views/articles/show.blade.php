@extends('layouts.main')

@section('main')
<script>
$(document).ready(function(){
	$( "#comment_form" ).hide();
	$("#add_comment").click(function(){
     $( "#comment_form" ).toggle();
	})

	$("#endorse").click(function(){
		 $.ajax({
        url: "endorse",
        type: 'POST',
        data: {id:{{$article->id}}},
        success: function(res){
        	$("#endorse").attr('value', 'Endorsed');
        	$("#endorse").attr("disabled", "disabled");
        	alert(res);
         }
	  });
   });
 $('#comment_ajax').submit(function(e){
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    $.ajax({
        url: formURL,
        type: 'POST',
        data: postData,
        success: function(res){
        	$( "#comment_form" ).hide();
        	$('#message').val(" ");
 	        $('#comments').append("<li>"+res+"</li>");
                  
         }
    });

    e.preventDefault();
});
});

</script>

<h1>Show Article</h1>

<p>{{ link_to_route('articles.index', 'Return to all articles') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Title</th>
				<th>Body</th>
				<th>Endorse</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $article->title }}}</td>
					<td>{{{ $article->body }}}</td>
					<td><button id="endorse">Endorse</button></td>
                    <!-- <td>{{ link_to_route('articles.edit', 'Edit', array($article->id), array('class' => 'btn btn-info')) }}</td> -->
                    <!-- <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('articles.destroy', $article->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td> -->
		</tr>
	</tbody>
</table>
<div>
           <ul id ="comments">
			@foreach ($comments as $comment)
				
				<li>{{{ $comment->message }}}</li>
                    
			@endforeach
			</ul>		
</div>


<button id="add_comment">Add Comment</button>
<div id="comment_form">
{{ Form::open(array('route' => 'comments.store', 'id'=>'comment_ajax')) }}
	<ul>
        <li>
            
            {{ Form::input('hidden', 'user_id', $article_owner->id) }}
        </li>
         <li>
            
            {{ Form::input('hidden', 'article_id', $article->id) }}
        </li>

        <li>
            {{ Form::label('message', 'Message:') }}
            {{ Form::textarea('message') }}
        </li>

		<li>
			{{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif
</div>
@stop



