<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\UUIDGenerate;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransferValidate;
use App\Http\Requests\UpdatePassword;
use App\Http\Requests\UpdateUser;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PageController extends Controller
{
    public function home(){
        $user = Auth::user();
        return view('frontend.home',compact('user'));
    }

    public function profile(){
        $user = Auth::user();
        return view('frontend.profile',compact('user'));
    }

    public function profiledetail(){
        $user = Auth::user();
        return view('frontend.profile_detail',compact('user'));
    }

    public function updatepassword(){
        return view('frontend.updatepassword');
    }

    public function updated(UpdatePassword $request){
        $old_password = $request->password;
        $new_password = $request->new_password;
        $user  = Auth::guard('web')->user();

        if (Hash::check($old_password, $user->password)) {
            $user->password = Hash::make($new_password);
            $user->update();

            return redirect()->route('profile');
        }
        return back();
    }

    public function balance(){
        $authuser = Auth::guard('web')->user();
        return view('frontend.balance',compact('authuser'));
    }

    public function transfer(){
        return view('frontend.transfer');
    }

    public function transferConfirm(TransferValidate $request){
       
        $str = $request->to_email.$request->amount;
        $hash_value = hash_hmac('sha256',$str, 'swanpay1823@$');
        //error please check
        //if($request->hash_value !== $hash_value2){
        //    return back()->withErrors(['amount' => 'Something is wrong!'])->withInput();
        //}
        $authuser = Auth::guard('web')->user();
        if($authuser->email != $request->to){
            $check_user = User::where('email',$request->to)->first();
            if(!$check_user){
                return back()->withErrors(['to' => 'The email is not found'])->withInput();
            }
            if($request->amount < 1000){
                return back()->withErrors(['amount' => 'The amount must be least 1000 MMK'])->withInput();
            }
            if($authuser->wallet->amount <= $request->amount){
                return back()->withErrors(['amount'=>'This amount is not enough!'])->withInput();
            }
            $to_amount = $request->amount;
            $hash_value = $request->hash_value;
            return view('frontend.transfer_confirm',compact('authuser','check_user','to_amount','hash_value'));
        }else{
        return back()->withErrors(['to' => 'The email is same your email'])->withInput();
        }
    
    }

    public function transfercomplete(TransferValidate $request){
        //error please check
        //$str = $request->to_email.$request->amount;
        //$hash_value2 = hash_hmac('sha256',$str, 'swanpay1823@$');
        //if($request->hash_value !== $hash_value2){
        //    return back()->withErrors(['amount' => 'Something is wrong!'])->withInput();
        //}

        if($request->amount < 1000){
            return back()->withErrors(['amount' => 'The data is invalid,Please call service center'])->withInput();
        }
        $authuser = Auth::guard('web')->user();
        if($authuser->email == $request->to){
            return back()->withErrors(['to' => 'The data is invalid,Please call service center'])->withInput();
        }    
        $to_account = User::where('email',$request->to)->first();
        if(!$to_account){
            return back()->withErrors(['to' => 'The data is invalid,Please call service center'])->withInput();
        }
        if($authuser->wallet->amount <= $request->amount){
            return back()->withErrors(['amount'=>'This amount is not enough!'])->withInput();
        }
        
        $from_account = $authuser;
        $amount = $request->amount;
        DB::beginTransaction();
        try{
            $from_account_wallet = $from_account->wallet;
            $from_account_wallet->decrement('amount',$amount);
            $from_account_wallet->update();
            
            $to_account_wallet = $to_account->wallet;
            $to_account_wallet->increment('amount',$amount);
            $to_account_wallet->update();

            $ref_no = UUIDGenerate::refNumber();

            $from_account_transaction = new Transaction();
            $from_account_transaction->ref_no = $ref_no ;
            $from_account_transaction->trx_id = UUIDGenerate::trxId() ;
            $from_account_transaction->user_id = $from_account->id ;
            $from_account_transaction->type = 2 ;
            $from_account_transaction->amount = $amount ;
            $from_account_transaction->source_id = $to_account->id ; 
            $from_account_transaction->save();

            $to_account_transaction = new Transaction();
            $to_account_transaction->ref_no = $ref_no ;
            $to_account_transaction->trx_id = UUIDGenerate::trxId() ;
            $to_account_transaction->user_id = $to_account->id ;
            $to_account_transaction->type = 1 ;
            $to_account_transaction->amount = $amount ;
            $to_account_transaction->source_id = $from_account->id ; 
            $to_account_transaction->save();

            DB::commit();
            return redirect('/transaction')->with('transfer_success','Successfully transfered');
        }catch(\Exception $error){
            DB::rollBack();
            return back()->withErrors(['fail'=>'Something wrong. '. $error->getMessage()])->withInput();
        }

    }

    public function transaction(Request $request){
        $authuser = auth()->guard('web')->user();
        $transactions = Transaction::with('user','source')->orderBy('created_at','desc')->where('user_id',$authuser->id);
        if($request->date){
            $transactions = $transactions->whereDate('created_at',$request->date);
        }
        $transactions = $transactions->paginate(6);
        return view('frontend.transaction',compact('transactions'));
    }

    public function PasswordCheck(Request $request){
        $authuser = Auth::guard('web')->user();
        if(!$request->password){
            return response()->json([
                'status' =>'fail',
                'message' => 'Please fill your password',
            ]);
        }
        if (Hash::check($request->password, $authuser->password)) {
            return response()->json([
                'status' => 'success',
                'message' => 'The password is correct',
            ]);
        }
        return response()->json([
            'status' =>'fail',
            'message' => 'The password is incorrect',
        ]);
    }

    public function transferhash(Request $request){
        $str = $request->to_email.$request->amount;
        $hash_value = hash_hmac('sha256',$str, 'swanpay1823@$');
        return response()->json([
            'status' => 'success',
            'data' => $hash_value,
        ]);
    }

    public function qrcode(){
        $authuser = auth()->guard('web')->user();
        return view('frontend.qrcode',compact('authuser'));
    }

    public function scan(){
        return view('frontend.scan');
    }

    public function scanForm(Request $request){
        $from_account = auth()->guard('web')->user();
        $to_account = User::where('email',$request->to_email)->first();
        if($from_account->email === $request->to_email){
            return back()->withErrors(['fail'=>'QR code is same your QR code!'])->withInput();
        }
        if(!$to_account){
            return back()->withErrors(['fail'=>'QR code is invaild! try another QR code'])->withInput();
        }
        return view('frontend.scan-form',compact('from_account','to_account'));
    }

    public function scanConfirm(TransferValidate $request){
       
        $str = $request->to_email.$request->amount;
        $hash_value = hash_hmac('sha256',$str, 'swanpay1823@$');
        //error please check
        //if($request->hash_value !== $hash_value2){
        //    return back()->withErrors(['amount' => 'Something is wrong!'])->withInput();
        //}
        $authuser = Auth::guard('web')->user();
        if($authuser->email != $request->to){
            $check_user = User::where('email',$request->to)->first();
            if(!$check_user){
                return back()->withErrors(['to' => 'The email is not found'])->withInput();
            }
            if($request->amount < 1000){
                return back()->withErrors(['amount' => 'The amount must be least 1000 MMK'])->withInput();
            }
            if($authuser->wallet->amount <= $request->amount){
                return back()->withErrors(['amount'=>'This amount is not enough!'])->withInput();
            }
            $to_amount = $request->amount;
            $hash_value = $request->hash_value;
            return view('frontend.scan_confirm',compact('authuser','check_user','to_amount','hash_value'));
        }else{
        return back()->withErrors(['to' => 'The email is same your email'])->withInput();
        }
    
    }

    public function scanComplete(TransferValidate $request){
        //error please check
        //$str = $request->to_email.$request->amount;
        //$hash_value2 = hash_hmac('sha256',$str, 'swanpay1823@$');
        //if($request->hash_value !== $hash_value2){
        //    return back()->withErrors(['amount' => 'Something is wrong!'])->withInput();
        //}

        if($request->amount < 1000){
            return back()->withErrors(['amount' => 'The data is invalid,Please call service center'])->withInput();
        }
        $authuser = Auth::guard('web')->user();
        if($authuser->email == $request->to){
            return back()->withErrors(['to' => 'The data is invalid,Please call service center'])->withInput();
        }    
        $to_account = User::where('email',$request->to)->first();
        if(!$to_account){
            return back()->withErrors(['to' => 'The data is invalid,Please call service center'])->withInput();
        }
        if($authuser->wallet->amount <= $request->amount){
            return back()->withErrors(['amount'=>'This amount is not enough!'])->withInput();
        }
        
        $from_account = $authuser;
        $amount = $request->amount;
        DB::beginTransaction();
        try{
            $from_account_wallet = $from_account->wallet;
            $from_account_wallet->decrement('amount',$amount);
            $from_account_wallet->update();
            
            $to_account_wallet = $to_account->wallet;
            $to_account_wallet->increment('amount',$amount);
            $to_account_wallet->update();

            $ref_no = UUIDGenerate::refNumber();

            $from_account_transaction = new Transaction();
            $from_account_transaction->ref_no = $ref_no ;
            $from_account_transaction->trx_id = UUIDGenerate::trxId() ;
            $from_account_transaction->user_id = $from_account->id ;
            $from_account_transaction->type = 2 ;
            $from_account_transaction->amount = $amount ;
            $from_account_transaction->source_id = $to_account->id ; 
            $from_account_transaction->save();

            $to_account_transaction = new Transaction();
            $to_account_transaction->ref_no = $ref_no ;
            $to_account_transaction->trx_id = UUIDGenerate::trxId() ;
            $to_account_transaction->user_id = $to_account->id ;
            $to_account_transaction->type = 1 ;
            $to_account_transaction->amount = $amount ;
            $to_account_transaction->source_id = $from_account->id ; 
            $to_account_transaction->save();

            DB::commit();
            return redirect('/transaction')->with('transfer_success','Successfully transfered');
        }catch(\Exception $error){
            DB::rollBack();
            return back()->withErrors(['fail'=>'Something wrong. '. $error->getMessage()])->withInput();
        }

    }
}
