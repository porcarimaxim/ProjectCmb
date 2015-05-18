<?php namespace App\Commands;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class SendFirebase extends Command implements ShouldBeQueued {

	use InteractsWithQueue, SerializesModels;

	protected $data;

	public function getData()
	{
		return $this->data;
	}

	/**
	 * Create a new command instance.
	 *
	 * @param array $message
	 */
	public function __construct(array $message)
	{
		//
		$this->data = $message;
	}

}
