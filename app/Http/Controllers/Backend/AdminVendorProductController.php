<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AdminVendorProductDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminVendorProductController extends Controller
{
    function index(AdminVendorProductDataTable $dataTable): View|JsonResponse
    {
        return $dataTable->render('admin.product.vendor-product.index');
    }
}
