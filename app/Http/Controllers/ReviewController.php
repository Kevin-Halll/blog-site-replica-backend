<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\User;
use Illuminate\Http\Request;

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

        if( $reviews == null){
            $review = Review::create([
                "user_id" => $request->user_id,
                "company_id" => $request->company_id,
                "star_rating" => $request->star_rating, 
                "title" => $request->title,
                "content" => $request->content
            ]);

            return [ $review, ["message" => "Review saved successfully", 
                    "Status" => 500]];
        }
        
        return (["message" => "Review alreay exists"]);
        
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

        if( $review != null){
         return [$review, (["message" => "Sucess", "status" => 200])];
        } 

        return (["message" => "Review not founf", "status" => 404]);
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

        if( $review != null){
            // $review->user_id = $review->user_id;
            // $review->company_id = $review->company_id; 
            $review->star_rating = $request->star_rating;
            $review->title = $request->title;
            $review->content = $request->content;

            $review->save();

            return [$review, (["message" => "success", "status" => 200])];
        }

        return(["message" => "No review found", "status" => 404]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
