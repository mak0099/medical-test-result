<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestResult extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'patient_name',
        'patient_age',
        'patient_sex',
        'refd_by',
        'specimen',
        'comment',
    ];

    public function test_result_items(){
        return $this->hasMany(TestResultItem::class);
    }
    protected $appends = ['date'];
    public function getDateAttribute(){
        return $this->created_at->format('d/m/Y');
    }
    public function __construct(array $attributes = array())
    {
        $this->setRawAttributes(array_merge($this->attributes, array(
            'invoice_no' => 'DIA' . time()
        )), true);
        parent::__construct($attributes);
    }
}
