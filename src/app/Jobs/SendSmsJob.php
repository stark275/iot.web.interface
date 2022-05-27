<?php

namespace App\Jobs;

use App\Models\Iot;
use App\Services\SmsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $phone;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $iot = Iot::orderBy('created_at', 'desc')->take(15)->get(['val','created_at']);
        $alert = false;

        dump("|------------------------------------------------------------|");
        dump("|                  FASI-IOT GAZ LEVEL LISTENER               |");
        dump("|------------------------------------------------------------|");




        foreach ($iot as $item) {
            if ($item->val > 1200) {
                dump("$item->val :-> !!!!! DANGEROUS !!!!");
                $alert = true;
            }else{
                dump("$item->val :-> [ Normal ]");
            }
        }

        if ($alert) {
            $message = 'ATTENTION! LE CAPTEUR A DETECTE UNE CONCENTRATION ANORMALE DE FUMEE';
            $sms = SmsService::getInstance();
            dump($message);
            dump($sms->send($message, $this->phone));
            $alert = false;
        }




    }
}
