<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Firebase\Integration\Laravel\Firebase;

class SendFirebase extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( array $message )
    {
        //
        $this->data = $message;
    }

    public function getData()
    {
        return $this->data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
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
