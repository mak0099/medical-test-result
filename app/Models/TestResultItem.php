<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResultItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_name',
        'result',
        'reference_ranges',
        'test_result_id',
        'medical_test_id',
    ];

    public function medical_test(){
        return $this->belongsTo(MedicalTest::class);
    }
    public function test_result(){
        return $this->belongsTo(TestResult::class);
    }
}
