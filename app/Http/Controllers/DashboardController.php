<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\ShopDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get search query from request
        $search = $request->input('search');
        $user = Auth::user();
        // Fetch shops with their details
        $query = Shop::with('details')->where('delete_flag', 0)->where('is_active', 1);

        if($user->role == 'user') {
            // Apply search filters if search query exists
            if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%") // Search by name
                    ->orWhere('alise_name', 'LIKE', "%{$search}%") // Search by alias
                    ->orWhereHas('details', function ($subQuery) use ($search) { 
                        $subQuery->where('adress_line1', 'LIKE', "%{$search}%")
                                ->orWhere('adress_line2', 'LIKE', "%{$search}%");
                    })
                    ->orWhere(function ($statusQuery) use ($search) {
                        if (strtolower($search) == 'open') {
                            $statusQuery->where('is_open', 1);
                        } elseif (strtolower($search) == 'closed') {
                            $statusQuery->where('is_open', 0);
                        }
                    });
                });
            }
        } elseif($user->role == 'owner') {
            $query->whereHas('details', function ($query) use ($user) {
                $query->where('owner_id', $user->id);
            });
        }


        $shops = $query->get();
         // Get the authenticated user
        return view('dashboard', compact('user', 'shops'));
    }
}
