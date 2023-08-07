<?php




namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    //
    public function create()
    {
        return view ('login');
    }
    public function store(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required'

        ]);

        $credinatils=[
            'email'=>$request->email,
            'password'=>$request->password,
            // 'status'=>'active',
        ];
        // طريقة اخرى
        // تحقق و
        //login
        $result=Auth::attempt($credinatils,
            $request->boolean('remember')
        );

        // $user=User::where('email','=',$request->email)->first();
       // كيف بدي اتاكد انه اليوزر authanicated
            // بقارن القيمة الموجودة في الداتا بيس مع القيمة الي بدخلها اليوزر

        // if($user && Hash::check($request->password,$user->password)){
                  // بتحقق من الايميل وبعدها الباسورد
          //plain (password)=== hash(from user )
          
        //     Auth::login($user,$request->boolean('remember'));
            // بمرر الها
            // userobject and store in session to know the authanctited user

            if($result){
                         return redirect()->intended('/');
                         // بمعنى اليوزر  طلب هاي الصفحة قبل م يعمل login
                         // لذلك بعد م يعمل  login
                        //  لازم يتم توجيه لهاي الصفحة

                // return redirect()->route('classrooms.index');
            }

            //if not authactited return to login page with same inputs
            return back()->withInput()->withErrors([
                'email'=>'invalid cardentals'
                // اذا دخل اشي غلط بدي يحتفظلي القيم الي دخلها اليوزر
            ]);

        }

    }


