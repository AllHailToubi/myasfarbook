<?php

namespace Modules\Hotel\Http\Controllers;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Hotel\Entities\Room;
use Modules\Hotel\Entities\Hotel;
use Modules\Hotel\Entities\Roomavibility;
use Modules\Hotel\Entities\Amenitie;
use Modules\User\Http\Controllers\AdminController;
use Validator;
use File;

class RoomController extends AdminController
{

    public function permission(){
        $this->checkPermission('manage hotels');
    }

    public function allRooms($hotel_id){
        $this->permission();
        $rooms=Room::all($hotel_id);
        $hotel=Hotel::find($hotel_id);

        return view('hotel::rooms.all_rooms',['rooms'=>$rooms,'hotel'=>$hotel]);
    }

    public function newRoom(Request $request){
        $this->permission();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $room=Room::create([
            'name' => $request->name,
            'hotel_id'=>$request->hotel_id,
            'agency_id' => agencyID(),
        ]);
        
        return redirect()->route('hotel.editRoom',$room->id);
    }

    public function editRoom($id){
        
        $this->permission();
        $room=Room::find($id);
        
        $checked=$room->amenities;
        $tabchecked=explode(",", $checked);
        $Amenities=Amenitie::getAmenities("en",AMENITIES_ROOM);//AMENITIES_ROOM

        foreach ($Amenities as $Amenitie) {
            $ischecked="";
            if(in_array($Amenitie->id,$tabchecked)){
                $ischecked="checked";
            }
            $AllAmenities[] = array("id" => $Amenitie->id, "icon" => $Amenitie->icon, "title" => $Amenitie->title, "checked" => $ischecked);
        }

        return view('hotel::rooms.edit_room',['room'=>$room,"Amenities"=>$AllAmenities]);
    }

