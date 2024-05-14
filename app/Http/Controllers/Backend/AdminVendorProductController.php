<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AdminVendorPendingProductDataTable;
use App\DataTables\AdminVendorProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminVendorProductController extends Controller
{
    function index(AdminVendorProductDataTable $dataTable): View|JsonResponse
    {
        return $dataTable->render('admin.product.vendor-product.index');
    }

    function pendingProducts(AdminVendorPendingProductDataTable $dataTable): View|JsonResponse
    {
        return $dataTable->render('admin.product.vendor-pending-product.index');
    }

    function changeApproveStatus(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->is_approved = $request->value;
        $product->save();

        return response(['message' => 'Product Approve Status Has Been Changed']);
    }
}
