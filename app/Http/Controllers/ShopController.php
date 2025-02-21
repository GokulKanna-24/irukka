<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use App\Models\ShopDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // Get search query from request
        $search = $request->input('search');

        // Fetch shops with their details
        $query = Shop::with('details')->where('delete_flag', 0);

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
        $user = Auth::user(); // Get the authenticated user
        if($user->role == 'admin') {
            $shops = $query->get();
            return view('shops.index', compact('shops', 'user'));
        } elseif ($user->role == 'owner') {
            $shops = $query->whereHas('details', function ($query) use ($user) {
                $query->where('owner_id', $user->id);
            })->where('is_active', '=', 1)->get();
            return view('shops.index', compact('shops', 'user'));
        } else {
            return "Un Autherized";
        }
    }
    public function create()
    {
        $user = Auth::user(); // Get the authenticated user
        if($user->role == 'admin') {
            $owners = User::where('role', 'owner')->get(); // Fetch users with role 'owner'
            return view('shops.create', compact('user', 'owners'));
        } else {
            return "Un Autherized";
        }
    }
    public function store(Request $request)
    {

        $shop = Shop::create($request->only(['name', 'alise_name', 'is_open', 'is_active']));

        // Handle file uploads safely
        $banner_img = $request->hasFile('banner_img') ? base64_encode(file_get_contents($request->file('banner_img')->path())) : null;
        $logo_img = $request->hasFile('logo_img') ? base64_encode(file_get_contents($request->file('logo_img')->path())) : null;
        $shop_img = $request->hasFile('shop_img') ? base64_encode(file_get_contents($request->file('shop_img')->path())) : null;

        ShopDetail::create(array_merge($request->only(['adress_line1', 'adress_line2', 'owner_id', 'start_time', 'end_time', 'is_active']), [
            'shop_id' => $shop->id,
            'banner_img' => $banner_img,
            'logo_img' => $logo_img,
            'shop_img' => $shop_img
        ]));

        return redirect()->route('shops.index');
    }
    public function edit(Shop $shop)
    {
        $user = Auth::user(); // Get the authenticated user
        if($user->role == 'admin') {
            $owners = User::where('role', 'owner')->get(); // Fetch users with role 'owner'
            return view('shops.edit', compact('shop', 'user', 'owners'));
        } else {
            return "Un Autherized";
        }
    }

    public function update(Request $request, Shop $shop)
    {
        // Update Shop Basic Details
        $shop->update($request->only(['name', 'alise_name', 'is_open', 'is_active']));

        // Prepare Shop Details Update
        $shopDetailsData = $request->only(['adress_line1', 'adress_line2', 'owner_id', 'start_time', 'end_time', 'is_active']);

        // Handle File Uploads (Convert to Base64)
        if ($request->hasFile('banner_img')) {
            $shopDetailsData['banner_img'] = base64_encode(file_get_contents($request->file('banner_img')->path()));
        }
        if ($request->hasFile('logo_img')) {
            $shopDetailsData['logo_img'] = base64_encode(file_get_contents($request->file('logo_img')->path()));
        }
        if ($request->hasFile('shop_img')) {
            $shopDetailsData['shop_img'] = base64_encode(file_get_contents($request->file('shop_img')->path()));
        }

        // Update Shop Details
        $shop->details->update($shopDetailsData);

        return redirect()->route('shops.index')->with('success', 'Shop updated successfully!');
    }
    public function destroy(Shop $shop)
    {
        $shop->update(['delete_flag' => 1]);
        return redirect()->route('shops.index');
    }

    public function show(Shop $shop)
    {
        $shop->load('details', 'details.owner'); // Load relations
        return view('shops.show', compact('shop'));
    }

    public function list(Request $request)
    {
        // Get search query from request
        $search = $request->input('search');

        // Fetch shops with their details
        $query = Shop::with('details')->where('delete_flag', 0);

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

        $shops = $query->get();
        return view('shops.list', compact('shops'));
    }

    public function toggleStatus(Request $request, Shop $shop)
    {
        // Ensure only the owner can update status
        if (Auth::user()->role !== 'owner' || Auth::user()->id !== $shop->details->owner_id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $shop->is_open = $request->is_open;
        $shop->save();

        return response()->json(['success' => true, 'message' => 'Shop status updated successfully']);
    }

    public function site()
    {
        $shops = Shop::with('details')->where('delete_flag', 0)->get();
        return view('site', compact('shops')); // Passing shops data to the site view
    }
}
