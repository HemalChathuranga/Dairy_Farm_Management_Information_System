<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'emp_id',
        'first_name',
        'last_name',
        'birth_date',
        'gender',
        'joined_date',
        'nic',
        'mobile_number',
        'address',
        'email',
        'prof_pic',
        'role',
        'status',
        'password',
    ];

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
        'password' => 'hashed',
    ];

    //Fetch the Admin User records
    static public function getAdminRec(){

        $return = self::SELECT('users.*')
                        ->WHERE('users.role','=','Admin');

                        //Search Filters applied to Admin user List
                        if (!empty(Request::get('emp_id'))) {
                            $return = $return->WHERE('emp_id','LIKE', '%'.Request::get('emp_id').'%');
                        }

                        if (!empty(Request::get('name'))) {
                            $return = $return->WHERE('first_name','LIKE', '%'.Request::get('name').'%')
                                                ->ORWHERE('last_name','LIKE', '%'.Request::get('name').'%');
                        }

                        if (!empty(Request::get('email'))) {
                            $return = $return->WHERE('email','LIKE', '%'.Request::get('email').'%');
                        }

        $return = $return->WHERE('role','=','Admin')
                            ->ORDERBY('id', 'asc')
                            ->paginate(5);

        return $return;
    }

    //Fetch Managers User records
    static public function getManagerRec(){

        $return = self::SELECT('users.*')
                        ->WHERE('users.role','=','Manager');

                        //Search Filters applied to Manager user List
                        if (!empty(Request::get('emp_id'))) {
                            $return = $return->WHERE('emp_id','LIKE', '%'.Request::get('emp_id').'%');
                        }

                        if (!empty(Request::get('name'))) {
                            $return = $return->WHERE('first_name','LIKE', '%'.Request::get('name').'%')
                                                ->ORWHERE('last_name','LIKE', '%'.Request::get('name').'%');
                        }

                        if (!empty(Request::get('email'))) {
                            $return = $return->WHERE('email','LIKE', '%'.Request::get('email').'%');
                        }

        $return = $return->WHERE('role','=','Manager')
                            ->ORDERBY('id', 'asc')
                            ->paginate(5);

        return $return;
    }


    //Fetch Office Staff User records
    static public function getOfficeStaffRec(){

        $return = self::SELECT('users.*')
                        ->WHERE('users.role','=','Office Staff');

                        //Search Filters applied to Manager user List
                        if (!empty(Request::get('emp_id'))) {
                            $return = $return->WHERE('emp_id','LIKE', '%'.Request::get('emp_id').'%');
                        }

                        if (!empty(Request::get('name'))) {
                            $return = $return->WHERE('first_name','LIKE', '%'.Request::get('name').'%')
                                                ->ORWHERE('last_name','LIKE', '%'.Request::get('name').'%');
                        }

                        if (!empty(Request::get('email'))) {
                            $return = $return->WHERE('email','LIKE', '%'.Request::get('email').'%');
                        }

        $return = $return->WHERE('role','=','Office Staff')
                            ->ORDERBY('id', 'asc')
                            ->paginate(5);

        return $return;
    }


    //Fetch Medical Staff User records
    static public function getMedicalStaffRec(){

        $return = self::SELECT('users.*')
                        ->WHERE('users.role','=','Medical Staff');

                        //Search Filters applied to Manager user List
                        if (!empty(Request::get('emp_id'))) {
                            $return = $return->WHERE('emp_id','LIKE', '%'.Request::get('emp_id').'%');
                        }

                        if (!empty(Request::get('name'))) {
                            $return = $return->WHERE('first_name','LIKE', '%'.Request::get('name').'%')
                                                ->ORWHERE('last_name','LIKE', '%'.Request::get('name').'%');
                        }

                        if (!empty(Request::get('email'))) {
                            $return = $return->WHERE('email','LIKE', '%'.Request::get('email').'%');
                        }

        $return = $return->WHERE('role','=','Medical Staff')
                            ->ORDERBY('id', 'asc')
                            ->paginate(5);

        return $return;
    }


    //Fetch Field Staff User records
    static public function getFieldStaffRec(){

        $return = self::SELECT('users.*')
                        ->WHERE('users.role','=','Field Staff');

                        //Search Filters applied to Manager user List
                        if (!empty(Request::get('emp_id'))) {
                            $return = $return->WHERE('emp_id','LIKE', '%'.Request::get('emp_id').'%');
                        }

                        if (!empty(Request::get('name'))) {
                            $return = $return->WHERE('first_name','LIKE', '%'.Request::get('name').'%')
                                                ->ORWHERE('last_name','LIKE', '%'.Request::get('name').'%');
                        }

                        if (!empty(Request::get('email'))) {
                            $return = $return->WHERE('email','LIKE', '%'.Request::get('email').'%');
                        }

        $return = $return->WHERE('role','=','Field Staff')
                            ->ORDERBY('id', 'asc')
                            ->paginate(5);

        return $return;
    }
 

    //Fetch Stores Staff User records
    static public function getStoresStaffRec(){

        $return = self::SELECT('users.*')
                        ->WHERE('users.role','=','Stores Staff');

                        //Search Filters applied to Manager user List
                        if (!empty(Request::get('emp_id'))) {
                            $return = $return->WHERE('emp_id','LIKE', '%'.Request::get('emp_id').'%');
                        }

                        if (!empty(Request::get('name'))) {
                            $return = $return->WHERE('first_name','LIKE', '%'.Request::get('name').'%')
                                                ->ORWHERE('last_name','LIKE', '%'.Request::get('name').'%');
                        }

                        if (!empty(Request::get('email'))) {
                            $return = $return->WHERE('email','LIKE', '%'.Request::get('email').'%');
                        }

        $return = $return->WHERE('role','=','Stores Staff')
                            ->ORDERBY('id', 'asc')
                            ->paginate(5);

        return $return;
    }


    static public function getRecByID($id){

        return self::findOrFail($id);
    }

    //Fetch User records by role
    static public function getUserRec($role){

        $return = self::SELECT('users.*')
                        ->WHERE('status','=','Active')
                        ->WHERE('users.role','=',$role);

        $return = $return->count();

        return $return;
    }
}
