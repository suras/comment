<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <title>Comment System</title>
    <script src="http://code.jquery.com/jquery-1.9.min.js"></script>
    {{ HTML::style('packages/bootstrap/css/bootstrap.min.css') }}
   {{ HTML::style('css/main.css')}}

   <style>
      table form { margin-bottom: 0; }
      form ul { margin-left: 0; list-style: none; }
      .error { color: red; font-style: italic; }
      body { padding-top: 20px; }
    </style>
  </head>
 
  <body>
  <div class="navbar navbar-fixed-top">
   <div class="navbar-inner">
      <div class="container">
         <ul class="nav"> 
            @if(!Auth::check())
               <li>{{ HTML::link('users/register', 'Register') }}</li>  
               <li>{{ HTML::link('users/login', 'Login') }}</li>  
            @else
               <li>{{ HTML::link('users/logout', 'logout') }}</li>
            @endif
            <li><a href="{{URL::to('articles')}}">Articles</a></li>
         </ul> 
      </div>
   </div>
</div> 

    <div class="container">
    <br><br>
      @if(Session::has('message'))
         <p class="alert">{{ Session::get('message') }}</p>
      @endif

      @yield('main')
    </div>
  @if(isset($content))
    {{ $content }}
  @endif


  </body>
</html>