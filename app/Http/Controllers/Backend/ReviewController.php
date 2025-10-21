<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function AllReview()
    {
        // get the latest data from the DB
        $review = Review::latest()->get();

        // passing the data using compact method
        return view('admin.partial.review.all_review', compact('review'));
    }
    // end method

    public function AddReview()
    {
        return view('admin.partial.review.add_review');
    }
    //end method
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|max:50',
            'position' => 'required|max:50',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'review' => 'required'
        ]);

        $imageName = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('backend/assets/upload'), $imageName);

        Review::create([
            'name' => $validate['name'],
            'position' => $validate['position'],
            'photo' => $imageName,
            'review' => $validate['review']
        ]);

        $notification = array(
            'message' => 'Review added successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
    //end method


    public function UpdateReview($id)
    {
        $review = Review::findOrFail($id);
        return view('admin.partial.review.edit', compact('review'));
    }
    //end method


    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $validated = $request->validate([
            'name' => 'max:50',
            'position' => 'max:50',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'review' => 'max:150',
        ]);

        // Handle photo upload only if there's a new file
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/assets/upload'), $imageName);
            $validated['photo'] = $imageName;

            // Optional: delete the old photo
            if ($review->photo && file_exists(public_path('backend/assets/upload/' . $review->photo))) {
                unlink(public_path('backend/assets/upload/' . $review->photo));
            }
        }

        $review->update($validated);

        $notification = [
            'message' => 'Review updated successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->route('admin.review')->with($notification);
    }

    //end method

    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        // Delete the photo file if it exists
        if ($review->photo && file_exists(public_path('backend/assets/upload/' . $review->photo))) {
            unlink(public_path('backend/assets/upload/' . $review->photo));
        }

        $review->delete();

        $notification = [
            'message' => 'Review deleted successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
    //end method

}
