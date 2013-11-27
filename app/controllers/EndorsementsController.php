<?php

class EndorsementsController extends BaseController {

	/**
	 * Endorsement Repository
	 *
	 * @var Endorsement
	 */
	protected $endorsement;

	public function __construct(Endorsement $endorsement)
	{
		$this->endorsement = $endorsement;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$endorsements = $this->endorsement->all();

		return View::make('endorsements.index', compact('endorsements'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('endorsements.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Endorsement::$rules);

		if ($validation->passes())
		{
			$this->endorsement->create($input);

			return Redirect::route('endorsements.index');
		}

		return Redirect::route('endorsements.create')
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
		$endorsement = $this->endorsement->findOrFail($id);

		return View::make('endorsements.show', compact('endorsement'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$endorsement = $this->endorsement->find($id);

		if (is_null($endorsement))
		{
			return Redirect::route('endorsements.index');
		}

		return View::make('endorsements.edit', compact('endorsement'));
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
		$validation = Validator::make($input, Endorsement::$rules);

		if ($validation->passes())
		{
			$endorsement = $this->endorsement->find($id);
			$endorsement->update($input);

			return Redirect::route('endorsements.show', $id);
		}

		return Redirect::route('endorsements.edit', $id)
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
		$this->endorsement->find($id)->delete();

		return Redirect::route('endorsements.index');
	}

}
