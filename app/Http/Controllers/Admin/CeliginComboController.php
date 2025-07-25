<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CeliginCombo;
use Datatables;

class CeliginComboController extends Controller
{
    public function datatables(Request $request)
    {
        $data = CeliginCombo::orderBy('id', 'desc')->get();
        return Datatables::of($data)
            ->addColumn('category_name', function (CeliginCombo $data) {
                $cats = \App\Models\Category::whereIn('id', explode(',', $data->category_id))->pluck('name');
                return $cats->implode(', ');
            })
            ->addColumn('product_name', function (CeliginCombo $data) {
                $prods = \App\Models\Product::whereIn('id', explode(',', $data->product_id))->pluck('name');
                $html = '<ul><li>' . $prods->implode('</li><li>') . '</li></ul>';
                return $html;
            })
            ->addColumn('action', function (CeliginCombo $data) {
                return '<div class="action-list"><a href="' . route('admin-celigin-combo-edit', $data->id) . '"> <i class="fas fa-edit"></i>' . __('Edit') . '</a>
                <a href="javascript:;" data-href="' . route('admin-celigin-combo-delete', $data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
            })
            ->rawColumns(['product_name', 'action'])
            ->toJson();
    }
    public function index()
    {
        return view('admin.product.celigin-combo.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.celigin-combo.create', [
            'products' => \App\Models\Product::where('status',1)->Select('name','id')->get(),
            'categories' => \App\Models\Category::where('status',2)->Select('name','id','slug')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|integer',
            'product_id' => 'required|array',
            'status' => 'required|integer',
        ]);
        $celiginCombo = new CeliginCombo();
        $celiginCombo->category_id = $validatedData['category_id'];
        $celiginCombo->product_id = implode(',', $validatedData['product_id']);
        $celiginCombo->status = $validatedData['status'];
        $celiginCombo->save();
        return redirect()->route('cosmatic-combo')->with('success', 'Celigin Combo created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = CeliginCombo::findOrFail($id);
        return view('admin.product.celigin-combo.edit', [
            'data' => $data,
            'products' => \App\Models\Product::where('status',1)->Select('name','id')->get(),
            'categories' => \App\Models\Category::where('status',2)->Select('name','id','slug')->get(),
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|integer',
            'product_id' => 'required|array',
            'status' => 'required|integer',
        ]);
        $celiginCombo = CeliginCombo::findOrFail($id);
        $celiginCombo->category_id = $validatedData['category_id'];
        $celiginCombo->product_id = implode(',', $validatedData['product_id']);
        $celiginCombo->status = $validatedData['status'];
        $celiginCombo->save();
        return redirect()->route('cosmatic-combo')->with('success', 'Celigin Combo updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(CeliginCombo::where('id', $id)->exists()){
            CeliginCombo::destroy($id);
            $msg = __('Data Deleted Successfully.');
            return response()->json($msg);
        }
        return redirect()->route('cosmatic-combo')->with('error', 'Celigin Combo not found.'); 
    }
    
}

