<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PaymentStatus;
use App\Http\Requests\ReceiptRequest;
use App\Models\Invoice;
use App\Models\User;
use App\Models\PaymentReceipt;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class ReceiptCrudController extends CrudController
{
    use CreateOperation;
    use DeleteOperation;
    use ListOperation;
    use ShowOperation;
    use UpdateOperation;

    public function setup()
    {
        CRUD::setModel(PaymentReceipt::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/receipt');
        CRUD::setEntityNameStrings('receipt', 'receipts');

        $this->crud->denyAccess(['update', 'delete']);
    }

    protected function setupListOperation()
    {
        $this->crud->addColumns([
            [
               'name'  => 'invoice',
               'label' => __('Invoice'),
               'type'  => 'model_function',
               'function_name' => 'getInvoiceNumber',
            ],
            [  
               'name' => 'customer',
               'type' => 'relationship',
               'label' => __('Customer'),
               'entity' => 'customer',
               'attribute' => 'name',
               'model'     => 'App\Models\Customer'
            ],
            [
               'name'  => 'amount',
               'label' => __('Amount'),
            ],
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(ReceiptRequest::class);

        $this->crud->addFields([
            [
                'name'        => 'invoice',
                'label'       => __('Invoice'),
                'type'        => 'select2_from_array',
                'options'     => $this->getPayedInvoices(),
                'allows_null' => false,
            ],
            [
                'name'        => 'note',
                'label'       => __('Note'),
                'type'        => 'text',
            ],
            [
                'name'        => 'user_id',
                'label'       => __('Behalf'),
                'type'        => 'select2_from_array',
                'options'     => $this->getManagers(),
                'allows_null' => false,
            ],
        ]);
    }

    protected function getPayedInvoices()
    {
        $invoices = collect();
        $query = Invoice::whereHas('payment', function ($payment) {
                $payment->where('status', PaymentStatus::Approved);
            })
            ->get();

        foreach($query as $item) {
            $invoices->put($item->id, "{$item->number} - " . number_format($item->getSubTotal()));
        }

        return $invoices->toArray();
    }

    protected function getManagers()
    {
        $managers = collect();

        $query = User::whereHas('roles', function ($query) {
                $query->where('id', 2);
            })
            ->get();

        foreach($query as $item) {
            $managers->put($item->id, $item->name);
        }

        return $managers->toArray();
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);

        $this->crud->addColumns([
            ['name' => 'id', 'label' => __('No')],
            [
               'name' => 'customer',
               'type' => 'relationship',
               'label' => __('Customer'),
               'entity' => 'customer',
               'attribute' => 'name',
               'model' => 'App\Models\Customer',
            ],
            ['name' => 'note', 'label' => __('Note')],
            ['name' => 'amount', 'label' => __('Amount')],
            ['name' => 'counted', 'label' => __('Counted')],
            [  
               'name' => 'behalf',
               'type' => 'relationship',
               'label' => __('Behalf'),
               'entity' => 'user',
               'attribute' => 'name',
               'model' => 'App\Models\User',
            ],
        ]);

        $this->crud->addButtonFromView('line', 'receipt', 'receipt', 'beginning');
    }
}
