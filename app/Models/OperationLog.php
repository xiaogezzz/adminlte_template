<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OperationLog extends Model
{
    protected $fillable = ['admin_id', 'path', 'method', 'ip', 'input'];

    public static $methodColors = [
        'GET' => 'green',
        'POST' => 'yellow',
        'PUT' => 'blue',
        'DELETE' => 'red',
    ];

    public static $methods = [
        'GET', 'POST', 'PUT', 'DELETE', 'OPTIONS', 'PATCH',
        'LINK', 'UNLINK', 'COPY', 'HEAD', 'PURGE',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function getInputAttribute($input)
    {
        $input = json_decode($input, true);
        if (empty($input)) {
            return null;
        }
        $input = \Arr::except($input, ['_token', '_method', '_previous_']);

        return json_encode($input, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
