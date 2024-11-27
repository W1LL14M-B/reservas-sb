<?php

/* namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
 */

 use App\Models\Room;
use App\Models\Hotel; 
use Illuminate\Http\Request;

class RoomController extends Controller  
{

public function store(Request $request)
{
    $request->validate([
        'hotel_id' => 'required|exists:hotels,id',
        'name' => 'required|string|max:255',
    ]);                     

    $hotelId = $request->hotel_id;
    $currentRoomCount = Room::where('hotel_id', $hotelId)->count();

    if ($currentRoomCount >= 47) {
        return response()->json(['error' => 'No se pueden agregar más de 47 habitaciones a este hotel.'], 400);
    }

    $room = Room::create($request->all());
    return response()->json($room, 201);
}

}
