<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FlashSaleItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FlashSaleController extends Controller
{
    function index(FlashSaleItemDataTable $dataTable) : View|JsonResponse
    {
        $flashSaleDate = FlashSale::first();
        $flashSaleItems = FlashSaleItem::all();
        $products = Product::where('is_approved' , 1)->where('status', 1)->orderBy('id', 'DESC')->get();
        return $dataTable->render('admin.flash-sale.index', compact('flashSaleDate','products'));
    }

    function update(Request $request)
    {
        $request->validate([
            'end_date' => ['required']
        ]);

        FlashSale::updateOrCreate(
            ['id' => 1],
            ['end_date' => $request->end_date],
        );

        toastr('Flash Sale Date Updated Successfully!', 'success');

        return redirect()->route('admin.flash-sale.index');
    }

    function addProduct(Request $request)
    {
        $request->validate([
            'product' => ['required', 'unique:flash_sale_items,product_id'],
            'show_at_home' => ['required'],
            'status' => ['required']
        ],[
            'product.unique' => 'The product is already in flash sale!'
        ]);

        $flashSaleDate = FlashSale::first();

        $flashSaleItem = new FlashSaleItem();
        $flashSaleItem->product_id = $request->product;
        $flashSaleItem->flash_sale_id = $flashSaleDate->id;
        $flashSaleItem->show_at_home = $request->show_at_home;
        $flashSaleItem->status = $request->status;
        $flashSaleItem->save();

        toastr('Flash Sale Item Created Successfully!', 'success');

        return redirect()->route('admin.flash-sale.index');
    }

    public function destroy(string $id)
    {
        try {
            $flashSaleItem = FlashSaleItem::findOrFail($id);
            $flashSaleItem->delete();
            return response(['status' => 'success', 'message' => 'Flash Sale Item Deleted Successfully']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'Something went wrong']);
        }
    }

    public function changeStatus(Request $request){
        try {
        $flashSaleItem = FlashSaleItem::findOrFail($request->id);
        $flashSaleItem->status = $request->status == 'true' ? 1 : 0;
        $flashSaleItem->save();

        return response(['status' => 'success', 'message' => 'Status has been updated!']);
        }catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'Something went wrong']);
        }
    }

    public function changeShowAtHome(Request $request){
        try {
        $flashSaleItem = FlashSaleItem::findOrFail($request->id);
        $flashSaleItem->show_at_home = $request->status == 'true' ? 1 : 0;
        $flashSaleItem->save();

        return response(['status' => 'success', 'message' => 'Show At Home has been updated!']);
        }catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'Something went wrong']);
        }
    }
}
