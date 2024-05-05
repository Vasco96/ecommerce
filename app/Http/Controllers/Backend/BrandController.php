<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BrandDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BrandController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(BrandDataTable $dataTable) : View|JsonResponse
    {
        return $dataTable->render('admin.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'logo' => ['required', 'image', 'max:2000'],
            'name' => ['string', 'max:200'],
            'show_at_home' => ['required'],
            'status' => ['required'],
        ]);

        $brand = new Brand();

        /** Handle File Upload */
        $imagePath = $this->uploadImage($request, 'logo', 'uploads');

        $brand->logo = $imagePath;
        $brand->name = $request->name;
        $brand->slug = generateUniqueSlug('Brand', $request->name);;
        $brand->show_at_home = $request->show_at_home;
        $brand->status = $request->status;
        $brand->save();

        toastr('Brand Created Successfully!', 'success');

        return redirect()->route('admin.brand.index');;
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
    public function edit(string $id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'logo' => ['nullable', 'image', 'max:2000'],
            'name' => ['string', 'max:200'],
            'show_at_home' => ['required'],
            'status' => ['required'],
        ]);

        $brand = Brand::findOrFail($id);

        /** Handle File Upload */
        $imagePath = $this->updateImage($request, 'logo', 'uploads', $brand->logo);

        $brand->logo = empty(!$imagePath) ? $imagePath : $brand->logo;
        $brand->name = $request->name;
        $brand->slug = generateUniqueSlug('Brand', $request->name);;
        $brand->show_at_home = $request->show_at_home;
        $brand->status = $request->status;
        $brand->save();

        toastr('Brand Updated Successfully!', 'success');

        return redirect()->route('admin.brand.index');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $brand = Brand::findOrFail($id);
            $this->deleteImage($brand->logo);
            $brand->delete();
            return response(['status' => 'success', 'message' => 'Brand Deleted Successfully']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'Something went wrong']);
        }
    }

    public function changeStatus(Request $request){
        try {
        $brand = Brand::findOrFail($request->id);
        $brand->status = $request->status == 'true' ? 1 : 0;
        $brand->save();

        return response(['status' => 'success', 'message' => 'Status has been updated!']);
        }catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'Something went wrong']);
        }
    }
}
