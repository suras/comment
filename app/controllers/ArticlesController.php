<?php

class ArticlesController extends BaseController {

	/**
	 * Article Repository
	 *
	 * @var Article
	 */
	protected $article;

	public function __construct(Article $article)
	{   
		$this->beforeFilter('auth', array('only'=>array('show','create')));
		$this->article = $article;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$articles = $this->article->all();

		return View::make('articles.index', compact('articles'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('articles.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Article::$rules);

		if ($validation->passes())
		{
			$this->article->create($input);

			return Redirect::route('articles.index');
		}

		return Redirect::route('articles.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$article = $this->article->findOrFail($id);
		$comments = $article->comments;
        $article_owner = $article->user;
        $is_endorsed = DB::table('endorsements')->where('article_id', $id)->where('user_id', Auth::user()->id)->first();
		return View::make('articles.show', compact('article', 'comments', 'article_owner', 'is_endorsed'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$article = $this->article->find($id);

		if (is_null($article))
		{
			return Redirect::route('articles.index');
		}

		return View::make('articles.edit', compact('article'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Article::$rules);

		if ($validation->passes())
		{
			$article = $this->article->find($id);
			$article->update($input);

			return Redirect::route('articles.show', $id);
		}

		return Redirect::route('articles.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->article->find($id)->delete();

		return Redirect::route('articles.index');
	}


	public function endorse()
	{
      $is_endorsed = DB::table('endorsements')->where('article_id', Input::get('id'))->where('user_id', Auth::user()->id)->first();
      if(count($is_endorsed) <= 0)
      {
	      $endorsement = new Endorsement;
	      $endorsement->article_id = Input::get('id');
	      $endorsement->user_id = Auth::user()->id;
	      $endorsement->save();
	        return "Un Endorse";
	      
	        
	      
      }
      else
      {
      	$endorse = Endorsement::find($is_endorsed->id);
      	$endorse->delete();
      	return "Endorse";
      }
    
	}

}
