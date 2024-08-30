<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Libraries\BarcodeGenerator;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateBarcode implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        // Generate barcode for the registered user
        $user = $event->user;
        $barcodeGenerator = new BarcodeGenerator();
        $barcodeData = $barcodeGenerator->generateBarcode($user->id);

        // Save the barcode data or image path to the user's record
        $user->barcode = $barcodeData;
        $user->save();
    }
}
