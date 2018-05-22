<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IpData extends Model
{
    protected $table = 'ip_datas';

    protected $fillable = [
        'list_id',
        'decimal_representation',
        'asn',
        'city',
        'country',
        'country_code',
        'isp',
        'latitude',
        'longitude',
        'organization',
        'postal_code',
        'is_private',
        'ptr_resource',
        'is_reserved',
        'state',
        'state_code',
        'timezone',
        'local_time',
        'subnet',
        'net_size',
        'registrant',
        'another_country',
        'subnet_2',
        'net_size_2',
        'registrant_2',
        'another_country_2',
    ];

    public function ipList()
    {
        return $this->belongsTo(UserIpList::class, 'list_id');
    }
}
