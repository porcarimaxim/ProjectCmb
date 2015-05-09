<?php namespace App\Library\RepositoriesInterface;

use App\Http\Requests\Request;

interface ApiInterface
{
	public function getAll();

	public function find($id);

	public function store(Request $request);

	public function update(Request $request, $id);

	public function destroy($id);

	public function paginate();
}