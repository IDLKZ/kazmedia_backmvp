<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
}
