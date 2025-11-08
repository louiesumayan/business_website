<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $slider = Slider::findOrFail(1);
        return view('admin.partial.slider.get_slider', compact('slider'));
    }
    // end method

    public function update(Request $request)
    {
        $slider = Slider::findOrFail(1);

        $sliderData = $request->validate([
            'title' => 'max:50',
            'description' => 'max:150',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'max:150',
        ]);

        // Handle photo upload only if there's a new file
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/assets/upload'), $imageName);
            $sliderData['photo'] = $imageName;

            // Optional: delete the old photo
            if ($slider->photo && file_exists(public_path('backend/assets/upload/' . $slider->photo))) {
                unlink(public_path('backend/assets/upload/' . $slider->photo));
            }
        }

        $slider->update($sliderData);

        $notification = [
            'message' => 'Slider updated successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->route('get.slider')->with($notification);
    }
    // end method

    public function editSlider(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);

        if ($request->has('title')) {
            $slider->title = $request->title;
        }
        if ($request->has('description')) {
            $slider->description = $request->description;
        }

        $slider->save();
        return response()->json(['success' => true]);
    }
    // end method

}
