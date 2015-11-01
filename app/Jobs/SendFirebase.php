<?php

namespace App\Jobs;

use App\Library\RepositoriesInterface\UserInterface;
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
     * @param array $message
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
     * @param UserInterface $userInterface
     */
    public function handle(UserInterface $userInterface)
    {
        //
        $data = $this->getData();
        $model = $data['model'];
        $type = $data['type'];

        switch ($type) {
            case 'User':
                $ref = 'company-' . $model['firebase_key'] . '/availabile/';
                $val = $userInterface->getAvailableUsers();
                Firebase::set($ref, $val);
                break;
        }

        $this->delete();
    }
}
