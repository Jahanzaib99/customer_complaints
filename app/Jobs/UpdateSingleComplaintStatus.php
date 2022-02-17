<?php

namespace App\Jobs;

use App\Mail\ComplaintStatusEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class UpdateSingleComplaintStatus implements ShouldQueue
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
        $this->data->update(['status' => $this->status]);
        
        Mail::to($this->data->email)->send(new ComplaintStatusEmail($this->data));
    }
}
