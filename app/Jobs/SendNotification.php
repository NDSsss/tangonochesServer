<?php

namespace App\Jobs;

use App\Services\Apns;
use App\Services\Firebase;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;


class SendNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    protected $tokens;
    protected $type;

    public function __construct($data, $tokens, $type)
    {
        $this->data = $data;
        $this->tokens = $tokens;
        $this->type = $type;
    }

    public function handle()
    {
        if ($this->type == 'fcm') {
            Firebase::send($this->data['notification_id'], $this->data['title'], $this->data['text'], $this->tokens);
        }
        if ($this->type == 'apns') {
            Apns::send($this->data['notification_id'], $this->data['title'], $this->data['text'], $this->tokens);
        }
    }
}