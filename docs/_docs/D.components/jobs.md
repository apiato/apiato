---
title: "jobs"
category: "Components"
order: 33
---

### Definition

Jobs are normal classes (like commands) that when dispatched they perform specific job. Most of the times Jobs are queueable, means can be their jobs can be deferred for later.

## Principles

- A Container MAY have more than one Job.

### Rules

- All Jobs MUST extend from `App\Ship\Parents\Jobs\Job`.

### Folder Structure

	 - app
	    - Containers
	        - {container-name}
	            - Jobs
	                - DoSomethingJob.php
	                - DoSomethingElseJob.php 

### Code Samples

**CreateAndValidateAddress with third party `Job`:** 

	 <?php
	
	namespace App\Containers\Shipment\Jobs;
	
	use App\Port\Job\Abstracts\Job;
	use Illuminate\Bus\Queueable;
	use Illuminate\Contracts\Queue\ShouldQueue;
	use Illuminate\Queue\InteractsWithQueue;
	use Illuminate\Queue\SerializesModels;
	
	class CreateAndValidateAddressJob extends Job implements ShouldQueue
	{
	
	    use InteractsWithQueue, Queueable, SerializesModels;
	
	    private $recipients;
	
	    public function __construct(array $recipients)
	    {
	        $this->recipients = $recipients;
	    }
	
	    public function handle()
	    { 
	        foreach ($this->recipients as $recipient) {
	            // do whatever you like
	        }
	    }
	}
	 
**Usage from `Action`:** 

	 <?php
	
	//
	
	dispatch(new CreateAndValidateAddressJob($recipients));
	
	// 

For more information about the Policies read [this](https://laravel.com/docs/5.3/queues).
