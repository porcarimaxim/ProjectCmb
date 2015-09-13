<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class SendPusher extends Command implements ShouldBeQueued
{

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
		$this->data = $message;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		dump($this->getData());
		//
	}
}
