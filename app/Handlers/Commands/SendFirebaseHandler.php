<?php namespace App\Handlers\Commands;

use App\Commands\SendFirebase;

use Firebase\Integration\Laravel\Firebase;
use Illuminate\Queue\InteractsWithQueue;

class SendFirebaseHandler {

	/**
	 * Create the command handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the command.
	 *
	 * @param  SendFirebase  $command
	 * @return void
	 */
	public function handle(SendFirebase $command)
	{
		//
		$result = false;

		// send data to firebase
		Firebase::push('/events', $command->getData());

		$command->delete();
	}

}
