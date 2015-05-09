<?php namespace Library\Repositories;

use App\Http\Requests\Request;

interface ApiRepositoryInterface {

	public function getAll();

	public function find($id);

	public function store(Request $request);

	public function update(Request $request, $id);

	public function destroy($id);

}