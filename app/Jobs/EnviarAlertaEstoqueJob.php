<?php

namespace App\Jobs;

use App\Mail\AlertaEstoqueBoloMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;


class EnviarAlertaEstoqueJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;
    public $bolo;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $bolo)
    {
        $this->email = $email;
        $this->bolo = $bolo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new AlertaEstoqueBoloMail($this->bolo));
    }
}
