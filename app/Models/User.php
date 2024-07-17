<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Ward;
use App\Models\District;
use App\Models\Province;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey ='id';
    protected $fillable = [
        'name',
        'email',
        'password',
        'street_address',
        'phone',
        'avatar',
        'company_name',
        'province_id',
        'district_id',
        'ward_id',
        
    ];

    public function defaultAvatar() {
        return asset('/theme_admin/theme/images/AvatarDefault.png');
    }

    public function getAddressAttribute()
    {
        if ($this->province_id && $this->district_id && $this->ward_id) {
            $province = Province::where('id', $this->province_id)->first();
            $district = District::where('id', $this->district_id)->first();
            $ward = Ward::where('id', $this->ward_id)->first();

            $address = '';
            if ($province) {
                $address .= $province->name;
            }
            if ($district) {
                $address .= ', ' . $district->name;
            }
            if ($ward) {
                $address .= ', ' . $ward->name;
            }

        return $address;
        }

        return 'Không có địa chỉ'; // Hoặc bạn có thể trả về giá trị mặc định khác nếu muốn
    }

    public function getAddressFrom($user_id)
    {
        $user = User::find($user_id);

        if ($user && $user->province_id && $user->district_id && $user->ward_id) {
            $province = Province::where('id', $user->province_id)->first();
            $district = District::where('id', $user->district_id)->first();
            $ward = Ward::where('id', $user->ward_id)->first();

            $address = '';
            if ($province) {
                $address .= $province->name;
            }
            if ($district) {
                $address .= ', ' . $district->name;
            }
            if ($ward) {
                $address .= ', ' . $ward->name;
            }

            return $address;
        }

       
    }

    public function getProvince(){
        return $this ->hasOne(Province::class,'id','province_id');

    }
    public function district() {
        return $this->belongsTo(District::class, 'district_id');
    }
    
    public function ward() {
        return $this->belongsTo(Ward::class, 'ward_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
