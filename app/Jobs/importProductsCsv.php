<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class importProductsCsv implements ShouldQueue
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
        try {
            Log::info($this->data);
            $accountId = $this->account->id;
            foreach ($this->data as $product) {
                Product::create([
                    'uuid' => Str::uuid(),
                    'account_id' => $accountId,
                    'title' => isset($product[0]) ? $product[0] : '',
                    'url' => isset($product[2]) ? $product[2] : null,
                    'description' => isset($product[3]) ? $product[3] : null,
                    'image' => isset($product[4]) ? $product[4] : null,
                    'code' => rand(10000, 99999),
                ]);
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage().'        ErrorLine'. $e->getLine());
        }
    }
}
