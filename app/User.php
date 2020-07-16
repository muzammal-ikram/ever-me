<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use \Spatie\Permission\Traits\HasRoles;
use App\Notifications\PasswordReset;

class User extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes;
    use Notifiable;
    use HasRoles;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'first_name', 'last_name', 'company_name', 'other_phone', 'phone', 'profile_image', 'status', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
        public function sendPasswordResetNotification($token)
        {
            new PasswordReset($token);
        }

    public function getUserById($user_id){
        $user = User::findOrFail($user_id);
        return $user;
    }    

    public static function profileImageUpload($user , $profile_image)
    {

        $path = public_path('images/user-'.$user->id.'/profile-image');
        \File::isDirectory($path) or \File::makeDirectory($path, 0775, true, true);

        $profile_image_name = $user->id.'-'.Carbon::now()->timestamp;

        $full_name = $profile_image_name.'.'.$profile_image->getClientOriginalExtension();
        $img = \Image::make($profile_image)->resize(250, 250);
        $img->save($path . '/' . $full_name);

        // save path in db
        $profile_image_url = '/images/user-'.$user->id.'/profile-image/'.$full_name;
        return $profile_image_url ;
    }


}
