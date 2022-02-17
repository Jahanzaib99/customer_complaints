<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ComplaintStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    protected $status;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $status)
    {
        $this->data = $data;
        $this->status = $status;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (!empty($this->data)) {
            foreach ($this->data as $complaint) {
                UpdateSingleComplaintStatus::dispatch($complaint, $this->status);
            }
        }
    }
}
