<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiCalculationRequest;
use App\Http\Requests\ApiFreeTimeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiServerController extends Controller
{
    protected $response;
    public function __construct()
    {
        $this->response = Http::withBasicAuth('webservice', '123456Aa');
    }

    public function getRooms(){
        $response = $this->response->get("http://78.40.109.119/KMO/hs/app/rooms");
        if($response->status() == 200){
            $listOfRooms = json_decode($response->body());
            try{
                return response()->json(
                    [
                        "success"=>true,
                        "message"=>"Список комнат",
                        "data"=>$listOfRooms
                    ],200
                );
            }
            catch (\Exception $exception){
                return response()->json(
                    [
                        "success"=>false,
                        "message"=>"Ошибка",
                    ],401
                );
            }
        }
        else{
            return response()->json(
                [
                    "success"=>false,
                    "message"=>"Ошибка",
                ],401
            );

        }
    }

    public function getRoomFreeTime(ApiFreeTimeRequest $request){
        $url = "http://78.40.109.119/KMO/hs/app/roomfreetime/".$request->get("RequestDate")."/".auth("api")->user()->role_id."/".$request->get("RoomID")."";
        $response = $this->response->get($url);
        if($response->status() == 200){
            $listOfTimes = json_decode($response->body());
            try{
                return response()->json(
                    [
                        "success"=>true,
                        "message"=>"Список свободного времени",
                        "data"=>$listOfTimes
                    ],200
                );
            }
            catch (\Exception $exception){
                return response()->json(
                    [
                        "success"=>false,
                        "message"=>"Ошибка ${exception}",
                    ],401
                );
            }
        }
        else{
            return response()->json(
                [
                    "success"=>false,
                    "message"=>"Ошибка",
                ],401
            );

        }

    }

    public function getCalendar($date, $id)
    {
        $url = "http://78.40.109.119/KMO/hs/app/calendar/".$date."/".$id;
        $response = $this->response->get($url);
        if($response->status() == 200){
            $listOfRooms = json_decode($response->body());
            try{
                return response()->json($listOfRooms, 200);
            }
            catch (\Exception $exception){
                return response()->json(
                    [
                        "success"=>false,
                        "message"=>"Ошибка",
                    ],401
                );
            }
        }
        else{
            return response()->json(
                [
                    "success"=>false,
                    "message"=>"Ошибка",
                ],401
            );
        }
    }

    public function getCalculation(ApiCalculationRequest $request){
        //"http://78.40.109.119/KMO/hs/app/calculateprice/{RoomID}/{RequestDate}/{Crane}/{CameraAmount}/{PrompterAmount}/{VideoWall}/{CG}/{StudioMonitor}/{WiredMicAmount}/{WirelessMicAmount}/{RadioPAmount}/{RadioMicAmount}/{SoundProc}/{PhoneHybrid}/{Skype}/{Studio}/{Prod}/{News}/{Cinegy}/{MCR}";
        try{
            $url = "http://78.40.109.119/KMO/hs/app/calculateprice/".$request->get("RoomID") ."/".$request->get("RequestDate") ."/".$request->get("Crane")."/".$request->get("CameraAmount")."/".$request->get("PrompterAmount")."/".$request->get("VideoWall")."/".$request->get("CGAmount")."/".$request->get("StudioMonitor")."/".$request->get("WiredMicAmount")."/".$request->get("WirelessMicAmount")."/".$request->get("RadioPAmount")."/".$request->get("RadioMicAmount")."/".$request->get("SoundProc")."/".$request->get("PhoneHybrid")."/".$request->get("Skype")."/".$request->get("IngestStudio")."/".$request->get("IngestProd")."/".$request->get("IngestNews")."/".$request->get("IngestCinegy")."/".$request->get("MCR");
            $response = $this->response->get($url);
            $data = json_decode($response->body());
            return response()->json(
                [
                    "success"=>true,
                    "message"=>"Сумма проекта",
                    "data"=>["price"=>184.5]
                ],200
            );
        }
        catch (\Exception $exception){
            dd($exception);
            return response()->json(
                [
                    "success"=>false,
                    "message"=>"Ошибка",
                ],401
            );
        }

    }

}
