<?php

namespace App\Models;

use App\Enums\ReportType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesReport extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
        'label',
        'start_date',
        'end_date',
        'type'
    ];

    protected $casts = [
        'content' => 'array'
    ];

    public function getType(): string
    {
        switch ($this->type) {
            case ReportType::Customer:
                return 'Customer Report';
                break;
            case ReportType::Monthly:
                return 'Monthly Report';
                break;
            default:
                return 'Tidak Diketahui';
                break;
        }
    }

    public function getReport(): string {
        switch ($this->type) {
            case ReportType::Monthly:
                return route('admin.monthly', $this);
                break;
            case ReportType::Customer:
                return route('admin.customer', $this);
                break;
        }
    }
}
