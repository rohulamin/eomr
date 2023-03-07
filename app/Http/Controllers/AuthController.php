<?php


namespace App\Http\Controllers;
    
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Models\User;
use Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }


    public function getUser(){
        $inistitutes = User::All();
// dd($inistitutes);
    return response()->json($inistitutes);
      }   
        
    /**  
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.register');
    } 
         
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {

//         if (Auth::attempt(['email' => $email, 'password' => $password, 'active' => 1])) {
//     // The user is active, not suspended, and exists.
// }

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);
        
  
        if ($validator->fails()){
            return response()->json([
                    "status" => false,
                    "errors" => $validator->errors()
                ]);
        } else {
$email= $request->input('email');
$password=$request->input('password');

            // dd($request->input('password'));
            
            if (Auth::attempt(['email' => $email, 'password' => $password, 'active' => 1])) {
                return response()->json([
                    "status" => true, 
                    "redirect" => url("dashboard")
                ]);
            } else {
                return response()->json([
                    "status" => false,
                    "errors" => ["Account Inactive OR Invalid password "]
                ]);
            }
        }
    }
        
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {  
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:1',
            'confirm_password' => 'required|min:1|same:password',
        ]);
  
  // dd($request->all());

        if ($validator->fails()){
            return response()->json([
                    "status" => false,
                    "errors" => $validator->errors()
                ]);
        }
  
        $data = $request->all();
        $user = $this->create($data);
  
        Auth::login($user);
  
        return response()->json([
            "status" => true, 
            "redirect" => url("logout")
        ]);
        
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
    
        return redirect("login")->withSuccess('Opps! You do not have access*********************************');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {

      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();
    
        return Redirect('login');
    }
}
