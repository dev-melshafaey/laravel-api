<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Validator;

class ItemsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $items = Item::all();
        return response()->json($items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
                    'title' => "required",
                    "body" => "required"
        ]);

        if ($validator->fails()) {
            $response = array('success' => FALSE, 'message' => $validator->messages());
            return $response;
        } else {
            $item = new Item;
            $item->title = $request->input('title');
            $item->body = $request->input('body');
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
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
                    'title' => 'required',
                    'body' => 'required',
        ]);

        if ($validator->fails() || !$id) {
            $response = array('success' => FALSE, 'message' => $validator->messages());
            return $response;
        } else {
            $item = new Item;
            $data['title'] = $request->input('title');
            $data['body'] = $request->input('body');

            $item->where('id', $id)->update($data);
            return response()->json($item);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        if ($id) {
            $item = Item::find($id);
            $item->delete();
            $response = array('success' => TRUE, 'message' => 'delete successfully!');
            return $response;
        }
        $response = array('success' => FALSE, 'message' => 'no valid id');
        return $response;
    }

}
