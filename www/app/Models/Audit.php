<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    use HasFactory;

    protected $table = 'audits';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function getUserName($userId)
    {
        return ($userId) ? User::find($userId)->name : '';
    }


    public function getColorAction($action)
    {
        switch ($action) {
            case 'created':
                return 'green';
                break;
            case 'updated':
                return 'orange';
                break;
            case 'deleted':
                return 'red';
                break;
        }
    }
}
