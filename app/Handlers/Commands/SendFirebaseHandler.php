<?php namespace App\Handlers\Commands;

use App\Commands\SendFirebase;

use Firebase\Integration\Laravel\Firebase;
use Illuminate\Queue\InteractsWithQueue;

class SendFirebaseHandler
{
	/**
	 * Create the command handler.
	 */
	public function __construct()
	{

	}

	/**
	 * Handle the command.
	 *
	 * @param  SendFirebase $command
	 * @return void
	 */
	public function handle(SendFirebase $command)
	{
		$data = $command->getData();
		$model = $data['model'];
		$type = $data['type'];

		switch ($type) {
			case 'UserStatus':
				$ref = 'company-' . $model['company_id'] . '/availability/user-' . $model['user_id'] . '/';
				$val = $model['is_available'];
				Firebase::set($ref, $val);
				break;
		}

		$command->delete();
	}

}
