<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function ipLists()
    {
        return $this->hasMany(UserIpList::class, 'user_id', 'id');
    }

    public function getIpLists($paginate_count)
    {
        return UserIpList::where('user_id', Auth::id())
            ->paginate($paginate_count);
    }

    public function updateIpWithId($id, $ip)
    {
        return UserIpList::where('id', $id)->update(['ip' => $ip]);
    }

    public function createParsedData($array, $list_id)
    {
        if (count($array))
            IpData::create([
                'decimal_representation' => isset($array[1]) ? $array[1] : '',
                'asn' => isset($array[2]) ? $array[2] : '',
                'city' => isset($array[3]) ? $array[3] : '',
                'country' => isset($array[4]) ? $array[4] : '',
                'country_code' => isset($array[5]) ? $array[5] : '',
                'isp' => isset($array[6]) ? $array[6] : '',
                'latitude' => isset($array[7]) ? $array[7] : '',
                'longitude' => isset($array[8]) ? $array[8] : '',
                'organization' => isset($array[9]) ? $array[9] : '',
                'postal_code' => isset($array[10]) ? $array[10] : '',
                'is_private' => isset($array[11]) ? $array[11] : '',
                'ptr_resource' => isset($array[12]) ? $array[12] : '',
                'is_reserved' => isset($array[13]) ? $array[13] : '',
                'state' => isset($array[14]) ? $array[14] : '',
                'state_code' => isset($array[15]) ? $array[15] : '',
                'timezone' => isset($array[16]) ? $array[16] : '',
                'local_time' => isset($array[17]) ? $array[17] : '',
                'subnet' => isset($array[18]) ? $array[18] : '',
                'net_size' => isset($array[19]) ? $array[19] : '',
                'registrant' => isset($array[20]) ? $array[20] : '',
                'another_country' => isset($array[21]) ? $array[21] : '',
                'subnet_2' => isset($array[22]) ? $array[22] : '',
                'net_size_2' => isset($array[23]) ? $array[23] : '',
                'registrant_2' => isset($array[24]) ? $array[24] : '',
                'another_country_2' => isset($array[25]) ? $array[25] : '',

                'list_id' => $list_id,
            ]);
        else
            return false;

        return true;
    }

    public function paginateIpData($paginate_count, $data_id)
    {
        $user_id = $this->id;
        return IpData::whereHas('ipList', function ($q) use ($user_id, $data_id) {
            return $q->where('user_id', $user_id)
                ->where('list_id', $data_id);
        })
            ->paginate($paginate_count);
    }
}
