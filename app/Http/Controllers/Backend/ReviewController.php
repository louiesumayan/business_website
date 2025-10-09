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
}
