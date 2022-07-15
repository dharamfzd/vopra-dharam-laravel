<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Price;
use Illuminate\Support\Facades\Auth;

class PriceController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
            'price.*' => 'integer|nullable',
      ]);

      foreach ($request->price as $key=> $value ) {
         if ($value) {
           $data[] = [
             'user_id'     => Auth::id(),
             'price'       => $value,
             'field_id'    => $request->id[$key],
             'created_at'  =>  now(),
             'updated_at'  =>  now()
           ];
         }
      }

      if(!isset($data)) {
        return back()->with([
          'message' => 'Price not added! Minmum add one price.',
          'status' => 'danger'
        ]);
      }

      $prices = Price::insert($data);

      return back()->with([
        'message' => 'Price added successfully.',
        'status' => 'success'
      ]);

    }

}
