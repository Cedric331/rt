<?php

namespace App\Jobs;

use App\Models\ResponseType;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RatingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $responseType;

    public $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($responseType, $user)
    {
        $this->responseType = $responseType;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $responseType = ResponseType::find($this->responseType);
        $user =User::find($this->user);

        $user->increment('use_rt');
        $user->save();

        $responseType->increment('rating');
        $responseType->save();
    }
}
