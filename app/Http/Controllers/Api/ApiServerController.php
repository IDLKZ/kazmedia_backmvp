<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiCalculationRequest;
use App\Http\Requests\ApiCreateRequest;
use App\Http\Requests\ApiFreeTimeRequest;
use Doctrine\DBAL\Driver\Exception;
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
        $response = $this->response->get("http://78.40.109.119/kmo/hs/app/rooms");
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
        $url = "http://78.40.109.119/kmo/hs/app/roomfreetime/".$request->get("RequestDate")."/".auth("api")->user()->role_id."/".$request->get("RoomID")."";
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
        $url = "http://78.40.109.119/kmo/hs/app/calendar/".$date."/".$id;
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
        //"http://78.40.109.119/kmo/hs/app/calculateprice/{RoomID}/{RequestDate}/{Crane}/{CameraAmount}/{PrompterAmount}/{VideoWall}/{CG}/{StudioMonitor}/{WiredMicAmount}/{WirelessMicAmount}/{RadioPAmount}/{RadioMicAmount}/{SoundProc}/{PhoneHybrid}/{Skype}/{Studio}/{Prod}/{News}/{Cinegy}/{MCR}";
        try{

            $url = "http://78.40.109.119/kmo/hs/app/calculateprice/".$request->get("RoomID") ."/".$request->get("RequestDate") ."/".($request->get("Crane") == false ? 0 : 1)."/".$request->get("CameraAmount")."/".$request->get("PrompterAmount")."/".$request->get("VideoWall")."/".$request->get("CGAmount")."/".$request->get("StudioMonitor")."/".$request->get("WiredMicAmount")."/".$request->get("WirelessMicAmount")."/".$request->get("RadioPAmount")."/".$request->get("RadioMicAmount")."/".($request->get("SoundProc") == false ? 0 : 1)."/".($request->get("PhoneHybrid") == false ? 0 : 1)."/".($request->get("Skype") == false ? 0 : 1)."/". ($request->get("IngestStudio") == false ? 0 : 1)."/".($request->get("IngestProd") == false ? 0 : 1)."/".($request->get("IngestNews") == false ? 0 : 1)."/". ($request->get("IngestCinegy")== false ? 0 : 1 ) ."/". ($request->get("MCR") == false ? 0 : 1);
            $response = $this->response->get($url);
            $data = json_decode($response->body(),flags: JSON_OBJECT_AS_ARRAY);
            if($data == null || $data["Status"] == false){
                if(isset($data["Description"])){
                    return response()->json(["success"=>false,'errors'=>$data["Description"]],200);
                }
                return response()->json(["success"=>false,'errors'=>["Глобальная ошибка - попробуйте позже"]],200);
            }
            return response()->json(
                [
                    "success"=>true,
                    "message"=>"Сумма проекта",
                    "data"=>["price"=>$data["Price"]]
                ],200
            );
        }
        catch (\Exception $exception){
            return response()->json(
                [
                    "success"=>false,
                    "message"=>"$exception",
                ],
                400
            );
        }

    }

    public function CreateRequest(ApiCreateRequest $request){
        //http://78.40.109.119/kmo/hs/app/studiorequest/{UserID}/{RequestType}/{RoomID}/{StartDate}/{EndDate}/{Program}/{Sum}/{P1}/{P2}/{P3}/{P4}/{P5}/{P6}/{P7}/{P8}/{P9}/{P10}/{P11}/{P12}/{P13}/{P14}/{P15}/{P16}/{P17}/{P18}/{P19}/{P20}
        try{
            $url = "http://78.40.109.119/kmo/hs/app/studiorequest/"."0f42a905-87bf-11ec-90fc-901a1013ce69"."/".$request->get("RequestType") ."/".$request->get("RoomID") . "/". $request->get("StartDate") . "/". $request->get("EndDate") . "/". $request->get("Program") . "/".$request->get("Sum") .
                "/".($request->get("Crane") == false ? 0 : 1)."/".$request->get("CameraAmount")."/".$request->get("PrompterAmount")."/".$request->get("VideoWall")."/".$request->get("CGAmount")."/".$request->get("StudioMonitor")."/".$request->get("WiredMicAmount")."/".$request->get("WirelessMicAmount")."/".$request->get("RadioPAmount")."/".$request->get("RadioMicAmount")."/".($request->get("SoundProc") == false ? 0 : 1)."/".($request->get("PhoneHybrid") == false ? 0 : 1)."/".($request->get("Skype") == false ? 0 : 1)."/". ($request->get("IngestStudio") == false ? 0 : 1)."/".($request->get("IngestProd") == false ? 0 : 1)."/".($request->get("IngestNews") == false ? 0 : 1)."/". ($request->get("IngestCinegy")== false ? 0 : 1 ) ."/". ($request->get("MCR") == false ? 0 : 1);
            $response = $this->response->get($url);
            $data = json_decode($response->body(),flags: JSON_OBJECT_AS_ARRAY);
            return response()->json(
                [
                    "success"=>$data["Status"],
                    "message"=>$data["Status"] == true ?"Успешно создана заявка" : "Что-то пошло не так",
                    "data"=> $data["RequestNumber"]
                ],200
            );
        }
        catch (Exception $ex){
            return response()->json(
                [
                    "success"=>false,
                    "message"=>"Ошибка $ex",
                ],
                400
            );
        }



    }

}
