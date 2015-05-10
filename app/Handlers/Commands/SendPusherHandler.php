<?php namespace App\Handlers\Commands;

use App\Commands\SendPusher;

use Illuminate\Queue\InteractsWithQueue;

class SendPusherHandler {

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
	 * @param  SendPusher  $command
	 * @return void
	 */
	public function handle(SendPusher $command)
	{
		dump($command->getData());

		//$command->delete();
	}

}
