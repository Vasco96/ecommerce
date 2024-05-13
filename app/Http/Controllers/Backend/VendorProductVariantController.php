<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class VendorProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, VendorProductVariantDataTable $dataTable) : View|JsonResponse
    {
        $product = Product::findOrFail($request->product);
        if($product->vendor_id != Auth::user()->vendor->id){
            abort(404);
        }
        return $dataTable->render('vendor.product.variant.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('vendor.product.variant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product' => ['required', 'integer'],
            'name' => ['required', 'max:200'],
            'status' => ['required']
        ]);

        $productVariant = new ProductVariant();
        $productVariant->product_id = $request->product;
        $productVariant->name = $request->name;
        $productVariant->status = $request->status;
        $productVariant->save();

        toastr('Variant Created Successfully!', 'success');

        return redirect()->route('vendor.products-variant.index', ['product' => $request->product]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : View
    {
        $productVariant = ProductVariant::findOrFail($id);
        if($productVariant->product->vendor_id != Auth::user()->vendor->id){
            abort(404);
        }
        return view('vendor.product.variant.edit', compact('productVariant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'status' => ['required']
        ]);

        $productVariant = ProductVariant::findOrFail($id);
        if($productVariant->product->vendor_id != Auth::user()->vendor->id){
            abort(404);
        }
        $productVariant->name = $request->name;
        $productVariant->status = $request->status;
        $productVariant->save();

        toastr('Variant Updated Successfully!', 'success');

        return redirect()->route('vendor.products-variant.index', ['product' => $productVariant->product_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $productVariant = ProductVariant::findOrFail($id);
            if($productVariant->product->vendor_id != Auth::user()->vendor->id){
                abort(404);
            }
            $variantItemCheck = ProductVariantItem::where('product_variant_id', $productVariant->id)->count();
            if($variantItemCheck>0){
               return response(['status' => 'error', 'message' => 'This variant contain variant items, delete items first for delete this variant']);
            }
            $productVariant->delete();
            return response(['status' => 'success', 'message' => 'Variant Deleted Successfully']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'Something went wrong']);
        }
    }

    public function changeStatus(Request $request){
        try {
        $productVariant = ProductVariant::findOrFail($request->id);
        $productVariant->status = $request->status == 'true' ? 1 : 0;
        $productVariant->save();

        return response(['status' => 'success', 'message' => 'Status has been updated!']);
        }catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'Something went wrong']);
        }
    }
}
