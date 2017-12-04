<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class AdminController extends Controller
{
     public function add_contact()
    {
       return view('addcontact');
    }
//all contact function are here
     public function all_contact()
    {
      $allcontacte_info=DB::table('tbl_contact')
                        ->get();
        
      $manage_contact=view('allcontact')
                      ->with('all_contact_info',$allcontacte_info);
      return view('layout')
                 ->with('allcontact',$manage_contact);
    }
//dashboard function are here
     public function dashboard()
    {
       return view('welcome');
    }
//CONTACT ADDED PART IN DATABASE
      public function save_contact(Request $request)
    {
       $data = array();
       $data['contact_name']=$request->contact_name;
       $data['contact_number']=$request->contact_number;
      
       DB::table('tbl_contact')->insert($data);
       Session::put('message','contact Added Successfully!!');
       return Redirect::to('/addcontact');
    }

  //delete contact part are here
    public function delete_contact($contact_id)
    {
       DB::table('tbl_contact')
                ->where('contact_id',$contact_id)
                ->delete();
       Session::put('message','Delete contact Successfully!!' );
       return Redirect::to('/allcontact');  
    }  

    //Edit contact part are here
    public function edit_contact($contact_id)
    {
       $contact_info=DB::table('tbl_contact')
                      ->where('contact_id',$contact_id)
                      ->first();   
              // echo "</pre>";
              // print_r($contact_info) ;       
              
       $manage_contact=view('contact_edit')
                      ->with('all_contact_info',$contact_info);
      return view('layout')
                 ->with('contact_edit',$manage_contact);
    }  

//contact update are here
     public function contact_update(Request $request,$contact_id)
    {  $data = array();
         $data['contact_name']=$request->contact_name;
         $data['contact_number']=$request->contact_number;
         DB::table('tbl_contact')
         ->where('contact_id',$contact_id)
         ->update($data);

      // echo "</pre>";
      // print_r($data);
      // echo "</pre>";
       Session::put('message','contact update Successfully!!' );
       return Redirect::to('/allcontact');
    }  

}
