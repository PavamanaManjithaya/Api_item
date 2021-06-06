<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Validator;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items=Item::all();
        return response()->json($items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'text'=>'required'
        ]);
        if($validator->fails()){
            $response=array('response'=>$validator->messeges(),'success'=>false);
            return $response;
        }else{
         //create
         $item=new Item;
         $item->text=$request->input('text');
         $item->body=$request->input('body');
         $item->save();

         return response()->json($item);


        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $items=Item::find($id);
        return response()->json($items);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $validator=Validator::make($request->all(),[
            'text'=>'required'
        ]);
        if($validator->fails()){
            $response=array('response'=>$validator->messeges(),'success'=>false);
            return $response;
        }else{
         //Update
         $item=Item::find($id);
         $item->text=$request->input('text');
         $item->body=$request->input('body');
         $item->save();

         return response()->json($item);
    }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item=Item::find($id);
        $item->delete();
        $response=array('response'=>'Item Delted','success'=>'true');
        return $response;
    }
}
