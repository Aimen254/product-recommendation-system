<?php

namespace App\Jobs;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class importCategoryJob implements ShouldQueue
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
        foreach ($this->data as $category) {
            Category::create([
                'uuid' => Str::uuid(),
                'account_id' => $accountId,
                'title' => isset($category[1]) ? $category[1] : '',
                'secondary_title' => isset($category[1]) ? $category[1] : '',
                'description' => isset($category[2]) ? $category[2] : '',
            ]);
        }
    }
}
