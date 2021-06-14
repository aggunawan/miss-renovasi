<?php

namespace App\Http\Controllers\Admin;

use App\Models\BankAccount;
use App\Models\Customer;
use App\Http\Requests\InvoiceRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;


class InvoiceCrudController extends CrudController
{
    use CreateOperation;
    use DeleteOperation;
    use ListOperation;
    use ShowOperation;
    use UpdateOperation;

    public function getBankAccountsArray()
    {
        $query = BankAccount::orderBy('holder')->get();

        $bankAccounts = collect();

        foreach ($query as $item) {
            $bankAccounts->put($item->id, "{$item->holder} - {$item->bank} ({$item->number})");
        }

        return $bankAccounts->toArray();
    }

    public function getCustomersArray()
    {
        $query = Customer::select('name', 'id', 'phone')
            ->orderBy('name')
            ->get();

        $customers = collect();

        foreach ($query as $item) {
            $customers->put($item->id, "{$item->name} ({$item->phone})");
        }

        return $customers->toArray();
    }

    public function setup()
    {
        CRUD::setModel(\App\Models\Invoice::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/invoice');
        CRUD::setEntityNameStrings('invoice', 'invoices');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumns([
            ['name' => 'number', 'label' => __('No')],
            ['name' => 'contract_number', 'label' => __('Contract')],
            [
                'name' => 'due',
                'label' => __('Due'),
                'type'  => 'date',
                'format' => 'D MMMM G'
            ],
            [
                'name' => 'status',
                'label' => __('Status'),
                'type' => 'model_function',
                'function_name' => 'getDescriptiveStatus',
            ]
        ]);

        $this->crud->addButtonFromView('line', 'invoice', 'invoice', 'beginning');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(InvoiceRequest::class);

        $this->crud->addField(['name' => 'number', 'label' => __('No')]);
        $this->crud->addField(['name' => 'contract_number', 'label' => __('Contract')]);
        $this->crud->addField(['name' => 'date', 'label' => __('Date')]);
        $this->crud->addField(['name' => 'due', 'label' => __('Due')]);

        $this->crud->addField([
            'label'     => __('Customer'),
            'type'      => 'select2_from_array',
            'name'      => 'customer_id',
            'options'     => $this->getCustomersArray(),
            'allows_null' => false,
        ]);

        $this->crud->addField([
            'label'     => __('Bank Account'),
            'type'      => 'select2_from_array',
            'name'      => 'bank_account_id',
            'options'     => $this->getBankAccountsArray(),
            'allows_null' => false,
        ]);

        $this->crud->addField([
            'name'  => 'contents',
            'label' => __('Items'),
            'type'  => 'repeatable',
            'fields' => [
                [
                    'name'    => 'name',
                    'type'    => 'text',
                    'label'   => __('Name'),
                    'wrapper' => ['class' => 'form-group col-md-12'],
                ],
                [
                    'name'    => 'price',
                    'type'    => 'number',
                    'label'   => __('Price'),
                    'wrapper' => ['class' => 'form-group col-md-12'],
                ],
            ],

            'min_rows' => 1,
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);

        $this->crud->addColumn(['name' => 'number', 'label' => __('No')]);
        $this->crud->addColumn(['name' => 'contract_number', 'label' => __('Contract')]);

        $this->crud->addColumn([
            'name' => 'date',
            'label' => __('Date'),
            'type'  => 'date',
            'format' => 'D MMMM G'
        ]);

        $this->crud->addColumn([
            'name' => 'due',
            'label' => __('Due'),
            'type'  => 'date',
            'format' => 'D MMMM G'
        ]);

        $this->crud->addColumn([
            'name' => 'customer.name',
            'type' => 'relationship',
            'label' => __('Customer'),
            'entity'    => 'customer',
            'attribute' => 'name',
            'model'     => 'App\Models\Customer',
        ]);

        $this->crud->addColumn([
            'name' => 'customer.phone',
            'type' => 'relationship',
            'label' => __('Phone'),
            'entity'    => 'customer',
            'attribute' => 'phone',
            'model'     => 'App\Models\Customer',
        ]);

        $this->crud->addColumn([
            'name' => 'customer.address',
            'type' => 'relationship',
            'label' => __('Address'),
            'entity'    => 'customer',
            'attribute' => 'address',
            'model'     => 'App\Models\Customer',
        ]);

        $this->crud->addColumn([
            'name' => 'bank_account.holder',
            'type' => 'relationship',
            'label' => __('Pay to'),
            'entity'    => 'bankAccount',
            'attribute' => 'holder',
            'model'     => 'App\Models\BankAccount',
        ]);

        $this->crud->addColumn([
            'name' => 'bank_account.bank',
            'type' => 'relationship',
            'label' => __('Bank'),
            'entity'    => 'bankAccount',
            'attribute' => 'bank',
            'model'     => 'App\Models\BankAccount',
        ]);

        $this->crud->addColumn([
            'name' => 'bank_account.number',
            'type' => 'relationship',
            'label' => __('Number'),
            'entity'    => 'bankAccount',
            'attribute' => 'number',
            'model'     => 'App\Models\BankAccount',
        ]);

        $this->crud->addColumn(['name' => 'latest_status', 'type' => 'text']);

        $this->crud->addColumn([
            'name'  => 'contents', 
            'label' => __('Items'), 
            'type'  => 'table', 
            'columns' => [
                'name' => 'Name',
                'price' => 'Price'
            ]
        ]);

        $this->crud->addColumn([
            'name'  => 'histories', 
            'label' => __('History'), 
            'type'  => 'table', 
            'columns' => [
                'message' => 'Event',
            ]
        ]);

        $this->crud->addButtonFromView('line', 'invoice', 'invoice', 'beginning');
        $this->crud->addButtonFromView('line', 'send-alert', 'send-alert', 'beginning');

        $this->crud->addColumn(['name' => 'latest_status', 'type' => 'text']);
    }
}
