<?php

namespace App\Http\Controllers;

use App\Wish;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Voyager;

class WishController extends Controller
{
    public function publish(Wish $wish) {
        $this->authorize('publish', $wish);

        $wish->published_at = Carbon::now();
        $wish->save();

        return redirect()->back()->with(['message' => "Wunsch ist nun publiziert", 'alert-type' => 'success']);
    }

    public function unpublish(Wish $wish) {
        $this->authorize('unpublish', $wish);

        $wish->published_at = null;
        $wish->save();

        return redirect()->back()->with(['message' => "Wunsch ist nun unveröffentlicht", 'alert-type' => 'success']);
    }
}
