<?php

namespace App\Jobs\Traits;

use App\Enums\InvoiceStatus;
use App\Mail\InvoiceAlert;
use Illuminate\Support\Facades\Mail;
use PDF;

trait SendInvoice
{
	public function getTemplate()
	{
		return null;
	}

	public function getMessage()
	{
	    $date = now()->toDateTimeString();
		return "Invoice {$this->invoice->number} alert sended at {$date}";
	}

	public function handle()
	{
	    Mail::to($this->invoice->customer->email)
	    	->send(new InvoiceAlert(
	    		$this->invoice,
	    		PDF::loadView('pdf.statements.show', ['invoice' => $this->invoice])->output(),
	    		$this->getTemplate()
	    	));

	    $this->invoice->histories()->create([
	        'message' => $this->getMessage()
	    ]);

	    $this->invoice->status = InvoiceStatus::Sended;
	    $this->invoice->latest_status = $this->getMessage();
	    $this->invoice->save();
	}
}