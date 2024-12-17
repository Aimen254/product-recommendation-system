<?php

namespace App\Jobs;

use App\Models\Advice;
use Illuminate\Support\Str;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class importAdviceJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $data;
    public $header;
    public $account;

    public function __construct($data, $header, $account)
    {
        $this->data = $data;
        $this->header = $header;
        $this->account = $account;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $accountId = $this->account->id;
        foreach ($this->data as $advice) {
            Advice::create([
                'uuid' => Str::uuid(),
                'account_id' => $accountId,
                'title' => isset($advice[0]) ? $advice[0] : '',
                'secondary_title' => isset($advice[0]) ? $advice[0] : '',
            ]);
        }
    }
}
