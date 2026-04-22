<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
   
    // Public function home(){
    //  return view('page.civil');
    // }
     Public function home(){
        $data['title'] = "Civil Engineering Department";
        $data['email'] = "vibol@gmail.com";
     return view('page.civil', $data);
    }
    public function getData(Request $r){
        $name = $r->input('name');
        $phone= $r->input('phone');
        $email = $r->input('email');
        dd($name. "". $phone. "". $email);  
        // dd($r->all()); 
        // dd($r->input());
    }

    // week5
    public function ShowAvg(Request $r){
        $laravel = $r->laravel;
        $api = $r->api;
        $net = $r->net;
        $c_sab = $r->c_sab;
        $clin = $r->clin;
       $total = $laravel + $api + $net + $c_sab + $clin;
       $avg = $total / 5;
     dd("Total Score: ".$total. "Avg".$avg);
    }
}
