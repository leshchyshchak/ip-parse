<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserIpList extends Model
{
    protected $table = 'user_ip_lists';

    protected $fillable = [
        'ip', 'user_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ipData()
    {
        return $this->hasMany(IpData::class, 'list_id', 'id');
    }
}
