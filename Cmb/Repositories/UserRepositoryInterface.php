<?php namespace Cmb\Repositories;


use App\Http\Requests\Request;

interface UserRepositoryInterface
{

	public function getAll();

	public function find($id);

	public function store(Request $request);

	public function update($id, Request $request);
}