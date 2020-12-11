<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Baging;
use App\BagingDetails;
use App\Docate;
use App\City;
use App\ManifestDetails;
class BagingController extends Controller
{
    public function bagingList(){
        $branches = User::where('user_role',3)->get();
        return view('admin.outbound.baging_list',compact('branches'));
    }

    public function bagingListAjax(Request $request){
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
        $branch_id = $request->get('branch_id');
        $baging = Baging::OrderBy('id','desc');
        if (!empty($start_date) && !empty($end_date)) {
            $baging->whereDate('created_at','>=', $start_date)
                ->whereDate('created_at','<=', $end_date);
        }
        if ($branch_id) {
            $baging->where('branch_id',$branch_id);
        }
            return datatables()->of($baging->get())
            ->addIndexColumn()
            ->addColumn('origin', function ($baging) {
                return isset($baging->originName->name)?$baging->originName->name:'';
            })->addColumn('destination', function ($baging) {
                return isset($baging->destinationName->name)?$baging->destinationName->name:'';
            })->addColumn('manifest_id', function ($baging) {
                return isset($baging->manifest->manifest_no)?$baging->manifest->manifest_no:'';
            })->addColumn('total_no_of_docates', function ($baging) { 
                
                return isset($baging->docatesCount)?$baging->docatesCount->count():'';
            })->addColumn('branch', function ($baging) { 
                return $baging->branch->name;
            })->addColumn('date', function ($baging) { 
                return $baging->created_at->format('d/m/y');
            })->addColumn('action', function ($baging){
                if($baging){
                    $btn = '<a href="' . route('admin.view_baging', ['id' => $baging->id]) . '" class="btn btn-info btn-sm" target="_blank">View</a>';
                    if($baging->sectorBookedCount()==0){
                        $btn .= '<a href="' . route('admin.delete_baging', ['id' => $baging->id]) . '" class="btn btn-danger" >Delete</a>';
                        $btn .= '<a href="' . route('admin.baging_edit_form', ['id' => $baging->id]) . '" class="btn btn-primary" target="_blank">Edit</a>';
                    }
                    
                    return $btn;
                    }else{
                        return null;
                    }
            })->rawColumns(['action','manifest_id', 'date','origin','branch','total_no_of_docates', 'destination'])
            ->make(true);
    }

    public function deleteBaging($id){
        $baging = Baging::where('id',$id)->first();
        $docates = Docate::where('baging_id',$baging->id)->get();
       
        foreach($docates as $docate){
            if($docate->courier_status ==3){
                $docate->courier_status = 2;
                $docate->status = 2;
                $docate->baging_id = null;
                $docate->save();
                $manifest_details = ManifestDetails::where('manifest_id',$docate->manifest_id)->where('docate_id',$docate->id)->first();
                $manifest_details->status = 1;
                $manifest_details->save();
                $baging_details = BagingDetails::where('baging_id',$id)->where('docate_id',$docate->id)->delete();
            }
            $baging->delete();
        }
        return redirect()->back();
    }

    public function editBagingForm($id){
        $city = City::get();
        $baging = Baging::where('id',$id)->first();
        $manifest_items = ManifestDetails::where('manifest_id',$baging->manifest->id)->get();
        return view('admin.outbound.baging_edit_form',compact('city','baging','manifest_items'));

    }

    public function docateOperation($docate_id,$baging_id,$status){
        $baging = Baging::where('id',$baging_id)->first();
        if($status ==1){
            $docate = Docate::where('id',$docate_id)->first();
            $docate->baging_id = null;
            $docate->status =2;
            $docate->courier_status = 2;
            if($docate->save()){
                $baging_details = BagingDetails::where('baging_id',$baging_id)->where('docate_id',$docate->id)->delete();
              
                $manifest_details = ManifestDetails::where('docate_id',$docate_id)->where('manifest_id',$baging->manifest_id)->first();
                $manifest_details->status = 1;
                $manifest_details->save();
            }

        }else{

            $docate =  Docate::where('id',$docate_id)->first();
            $docate->status = 3;
            $docate->courier_status = 3;
            $docate->baging_id = $baging_id;
            if($docate->save()){
                $baging_details = new BagingDetails();
                $baging_details->baging_id = $baging_id;
                $baging_details->docate_id = $docate->id;
                $baging_details->status =1;
                $baging_details->save();

                $manifest_details = ManifestDetails::where('docate_id',$docate_id)->where('manifest_id',$baging->manifest_id)->first();
                $manifest_details->status = 2;
                $manifest_details->save();
            }

        }

        return 1;

    }

    public function updateBaging(Request $request,$baging_id){
        $this->validate($request, [
            'origin'=>'required|numeric',
            'destination'   => 'required|numeric',
            'lock_no'   => 'required'
        ]);

        $baging =  Baging::where('id',$baging_id)->first();
        $baging->lock_no = $request->input('lock_no');
        $baging->origin = $request->input('origin') ;
        $baging->destination = $request->input('destination');
        $baging->save();

        if($baging){
            return redirect()->back()->with('message','Baging Details Updated  Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong!');
        }
    }

    public function viewBaging($id){
        $baging_details = BagingDetails::where('baging_id',$id)->get();
        return view('admin.outbound.baging_details',compact('baging_details'));
    }
}
