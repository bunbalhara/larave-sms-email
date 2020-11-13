<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Twilio\Rest\Client;

class SettingController extends Controller
{

    private $twilioClient;

    /**
     * SettingController constructor.
     */

    public function __construct()
    {
        $twilio_account_sid = option('twilio_account_sid', null);
        $twilio_account_token = option('twilio_account_token', null);
        if($twilio_account_sid && $twilio_account_token){
            $this->twilioClient = new Client($twilio_account_sid, $twilio_account_token);
        }
    }

    public function index(){
        return view('admin.settings.index');
    }

    public function getPhoneNumbers() {
        $phoneNumbers = $this->twilioClient->incomingPhoneNumbers->read();
        $data = [];
        foreach ($phoneNumbers as $phoneNumber){
            array_push($data, ['sid'=>$phoneNumber->sid, 'phoneNumber'=>$phoneNumber->phoneNumber]);
        }
        return response()->json([
            'status'=>1,
            'data'=>['phoneNumbers'=>$data],
            'message'=>'',
        ]);
    }

    public function set(Request $request){

        $validator = Validator::make($request->all(),[
            'twilio_account_sid'=>'required|string|size:34',
            'twilio_account_token'=>'required|string|size:32'
        ]);

        if($validator->passes()){
            foreach ($request->all() as $key=>$value){
                option([$key => $value]);
            }
            return response()->json(['status'=>1,'data'=>$request->all(),'message'=>'']);
        }

        return response()->json(['success'=>0, 'errors'=>$validator->errors(),'message'=>'']);
    }

    public function getServices()
    {
        $services = $this->twilioClient->messaging->v1->services->read();
        $data = [];
        foreach ($services as $service){

            // fetch phone numbers
            $phoneNumbers =  $this->twilioClient->messaging->v1->services($service->sid)->phoneNumbers->read();
            $phoneNumberData = [];
            foreach ($phoneNumbers as $phoneNumber){
                array_push($phoneNumberData, ['sid'=>$phoneNumber->sid, 'phoneNumber'=>$phoneNumber->phoneNumber]);
            }

            // fetch alpha senders
            $alphaSenders =  $this->twilioClient->messaging->v1->services($service->sid)->alphaSenders->read();
            $alphaSenderData = [];
            foreach ($alphaSenders as $alphaSender){
                array_push($alphaSenderData, ['sid'=>$alphaSender->sid, 'alphaSender'=>$alphaSender->alphaSender]);
            }

            array_push($data, ['sid'=>$service->sid, 'friendlyName'=>$service->friendlyName, 'phoneNumbers'=>$phoneNumberData, 'alphaSenders'=>$alphaSenderData]);

        }

        $services = $data;

        return response()->json([
            'status'=>1,
            'data'=>['services'=>$services],
            'view'=>view('admin.settings.service-name-table-body', compact('services'))->render(),
            'message'=>'']);
    }
    public function serviceNameAdd(Request $request)
    {
        $validator = Validator::make(array_merge($request->all()), [
            'service_name' => 'required',
            'service_alias' => 'required|max:11|regex:/^[a-zA-Z0-9 ]+$/',
            'phone_number'=>'required',
        ]);

        if ($validator->passes()) {
            try {
                $service = $this->twilioClient->messaging->v1->services->create($request->service_name);
                $this->twilioClient->messaging->v1->services($service->sid)
                    ->phoneNumbers
                    ->create($request->phone_number);
                $this->twilioClient->messaging->v1->services($service->sid)
                    ->alphaSenders
                    ->create($request->service_alias);

                $service = ['sid'=>$service->sid, 'friendlyName'=>$request->service_name, 'phoneNumbers'=>[['phoneNumber'=>$request->phone_number]], 'alphaSenders'=>[['alphaSender'=>$request->service_alias]]];

                return response()->json([
                    'status' => 1,
                    'view' => view('admin.settings.service-name-table-row', compact('service'))->render(),
                    'message' => 'Created Successfully'
                ]);

            } catch (\Exception $e) {
                return response()->json([
                    'status' => 0,
                    'errors' => ['Something went wrong try again'],
                    'message' => $e->getMessage()
                ]);
            }

        }

        return response()->json([
            'status' => 0,
            'errors' => $validator->errors(),
            'message' => "",
        ]);
    }

    public function serviceNameUpdate(Request $request){

        $validator = Validator::make($request->all(), [
           'serviceSid'=>'required',
           'service_name'=>'required',
           'phone_number'=>'required' ,
            'alphaSenderSid'=>'required',
            'service_alias'=>'required|max:11|regex:/^[a-zA-Z0-9 ]+$/',
        ]);

        if($validator->passes()){

            $this->twilioClient->messaging->v1->services($request->serviceSid)
                ->update(["friendlyName" => $request->service_name]);

            $this->twilioClient->messaging->v1->services($request->serviceSid)
                ->alphaSenders($request->alphaSenderSid)
                ->delete();

            $this->twilioClient->messaging->v1->services($request->serviceSid)
                ->alphaSenders
                ->create($request->service_alias);

            $this->twilioClient->messaging->v1->services($request->serviceSid)
                ->phoneNumbers($request->oldPhoneNumberSid)
                ->delete();

            $this->twilioClient->messaging->v1->services($request->serviceSid)
                ->phoneNumbers
                ->create($request->phone_number);

            return response()->json([
                'status' => 1,
                'data' => $request->all(),
                'message' => "Updated successfully",
            ]);
        }

        return response()->json([
            'status' => 0,
            'errors' => $validator->errors(),
            'message' => "",
        ]);
    }

    public function serviceNameDelete(Request $request){
        $ids = explode(',', $request->ids);
        foreach ($ids as $id){
            $this->twilioClient->messaging->v1->services($id)->delete();
        }
        return response()->json(['status'=>1,'message'=>count($ids).' services deleted successfully!']);
    }
}
