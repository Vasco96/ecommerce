<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FlashSaleItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FlashSaleController extends Controller
{
    function index(FlashSaleItemDataTable $dataTable) : View|JsonResponse
    {
        $flashSaleDate = FlashSale::first();
        return $dataTable->render('admin.flash-sale.index', compact('flashSaleDate'));
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
}