    public function saveupdate(Request $request){
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'number_of_rooms' => ['required', 'integer', 'min:1'],
            'number_of_beds' => ['required', 'integer', 'min:1'],
            'size' => ['required', 'integer', 'min:1'],
            'max_adults' => ['required', 'integer', 'min:0'],
            'max_children' => ['required', 'integer', 'min:0'],
        ]);

        

        $room=Room::find($request->id);
        $room->status=$request->publish?$request->publish:0;
        $room->name=$request->name;
        $room->price=$request->price;
        $room->number_of_rooms=$request->number_of_rooms;
        $room->number_of_beds=$request->number_of_beds;
        $room->size=$request->size;
        $room->max_adults=$request->max_adults;
        $room->max_children=$request->max_children;
        $room->amenities=$request->amenities?implode( ",", $request->amenities):NULL;
        $room->save();

        return redirect()->route('hotel.allRooms',$room->hotel_id);
    }

    public function delete(Request $request){
        
        if($request->submit=="restore"){
            Room::restoreID($request->id);
        }

        if($request->submit=="archive"){
            Room::deleteID($request->id);
        }

        if($request->submit=="delete"){
            $hotel=Room::forcedeleteID($request->id);

            //delete feature image
            $imagename=public_path(IMAGES_ROOMS).'/'.$hotel->image_id;
            File::delete($imagename);

            //delete gallery images
            $images = explode(",", $hotel->gallery);
            foreach($images as $img){
                $imagename=public_path(IMAGES_ROOMS).'/'.$img;
                File::delete($imagename);
            }
        }

        
        return redirect()->route('hotel.allRooms',$request->hotel_id);
    }

    public function availabilityRooms($hotel_id){
        $this->permission();
        $rooms=Room::all($hotel_id,['id','name','price']);
        $data=json_encode($rooms);
        $roomavibility=null;

        if($rooms->first()){
            foreach($rooms as $room){
                $arr[]=$room->id;
            }  
            $roomavibility=Roomavibility::getAvibilityMonth($arr,date("m"),date("Y"));
        }
         $avibility=json_encode($roomavibility);
         $hotel=Hotel::find($hotel_id);

        return view('hotel::rooms.availability',['data'=>$data,'avibility'=>$avibility,'hotel'=>$hotel]);
    }

    public function avibilityMonth(Request $request,$hotel_id){
        $this->permission();
        $rooms=Room::all($hotel_id,['id','name','price']);
        $data=json_encode($rooms);
        $roomavibility=null;

        if($rooms->first()){
            foreach($rooms as $room){
            $arr[]=$room->id;
            }
        
            $roomavibility=Roomavibility::getAvibilityMonth($arr,$request->month,$request->year);
        }
        $avibility=json_encode($roomavibility);
        return ['data'=>$data,'avibility'=>$avibility];
    }


    public function avibilitySetPrice(Request $request,$hotel_id){
        $id_room=$request->id_room;
        $strat_date=$request->strat_date;
        $end_date=$request->end_date;
        $price=$request->price;
        $week=explode(",", $request->chked);;
        $arr_length = count($week);
        $isdispo=$request->isdispo;

        if($request->isdefault=="0" || $isdispo==0){
            if($arr_length==7){
                Roomavibility::UpdateAvibilityRange($id_room,$strat_date,$end_date,$price,$isdispo);   
            }else{
                Roomavibility::UpdateAvibilityRange($id_room,$strat_date,$end_date,$price,$isdispo,$week);
            }
        }else{
            if($arr_length==7){
                Roomavibility::deleteAvibilityRange($id_room,$strat_date,$end_date);
            }else{
                Roomavibility::deleteAvibilityRange($id_room,$strat_date,$end_date,$week);
            }
        }
        

        return "";
    }

    //################ Media ###################

    public function uploadImage(Request $request){
        $this->permission();


        $validation = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'id' => 'required'
        ]);

        
        
        if($validation->passes()) {
            
            $image = $request->file('file');
            $idroom=$request['id'];
            $new_name = $idroom . '-'.rand().'.' . $image->getClientOriginalExtension();
            $room=Room::find($request->id);
            $imagename=public_path(IMAGES_ROOMS).'/'.$room->image_id;

            //return "ok";
            
            if($image->move(public_path(IMAGES_ROOMS), $new_name)){
                File::delete($imagename);
                //Hotel::where('id', $idroom)->update(['image_id' =>  $new_name]);
                $room->image_id=$new_name;
                $room->save();

                return response()->json([
                    'message'   => "success",
                    'uploaded_image' => '<img width="100%" height="100%" src="'.asset(IMAGES_ROOMS.$room->image_id).'"  />',
                    'class_name'  => 'alert-success'
                ]);
            }else{
                return response()->json([
                    'message'   => "error",
                    'uploaded_image' => "Image not saved",
                    'class_name'  => 'alert-success'
                ]);
            } 
            
        }else{
            
            return response()->json([
                'message'   => "error",
                'uploaded_image' => $validation->errors()->all(),
                'class_name'  => 'alert-success'
            ]);
        }
       
        
 
        
    }

    public function addToGallery(Request $request){
        $this->permission();
        $validation = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'id' => 'required'
        ]);

        
        if($validation->passes())
        {
            $image = $request->file('file');
            $idroom=$request['id'];
            $new_name = $idroom . '-gl-'.rand().'.' . $image->getClientOriginalExtension();
            

            if($image->move(public_path(IMAGES_ROOMS), $new_name)){
                $room=Room::find($idroom);
                if(!isset($room->gallery) || empty($room->gallery))
                    $room->gallery=$new_name;
                else
                    $room->gallery=$room->gallery.",".$new_name;
                    
                $room->save();
                

                $imagename=$room->gallery;

                return response()->json([
                    'message'   => "success",
                    'uploaded_image' => $room->gallery,
                    'class_name'  => 'alert-success'
                ]);
            }else{
                return response()->json([
                    'message'   => "error",
                    'uploaded_image' => $validation->errors()->all(),
                    'class_name'  => 'alert-success'
                ]);
            }
  
        }else{        
            return response()->json([
                'message'   => "error",
                'uploaded_image' => $validation->errors()->all(),
                'class_name'  => 'alert-success'
            ]);
        }
       
        
    }

    public function deleteimage(Request $request){
        $this->permission();
        $room=Room::find($request->id);
        $imagename=public_path(IMAGES_ROOMS).'/'.$room->image_id;
        $room->image_id=NULL;
        $room->save();
        File::delete($imagename);
        
        return response()->json([
            'message'   => "image is deleted:".$imagename
        ]);
    }

    public function deleteimageGallery(Request $request){
        $this->permission();
        $room=Room::find($request->id);
        $images = explode(",", $room->gallery);
        $imggl="";
        $i=0;
        foreach($images as $img){
            if($request->name!== $img){
                if($i==0)
                    $imggl=$img;
                else
                    $imggl=$imggl.",".$img;

                $i++;
            }   
        }

        $imagename=public_path(IMAGES_ROOMS).'/'.$request->name;
        $room->gallery=$imggl;
        $room->save();
        File::delete($imagename);
        
        return response()->json([
            'message'   => $imggl,
            'uploaded_image' => $imggl
        ]);
    } 
}
