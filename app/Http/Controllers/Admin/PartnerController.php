<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Partner;
class PartnerController extends Controller
{
    public function deliveryExecutiveList(){
        return view('admin.delivery_executive_list');
    }

    public function deliveryExecutiveListAjax(Request $request)
    {
        return datatables()->of(Partner::where('partner_type',1)->get())
            ->addIndexColumn()
            ->addColumn('bike',function($row){
                if($row->bike == 1){
                    return 'mini van';
                }elseif($row->bike ==2){
                    return 'lcv truck';
                }else{
                    return 'cycle';
                }

            })->addColumn('freight_type',function($row){
                $data = '';
              
                foreach($row->partnerFreight as $freight){
                   
                    $data .=$freight->Freight->name.',';
                    
                }

                return $data;

            })->rawColumns(['bike'])
            ->make(true);
    }

    public function franchiseList(){
        return view('admin.franchise_list');
    }

    public function franchiseListAjax(Request $request)
    {
        return datatables()->of(Partner::where('partner_type',2)->get())
        ->addIndexColumn()
        ->addColumn('bike',function($row){
            if($row->bike == 1){
                return 'mini van';
            }elseif($row->bike ==2){
                return 'lcv truck';
            }else{
                return 'cycle';
            }

        })->addColumn('freight_type',function($row){
            $data = '';
          
            foreach($row->partnerFreight as $freight){
               
                $data .=$freight->Freight->name.',';
            }
           

            return $data;

        })->rawColumns(['bike'])
        ->make(true);
    }
    
}
