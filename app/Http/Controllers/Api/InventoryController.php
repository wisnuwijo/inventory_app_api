<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Inventory;
use PDF;

class InventoryController extends Controller
{
    public function show_list()
    {
        $inventory = Inventory::all();

        return response([
            'msg' => 'Success',
            'code' => 200,
            'data' => $inventory
        ]);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'stock' => 'required',
            'unit' => 'required',
            'note' => '',
        ]);

        if ($validator->fails()) {
            return response([
                'msg' => 'Bad request',
                'code' => 400
            ], 400);
        }

        // Retrieve the validated input...
        $validated = $validator->validated();
        $validated = $validator->safe()->only([
            'name', 
            'stock',
            'unit',
            'note'
        ]);

        $imagePath = null;
        if (!is_null($request->file('image'))) {
            $imagePath = $request->file('image')->store('public/uploads');
        }
        
        $insert = Inventory::insert([
            'name' => $validated['name'],
            'stock' => $validated['stock'],
            'unit' => $validated['unit'],
            'image' => $imagePath,
            'note' => $validated['note']
        ]);

        if (!$insert) {
            return response([
                'msg' => 'Error, something wrong happen',
                'code' => 500
            ], 500);
        }

        return response([
            'msg' => 'Success',
            'code' => 200
        ]);
    }

    public function detail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response([
                'msg' => 'Bad request',
                'code' => 400
            ], 400);
        }

        // Retrieve the validated input...
        $validated = $validator->validated();
        $validated = $validator->safe()->only([
            'id'
        ]);

        $inventory = Inventory::find($validated['id']);
        if (isset($inventory) && $inventory->image != null) {
            $fullUrl = url('/');
            $splitUrl = explode('/', $fullUrl);
            array_pop($splitUrl);
            $mainUrl = implode('/', $splitUrl);
            $inventory->image = $mainUrl . '/storage/app/' . $inventory->image;
        }

        return response([
            'msg' => 'Success',
            'code' => 200,
            'data' => $inventory
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'stock' => 'required',
            'unit' => 'required'
        ]);

        if ($validator->fails()) {
            return response([
                'msg' => 'Bad request',
                'code' => 400
            ], 400);
        }

        // Retrieve the validated input...
        $validated = $validator->validated();
        $validated = $validator->safe()->only([
            'id',
            'name',
            'stock',
            'unit'
        ]);

        $inventory = Inventory::find($validated['id']);
        if (isset($inventory)) {
            $imagePath = $inventory->image;
            if (!is_null($request->file('image'))) {
                $imagePath = $request->file('image')->store('public/uploads');
            }

            $inventory->update([
                'name' => $validated['name'],
                'stock' => $validated['stock'],
                'unit' => $validated['unit'],
                'image' => $imagePath
            ]);
        }

        return response([
            'msg' => 'Success',
            'code' => 200
        ]);
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response([
                'msg' => 'Bad request',
                'code' => 400
            ], 400);
        }

        // Retrieve the validated input...
        $validated = $validator->validated();
        $validated = $validator->safe()->only(['id']);

        $delete = Inventory::find($validated['id'])->delete();
        return response([
            'msg' => 'Success',
            'code' => 200
        ]);
    }

    public function export_pdf()
    {
        $inventory = Inventory::all();
        
        view()->share('inventory', $inventory);
        $pdf = PDF::loadView('report.pdf_view', $inventory);

        return $pdf->stream('pdf_file.pdf');
    }
}
