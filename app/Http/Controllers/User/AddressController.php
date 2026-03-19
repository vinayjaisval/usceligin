<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Store a new address
     */
    // public function store(Request $request)
    // {



    //     $validated = $request->validate([
    //         'address_category' => 'nullable|in:delivery,billing',
    //         'type' => 'nullable|in:home,work,other',
    //         'name' => 'required|string|max:255',
    //         'phone' => 'required|string|max:15',
    //         'address_line_1' => 'required|string',
    //         'address_line_2' => 'nullable|string',
    //         'city' => 'required|string|max:100',
    //         'state' => 'required|string|max:100',
    //         'pincode' => 'required|digits:6',
    //         'is_default' => 'nullable|boolean',
    //     ]);

    //     // Determine address category (default to 'delivery')
    //     $category = $validated['address_category'] ?? null;
    //     $validated['address_category'] = $category;

    //     // Check address limit (max 3 per user per category)
    //     $existingCount = Address::where('user_id', Auth::id())
    //         ->where('address_category', $category)
    //         ->count();

    //     if ($existingCount >= 3) {
    //         $categoryLabel = $category === 'billing' ? 'billing' : 'delivery';
    //         if ($request->expectsJson()) {
    //             return response()->json(['success' => false, 'error' => "You can only save up to 3 {$categoryLabel} addresses."], 422);
    //         }
    //         return back()->with('error', "You can only save up to 3 {$categoryLabel} addresses.");
    //     }

    //     $validated['user_id'] = Auth::id();
    //     $validated['country'] = 'India';
    //     $validated['is_default'] = $request->has('is_default') ? true : false;

    //     // If this is set as default, unset all other defaults in the same category
    //     if ($validated['is_default']) {
    //         Address::where('user_id', Auth::id())
    //             ->where('address_category', $category)
    //             ->update(['is_default' => false]);
    //     }

    //     // If this is the user's first address in this category, make it default automatically
    //     if ($existingCount === 0) {
    //         $validated['is_default'] = true;
    //     }

    //     $address = Address::create($validated);

    //     if ($request->expectsJson()) {
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Address added successfully.',
    //             'address' => $address
    //         ]);
    //     }

    //     return back()->with('success', 'Address added successfully.');
    // }

    public function store(Request $request)
    {

   
        // ✅ Ensure user is logged in
        if (!Auth::check()) {
            return back()->with('error', 'Please login first.');
        }

        // ✅ Validation
        $validated = $request->validate([
            'address_category' => 'nullable|in:delivery,billing',
            'type' => 'nullable|in:home,work,other',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address_line_1' => 'required|string',
            'address_line_2' => 'nullable|string',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|digits:6',
            'is_default' => 'nullable|boolean',
        ]);

        // ✅ Default category (avoid NULL issue)
        $category = $validated['address_category'] ?? 'delivery';
        $validated['address_category'] = $category;

        // ✅ Attach user
        $validated['user_id'] = Auth::id();

        // ✅ Default values
        $validated['country'] = 'India';
        $validated['is_default'] = $request->has('is_default') ? true : false;

        // ✅ Max 3 addresses per category
        $existingCount = Address::where('user_id', Auth::id())
            ->where('address_category', $category)
            ->count();

        if ($existingCount >= 3) {
            $categoryLabel = $category === 'billing' ? 'billing' : 'delivery';

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => "You can only save up to 3 {$categoryLabel} addresses."
                ], 422);
            }

            return back()->with('error', "You can only save up to 3 {$categoryLabel} addresses.");
        }

        // ✅ If default selected → reset others
        if ($validated['is_default']) {
            Address::where('user_id', Auth::id())
                ->where('address_category', $category)
                ->update(['is_default' => false]);
        }

        // ✅ First address auto default
        if ($existingCount === 0) {
            $validated['is_default'] = true;
        }

        // ✅ Store safely (try-catch for DB errors)
        try {
            $address = Address::create($validated);
        } catch (\Exception $e) {

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }

        // ✅ Response
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Address added successfully.',
                'address' => $address
            ]);
        }

        return back()->with('success', 'Address added successfully.');
    }



    /**
     * Get address data for editing
     */
    public function edit($id)
    {
        $address = Address::where('user_id', Auth::id())->findOrFail($id);

        return response()->json([
            'success' => true,
            'address' => $address
        ]);
    }

    /**
     * Update an existing address
     */
    public function update(Request $request, $id)
    {
        $address = Address::where('user_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'type' => 'nullable|in:home,work,other',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address_line_1' => 'required|string',
            'address_line_2' => 'nullable|string',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|digits:6',
            'is_default' => 'nullable|boolean',
        ]);

        $validated['is_default'] = $request->has('is_default') ? true : false;

        // If this is set as default, unset all other defaults in the same category
        if ($validated['is_default']) {
            $category = $address->address_category ?? 'delivery';
            Address::where('user_id', Auth::id())
                ->where('address_category', $category)
                ->where('id', '!=', $id)
                ->update(['is_default' => false]);
        }

        $address->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Address updated successfully.',
                'address' => $address->fresh()
            ]);
        }

        return back()->with('success', 'Address updated successfully.');
    }

    /**
     * Delete an address
     */
    public function destroy(Request $request, $id)
    {

        $address = Address::where('user_id', Auth::id())->findOrFail($id);

        $address->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Address deleted successfully.'
            ]);
        }

        return back()->with('success', 'Address deleted successfully.');
    }

    /**
     * Set address as default
     */
    public function setDefault(Request $request, $id)
    {
        // Get the address to determine its category
        $address = Address::where('user_id', Auth::id())->findOrFail($id);
        $category = $address->address_category ?? 'delivery';

        // First, unset all defaults for this user in the same category
        Address::where('user_id', Auth::id())
            ->where('address_category', $category)
            ->update(['is_default' => false]);

        // Then set this address as default
        $address->update(['is_default' => true]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Default address updated.',
                'address' => $address->fresh()
            ]);
        }

        return back()->with('success', 'Default address updated.');
    }
}
