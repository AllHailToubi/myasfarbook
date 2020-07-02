<?php

namespace Modules\Hotel\Http\Controllers;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
// use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Hotel\Entities\Room;
use Modules\Hotel\Entities\Hotel;
use Modules\Hotel\Entities\Amenitie;
use Modules\Hotel\Entities\Facilities_hotel;
use Modules\User\Http\Controllers\AdminController;
use App\Models\Cities;
use Validator;
use File;


class HotelController extends AdminController
{

    public function permission(){
        $this->checkPermission('manage hotels');
    }

    

    public function test(){

        return view('hotel::index');
    }

    public function testapi(){

        return "ok";
    }

    

  

    public function allHotels(){
        $hotels=Hotel::all();
        return view('hotel::hotels.all_Hotels',['hotels'=>$hotels]);
    }

    public function newHotel(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        $hotel=Hotel::create([
            'name' => $request->name,
            'agency_id' => agencyID(),
        ]);
        
        return redirect()->route('hotel.edit',$hotel->id);
    }

    

    public function allArchiveHotels(){
        

        $hotels=Hotel::myTrashed();
        
        return view('hotel::hotels.all_archive_Hotels',['hotels'=>$hotels]);
    }



    public function edit($id){
        $this->permission();
        $hotel=Hotel::find($id);
        $cities=Cities::orderBy('name')->get(); 
        $checked=$hotel->facilities;
        $tabchecked=explode(",", $checked);
        //$Amenities=Amenitie::getAmenities("en");
        $facilities_hotel=Facilities_hotel::orderBy('order_show')->get();
        foreach ($facilities_hotel as $facility) {
            $ischecked="";
            if(in_array($facility->id,$tabchecked)){
                $ischecked="checked";
            }
            
            $AllFacilities[] = array("id" => $facility->id, "icon" => $facility->icon, "title" => __($facility->trans_key), "checked" => $ischecked);
        }

        return view('hotel::hotels.edit_hotel',['cities'=>$cities,'hotel'=>$hotel,"facilities"=>$AllFacilities]);
    }

    public function saveupdate(Request $request){
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'shortdesc' => ['required', 'string', 'max:300'],
            'fulldesc' => ['required', 'string'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:10'],
            'map_lat' => ['required', 'string', 'max:50'],
            'map_lng' => ['required', 'string', 'max:50'],
            'map_zoom' => ['required', 'string', 'max:2'],
            'embedmap' => ['required', 'string'],
            'star_rate' => ['required', 'string', 'min:1','max:5'],
        ]);

        $hotel=Hotel::find($request->id);
        $hotel->status=$request->publish?$request->publish:0;
        $hotel->name=$request->name;
        $hotel->shortdesc=$request->shortdesc;
        $hotel->fulldesc=$request->fulldesc;
        $hotel->address=$request->address;
        $hotel->city=explode(":", $request->city)[0];
        $hotel->country=$request->country;
        $hotel->map_lat=$request->map_lat;
        $hotel->map_lng=$request->map_lng;
        $hotel->map_zoom=$request->map_zoom;
        $hotel->embedmap=$request->embedmap;
        $hotel->video=$request->video;
        $hotel->facilities=$request->facilities?implode( ",", $request->facilities):NULL;
        $hotel->star_rate=$request->star_rate;
        $hotel->save();

        return redirect()->route('hotel.allHotels');
    }

    public function delete(Request $request){
        if($request->submit=="restore"){
            Hotel::restoreID($request->id);
        }

        if($request->submit=="archive"){
            Hotel::deleteID($request->id);
        }

        if($request->submit=="delete"){
            
            $hotel=Hotel::FindTrashed($request->id);
           // dd($hotel->rooms->count());
            if($hotel->rooms->count()){
                return redirect()->route('hotel.allArchiveHotels')->withErrors(['error' => __('hotel.delete rooms first')]);;
            }


            Hotel::forcedeleteID($request->id);

            //delete feature image
            $imagename=public_path(IMAGES_HOTELS).'/'.$hotel->image_id;
            File::delete($imagename);

            //delete gallery images
            $images = explode(",", $hotel->gallery);
            foreach($images as $img){
                $imagename=public_path(IMAGES_HOTELS).'/'.$img;
                File::delete($imagename);
            }
        }

        
        return redirect()->route('hotel.allHotels');
    }
    

    public function uploadImage(Request $request){
        $validation = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'id' => 'required'
        ]);

        
        if($validation->passes()) {
            $image = $request->file('file');
            $idhotel=$request['id'];
            $new_name = $idhotel . '-'.rand().'.' . $image->getClientOriginalExtension();
            $hotel=Hotel::find($request->id);
            $imagename=public_path(IMAGES_HOTELS).'/'.$hotel->image_id;
            
            if($image->move(public_path(IMAGES_HOTELS), $new_name)){
                File::delete($imagename);
                //Hotel::where('id', $idhotel)->update(['image_id' =>  $new_name]);
                $hotel->image_id=$new_name;
                $hotel->save();

                return response()->json([
                    'message'   => "success",
                    'uploaded_image' => '<img width="100%" height="100%" src="'.asset(IMAGES_HOTELS.$hotel->image_id).'"  />',
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
        $validation = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'id' => 'required'
        ]);

        
        if($validation->passes())
        {
            $image = $request->file('file');
            $idhotel=$request['id'];
            $new_name = $idhotel . '-gl-'.rand().'.' . $image->getClientOriginalExtension();
            

            if($image->move(public_path(IMAGES_HOTELS), $new_name)){
                $hotel=Hotel::find($idhotel);
                if(!isset($hotel->gallery) || empty($hotel->gallery))
                    $hotel->gallery=$new_name;
                else
                    $hotel->gallery=$hotel->gallery.",".$new_name;
                    
                $hotel->save();
                

                $imagename=$hotel->gallery;

                return response()->json([
                    'message'   => "success",
                    'uploaded_image' => $hotel->gallery,
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
        $hotel=Hotel::find($request->id);
        $imagename=public_path(IMAGES_HOTELS).'/'.$hotel->image_id;
        $hotel->image_id=NULL;
        $hotel->save();
        File::delete($imagename);
        
        return response()->json([
            'message'   => "image is deleted:".$imagename
        ]);
    }

    public function deleteimageGallery(Request $request){

        $hotel=Hotel::find($request->id);
        $images = explode(",", $hotel->gallery);
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

        $imagename=public_path(IMAGES_HOTELS).'/'.$request->name;
        $hotel->gallery=$imggl;
        $hotel->save();
        File::delete($imagename);
        
        return response()->json([
            'message'   => $imggl,
            'uploaded_image' => $imggl
        ]);
    }


    
    

}
