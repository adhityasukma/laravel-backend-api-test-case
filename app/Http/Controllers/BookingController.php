<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $check_available_borrowed = Booking::where('member_id', $request->member_id)->with(['book'])->count();
        $check_book_available_borrowed = Booking::where('book_id', $request->book_id)->with(['book'])->count();
        $checkIfPenalty = Member::where('id', $request->member_id)->first();

        if ($checkIfPenalty) {
            $currentDateTime = Carbon::now()->format("Y-m-d");
            if (!is_null($checkIfPenalty['penalized'])) {
                $hasPenalty = Carbon::createFromFormat('Y-m-d H:i:s', $checkIfPenalty['penalized'])->format("Y-m-d");
                if (strtotime($currentDateTime) < strtotime($hasPenalty)) {
                    return response()->json(['message' => 'You have been penalized and cannot borrow books'], 403);
                }
            }
        }

        if ($check_available_borrowed >= 2) {
            return response()->json(['message' => 'Can not borrow more than 2 books'], 403);
        }
        if ($check_book_available_borrowed >= 1) {
            return response()->json(['message' => 'This book already has borrowed'], 403);
        }

        Booking::create([
            'book_id' => $request->book_id,
            'member_id' => $request->member_id,
            'penalized' => null,
        ]);
        Member::where('id', $request->member_id)->update([
            'penalized' => null,
        ]);
        return response()->json(['message' => 'Successfully borrowed book'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($booking)
    {
        $message = 'Failed returned the book';
        $error_code = 403;
        $get_booking_from_member = Booking::where('book_id', $booking)->with(['member'])->first();
        if ($get_booking_from_member) {
            $penalty_date = Carbon::now()->addDays(3);
            $book_date = Carbon::createFromFormat('Y-m-d H:i:s', $get_booking_from_member['created_at'])->addDays(7)->format("Y-m-d");

            $currentDateTime = Carbon::now()->format("Y-m-d");

            if (strtotime($currentDateTime) >= strtotime($book_date)) {
                Member::where('id', $get_booking_from_member->member->id)->update([
                    'penalized' => $penalty_date,
                ]);
            }

            $deleted = Booking::where('book_id', $booking)->delete();

            if ($deleted) {
                $message = 'Successfully returned the book.';
                $error_code = 200;
            }
        } else {
            $message = 'Invalid server';
        }
        return response()->json(['message' => $message], $error_code);
    }
}
