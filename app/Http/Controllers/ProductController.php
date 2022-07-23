<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;

class ProductController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:100',
            'price' => 'required|numeric',
            'type' => 'required|in:makanan,minuman,makeup',
            'expired_at' => 'required|date'
        ]);

        if($validator->fails()) {
            return response()->json($validator->messages())->setStatusCode(422);
        }


        $validated = $validator->validate();

        product::create([
            'name' => $validated['name'],
            'prince' => $validated['price'],
            'type' => $validated['type'],
            'expired_at' => $validated['expired_at']
        ]);

        return response()->json('produk berhasil disimpan')->setStatusCode(201);
    }
}
