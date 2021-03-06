<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReviewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReviewRequest $request)
    {
        $reviews = Review::where('user_id', $request->user_id)->where('company_id', $request->company_id)->first();

        // dd($reviews);

        if ($reviews == null) {
            $review = Review::create([
                "user_id" => $request->user_id,
                "company_id" => $request->company_id,
                "star_rating" => $request->star_rating,
                "title" => $request->title,
                "content" => $request->content
            ]);

            return success($review);
        }

        return error("Review alreay exists");

        // $data = $request->all();

        // Review::where('user_id', $request->user_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review, $id)
    {
        $review = Review::find($id);

        if ($review != null) {
            return success($review);
        }

        return error("Review not found");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReviewRequest  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReviewRequest $request, Review $review, $id)
    {
        $review = Review::find($id);

        if ($review != null) {
            // $review->user_id = $review->user_id;
            // $review->company_id = $review->company_id;
            $review->star_rating = $request->star_rating;
            $review->title = $request->title;
            $review->content = $request->content;

            $review->save();

            return success($review);
        }

        return error("No review found");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function delete(Review $review, $id)
    {
        $review = Review::find($id);

        if ($review != null) {
            $review->delete();
            return success([], "Review deleted");
        }

        return error("Review not found");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review, $id)
    {
        $review = Review::find($id);

        if ($review != null) {
            Review::destroy($id);
            return success([], "Review deleted succesfully");
        } else {
            return error("No review found");
        }
    }
}
