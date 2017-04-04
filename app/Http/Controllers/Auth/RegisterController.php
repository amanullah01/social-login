<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Socialite;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }


    /*Facebook login*/
    /**
    * Redirect the user to the GitHub authentication page.
    *
    * @return Response
    */
   public function redirectToProvider()
   {
       return Socialite::driver('facebook')->redirect();
   }

   /**
    * Obtain the user information from GitHub.
    *
    * @return Response
    */
   public function handleProviderCallback()
   {
       try{
         $sociaUser = Socialite::driver('facebook')->user();
        //  echo $sociaUser->avatar_original;
        //  echo $sociaUser->getAvatar();
        //  dd($sociaUser);
       }
       catch(\Exception $e){
         return redirect('/');
       }

       $user = User::where('facebook_id',$sociaUser->getId() )->first();

       if(!$user){
         if($sociaUser->getEmail())
         {
             $createUser = new User ;

             $createUser->name = $sociaUser->getName();
             $createUser->facebook_id = $sociaUser->getId();
             $createUser->email = $sociaUser->getEmail();
             $createUser->profile_picture = $sociaUser->getAvatar();

             $createUser->save();

             auth()->login($createUser);
             return redirect()->to('/home')->with('success_login', 'Successfully Login with facebook');
          }else{
            return redirect()->to('/login')->with('login_failed', "Sorry! You didn't select Email id. Please try again later");
          }
       }else{
         auth()->login($user);
         return redirect()->to('/home')->with('success_login', 'Successfully Login with facebook');
       }
       // $user->token;
   }
   /*End facebook login*/
}
