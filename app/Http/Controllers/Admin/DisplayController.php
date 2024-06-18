<?php

namespace App\Http\Controllers\Admin;

use App\Models\Photo;
use App\Models\FooterLink;
use App\Traits\ImageHandler;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DisplayController extends Controller
{
    //
    use ImageHandler;

    
    public function index(){

        $logo = Photo::where('type', 'logo')->get()->first();
        $slides = Photo::where('type', 'slide')->get();
        $footerLinks = FooterLink::all();

        $viewData = [
            'logo' => $logo,
            'slides' => $slides,
            'footerLinks' => $footerLinks,
        ];

        return view('admin.display.index',$viewData);
    }

    public function creatrOrUpdateLogo(Request $request){

        $data = $request->all();

        $photo = Photo::where('type', $request->type)->get()->first();

        $imagePath = 0;
        if($photo){
            $imagePath = $photo->path;
        }
        
        if ($request->hasFile('path')) {
            $imagePath = $this->updateImage($request->file('path'), $imagePath, 'theme_admin/upload/photo');
        }
        // dd($imagePath);

        $photo = Photo::updateOrCreate(
            ['type' => $request->type],
            ['title' => $request->title, 'path' => $imagePath]
        );

        return redirect()->route('admin.display.index')->with(['success' => 'thay đổi logo thành công']);
    }

    

    public function createSlide()
    {
        //
        return view('admin.display.slide.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeSlide(Request $request)
    {
        //
        // dd($request->file('path'));
        try {
            $data = $request->except('path');
            $imagePath = $this->uploadImage($request->file('path'), 'theme_admin/upload/photo');
            $data['path'] = $imagePath ;
            $data['type'] = 'slide' ;
    
            $slide = Photo::create($data);

            return redirect()->route('admin.slide.index')->with(['success' => 'Thêm mới slide thành công']);

        } catch (Exception $ex) {
            Log::error("ERROR => slideController@store =>" . $ex->getMessage());
            return redirect()->back()->with(['error' => 'Thêm mới slide thất bại']);
        }

        return redirect()->back();

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function editSlide($id)
    {
        //
        $slide = Photo::findOrFail($id);
        return view('admin.display.slide.edit',compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateSlide(Request $request, $id)
    {
        try{

            $slide = Photo::findOrFail($id);
            $data = $request->except('path');
            $imagePath = $slide->path;
            if ($request->hasFile('path')) {
                $imagePath = $this->updateImage($request->file('path'), $slide->path, 'theme_admin/upload/slide');
            }
            $data['path'] = $imagePath ;


            $slide->update($data);

            return redirect()->back()->with(['success' => 'Cập nhật slide thành công']);

        } catch (Exception $ex) {
            Log::error("ERROR => slideController@store =>". $ex->getMessage());
            return redirect()->back()->with(['error' => 'Cập nhật slide thất bại']);
        }

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteSlide($id)
    {
        //
        try{

            $slide = Photo::findOrFail($id);
            $this->deleteImage($slide->path);
            $slide->delete();

            return redirect()->back()->with(['success' => 'Xóa slide thành công']);
        
        } catch (Exception $ex) {
            Log::error("ERROR => slideController@store =>". $ex->getMessage());
            return redirect()->back()->with(['error' => 'Xóa slide thất bại']);
        }

        return redirect()->back();
    }
    public function creatrOrUpdateFlink(Request $request){
        $request->validate([
            'subtitle.*' => 'required',
            // 'link.*' => 'required',
            'title.*' => 'required',
        ]);
    
        foreach ($request->subtitle as $index => $subtitle) {
            // $id = $request->ids[$index] ?? null;
            $link = $request->link[$index] ?? null;
            $title = $request->title[$index] ?? null;
    
            if ($subtitle && $title) {
                FooterLink::updateOrCreate(
                    ['subtitle' => $subtitle],
                    ['link' => $link, 'subtitle' => $subtitle, 'title' => $title]
                );
            }
        }

        return redirect()->route('admin.display.index')->with(['success' => 'cập nhật thành công']);

    }

    public function deleteFooter($id)
    {
        $footerLink = FooterLink::findOrFail($id);
        $footerLink->delete();

        return response()->json(['success' => true]);
    }

}
