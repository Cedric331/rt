<?php

namespace App\Observers;

use App\Models\ResponseType;

class ResponseTypeObserver
{
    /**
     * Handle the ResponseType "created" event.
     *
     * @param  \App\Models\ResponseType  $responseType
     * @return void
     */
    public function created(ResponseType $responseType)
    {
        //
    }

    /**
     * Handle the ResponseType "updated" event.
     *
     * @param  \App\Models\ResponseType  $responseType
     * @return void
     */
    public function updated(ResponseType $responseType)
    {
        //
    }

    /**
     * Handle the ResponseType "deleted" event.
     *
     * @param  \App\Models\ResponseType  $responseType
     * @return void
     */
    public function deleted(ResponseType $responseType)
    {
        $responseType->tags()->detach();
    }

    /**
     * Handle the ResponseType "restored" event.
     *
     * @param  \App\Models\ResponseType  $responseType
     * @return void
     */
    public function restored(ResponseType $responseType)
    {
        //
    }

    /**
     * Handle the ResponseType "force deleted" event.
     *
     * @param  \App\Models\ResponseType  $responseType
     * @return void
     */
    public function forceDeleted(ResponseType $responseType)
    {
        //
    }
}
