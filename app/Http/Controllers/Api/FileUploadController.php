<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\FileUpload;
use App\Models\UserProfile;
use App\Models\User;
use Auth;
use Mail;
use Http;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class FileUploadController extends Controller
{
    /** 
     * Generate Upload View 
     * 
     * @return void 

    */  

    /** 
     * File Upload Method 
     * 
     * @return void 
     */  
     public function index()
     {
         echo "worked";
     }

    public  function dropzoneFileUpload(Request $request)  
    {  

        $response=[];
        $response["header"]["return_flag"]="X";
        $response["header"]["error_detail"]="";
        $response["header"]["errors"] = [];
        $response["data"]= (object) array();
        $rules = [
            'file' => 'required|mimes:pdf',
            'user_id'=>'required',
        ];
        $messages=[
             'file.required' => 'File is Required.',
             'file.mimes' => 'Please upload a pdf file.',
             'user_id.required'=>"User ID is required.",
        ];
        $validator = Validator::make($request->all(), $rules,$messages);
        if ($validator->fails()) {
           $response["header"]["error_detail"]="validation error";
           $response["header"]["errors"] = $validator->messages();
        }
        else{
            $file = $request->file('file');
    
            $fileName = time().'.'.$file->extension(); 
            $file->move(public_path('uploads'),$fileName);  
            $file_path = public_path('uploads/').$fileName;
    
            $file_curl = new \CURLFile(realpath($file_path), 'pdf', 'file');
    
            $postdata = [
                'name' => 'pdf',
                'contents' => $file_curl,
                'pdf' => $file_curl,
            ];
    
            // submitting statement Fee Navigator.
            $ch = curl_init();
            curl_setopt( $ch , CURLOPT_URL , 'https://developer.feenavigator.com/api/v1/statements/upload');
            curl_setopt( $ch , CURLOPT_POST , true);
            curl_setopt( $ch , CURLOPT_POSTFIELDS , $postdata ); 
            curl_setopt( $ch , CURLOPT_RETURNTRANSFER , true);
            curl_setopt( $ch , CURLOPT_HTTPHEADER , array( 'Content-Type:  multipart/form-data','Accept: application/json','Authorization: 8Nc5i0x5oo3VzKHdKpmKmVg3vrMHAwcdlBtIjdpJ' ));
            $responsed = curl_exec( $ch );
            $responsed = json_decode($responsed);
            curl_exec ($ch);
    
            if (curl_errno($ch)) {
    
                $response["header"]["error_detail"]="PHP Curl Error";
                $response["header"]["errors"] =$msg;
                return response()->json($response);
            }
    
            curl_close ($ch);
            // dd($responsed);
            $response["header"]["error_detail"]="File Upload Response";
            $response["header"]["errors"] =$responsed;
            return response()->json($response);

            $id = $responsed->idStatement;
    
            // Extacting Results Fee Navigator.
            $ch = curl_init();
            curl_setopt( $ch , CURLOPT_URL , 'https://developer.feenavigator.com/api/v1/statements/get-datapoints/'. $id); 
            curl_setopt( $ch , CURLOPT_RETURNTRANSFER , true);
            curl_setopt( $ch , CURLOPT_HTTPHEADER , array( 'Content-Type:  multipart/form-data','Accept: application/json','Authorization: 8Nc5i0x5oo3VzKHdKpmKmVg3vrMHAwcdlBtIjdpJ' ));
            $responsee = curl_exec( $ch );
            $responsee = json_decode($responsee);
            curl_exec ($ch);
    
            if (curl_errno($ch)) {
    
                $response["header"]["error_detail"]="PHP Curl Error";
                $response["header"]["errors"] =$msg;
                return response()->json($response);
            }
    
            curl_close ($ch);
    
            $data = [
              'data' => $responsee,
              'file' => $fileName,
              'status' => 'true',
            ];
    
            $post = new Post;
            $post->user_id = $request->user_id;
            $post->statement = $fileName;
    
            foreach ($responsee as $key => $value) {
                if($value->name == 'Statement Period Start'){
                    $post->start_date = $value->formattedValue;
                }
                if($value->name == 'Statement Period End'){
                    $post->end_date = $value->formattedValue;
                }
                if($value->name == 'Merchant Name'){
                    $post->business_name = $value->formattedValue;
                }
                if($value->name == 'Total Volume'){
                    $post->total_volume = $value->formattedValue;
                }
                if($value->name == 'Total Fees'){
                    $post->total_fees = $value->formattedValue;
                }
                if($value->name == 'Effective Rate'){
                    $post->effective_rate = $value->formattedValue;
                }
                if($value->name == 'Avoidable Fees'){
    
                    if($value->formattedValue == null){
                        $post->avoidable_fees = '0.00';
                    }
                    else{
                        $post->avoidable_fees = $value->formattedValue;
                    }
                            
                }
            }
            $post->save();
            $response["header"]["return_flag"]="true";
            $response["data"]=$post;
        }
        return response()->json($response);
    }

}