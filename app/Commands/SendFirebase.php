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

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle() {
		$data = $this->getData();
		$model = $data['model'];
		$type = $data['type'];

		switch ($type) {
			case 'UserStatus':
				$ref = 'company-' . $model['company_id'] . '/availability/user-' . $model['user_id'] . '/';
				$val = $model['is_available'];
				Firebase::set($ref, $val);
				break;
		}

		$this->delete();
	}
}
