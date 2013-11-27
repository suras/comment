@extends('layouts.main')

@section('main')
<script>

function setFlag(id, flag_name)
	{
		//alert(id);
		 $.ajax({
        url: "flag",
        type: 'POST',
        data: {id:id, flag_name:flag_name},
        success: function(res){
        	if(flag_name == "appropriate")
        	{

              var flag_text = "inappropriate";
        	}
        	else
        	{
        		var flag_text = "appropriate";
        	}
        	$("#flag"+id).html('flag as <a href="#" class="flag_text" id="'+id+'">'+flag_text+'</a>');
         }
	  });
  }

$(document).on('click','.flag_text',function(){
	console.log($(this).attr('id'),$(this).text());
	setFlag($(this).attr('id'),$(this).text());
})

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
        	//$("#endorse").attr('value', 'Endorsed');
        	//$("#endorse").attr("disabled", "disabled");
        	$("#endorse").html(res);
        	//alert(res);
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
        	// $( "#comment_form" ).hide();
        	// $('#message').val(" ");
 	       //  $('#comments').append("<li>"+res+"</li>");
 	       location.reload();
                  
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
					@if(count($is_endorsed) <= 0)
					  <td><button id="endorse">Endorse</button></td>
					@else
                      <td><button id="endorse" >Un Endorse</button></td>
					@endif 
					
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
				<li>{{{ $comment->created_at }}}</li>
				@if($comment->flag == "inappropriate")

				<li id="flag{{$comment->id}}">flag as <a href="#" id="flag" onclick="setFlag({{$comment->id}},'appropriate')"> appropriate</a></li>
                @else
                  <li id="flag{{$comment->id}}">flag as <a href="#" onclick="setFlag({{$comment->id}},'inappropriate')" id="flag">inappropriate</a></li>
               @endif   
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



