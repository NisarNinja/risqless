<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\FileUpload;
use App\Models\UserProfile;
use App\Models\User;
use Auth;
use Mail;
use Http;
use App\Models\Post;

class FileUploadController extends Controller
{
    /** 
     * Generate Upload View 
     * 
     * @return void 

    */  

    public  function dropzoneUi()  
    {  
        return view('user.pages.dropzone-file-upload');  
    }  

    /** 
     * File Upload Method 
     * 
     * @return void 
     */  

    public  function dropzoneFileUpload(Request $request)  
    {  
        $file = $request->file('file');

        $fileName = time().'.'.$file->extension(); 
        $file->move(public_path('uploads'),$fileName);  
        $file_path = public_path('uploads/').$fileName;

        $file_curl = new \CURLFile(realpath($file_path), 'pdf', 'file');

        $post = [
            'name' => 'pdf',
            'contents' => $file_curl,
            'pdf' => $file_curl,
        ];

        // submitting statement Fee Navigator.
        $ch = curl_init();
        curl_setopt( $ch , CURLOPT_URL , 'https://developer.feenavigator.com/api/v1/statements/upload');
        curl_setopt( $ch , CURLOPT_POST , true);
        curl_setopt( $ch , CURLOPT_POSTFIELDS , $post ); 
        curl_setopt( $ch , CURLOPT_RETURNTRANSFER , true);
        curl_setopt( $ch , CURLOPT_HTTPHEADER , array( 'Content-Type:  multipart/form-data','Accept: application/json','Authorization: 8Nc5i0x5oo3VzKHdKpmKmVg3vrMHAwcdlBtIjdpJ' ));
        $response = curl_exec( $ch );
        $response = json_decode($response);
        curl_exec ($ch);

        if (curl_errno($ch)) {

            $msg = curl_error($ch);
            return response()->json(['error'=>'curl_errno']);
        }

        curl_close ($ch);

        $id = $response->idStatement;

        // Extacting Results Fee Navigator.
        $ch = curl_init();
        curl_setopt( $ch , CURLOPT_URL , 'https://developer.feenavigator.com/api/v1/statements/get-datapoints/'. $id); 
        curl_setopt( $ch , CURLOPT_RETURNTRANSFER , true);
        curl_setopt( $ch , CURLOPT_HTTPHEADER , array( 'Content-Type:  multipart/form-data','Accept: application/json','Authorization: 8Nc5i0x5oo3VzKHdKpmKmVg3vrMHAwcdlBtIjdpJ' ));
        $response = curl_exec( $ch );
        $response = json_decode($response);
        curl_exec ($ch);

        if (curl_errno($ch)) {

            $msg = curl_error($ch);
            return response()->json(['status'=>'false']);
        }

        curl_close ($ch);

        
        $data = [
            'data' => $response,
            'file' => $fileName,
            'status' => 'true',
        ];
        
        $response = collect($response);
        $response = $response->toArray();
        $post = new Post;
        $post->user_id = Auth::id();
        $post->statement = $fileName;

        foreach ($response as $key => $value) {
            if($key == 'Statement Period Start'){
                $post->start_date = $value;
            }
            if($key == 'Statement Period End'){
                $post->end_date = $value;
            }
            if($key == 'Merchant Name'){
                $post->business_name = $value;
            }
            if($key == 'Total Volume'){
                $post->total_volume = $value;
            }
            if($key == 'Total Fees'){
                $post->total_fees = $value;
            }
            if($key == 'Effective Rate'){
                $post->effective_rate = $value;
            }
            if($key == 'Avoidable Fees'){

                if($value == null){
                    $post->avoidable_fees = '0.00';
                }
                else{
                    $post->avoidable_fees = $value;
                }
                        
            }
        }

        $post->save();

        return response()->json($data);

        /*  ##################################
            CODE TO SAVE FILE AND SEND EMAIL
            ##################################
        */
        // $file = $request->file('file');

        // $fileName = time().'.'.$file->extension(); 
        // $file->move(public_path('uploads'),$fileName);  
        // $file_path = public_path('uploads/').$fileName;

        // $user = User::find(Auth::id());
        // $profile = UserProfile::where('user_id' ,Auth::id())->first();

        // $data = [
        //     'file_name' => $file_path,
        //     'email' => $user->email,
        //     'name' => $user->name,
        // ];
        // $response = Mail::to($user)->send(new FileUpload($data));

        // if( count(Mail::failures()) > 0 ) {

        //    return response()->json(['error'=>'false']);

        // } else {
        //     return response()->json(['success'=>'true']);
        // }

    }

}