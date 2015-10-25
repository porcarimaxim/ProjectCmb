<?php namespace App\Library\RepositoriesInterface;

interface CompanyInterface extends ApiInterface
{

	public function getByApiKey( $apiKey );
}