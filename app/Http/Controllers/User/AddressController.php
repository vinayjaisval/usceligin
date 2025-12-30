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
    public function store(Request $request)
    {
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

        // Check address limit (max 3 per user)
        if (Address::where('user_id', Auth::id())->count() >= 3) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'error' => 'You can only save up to 3 addresses.'], 422);
            }
            return back()->with('error', 'You can only save up to 3 addresses.');
        }

        $validated['user_id'] = Auth::id();
        $validated['country'] = 'India';
        $validated['is_default'] = $request->has('is_default') ? true : false;

        // If this is set as default, unset all other defaults
        if ($validated['is_default']) {
            Address::where('user_id', Auth::id())->update(['is_default' => false]);
        }

        // If this is the user's first address, make it default automatically
        if (Address::where('user_id', Auth::id())->count() === 0) {
            $validated['is_default'] = true;
        }

        $address = Address::create($validated);

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

        // If this is set as default, unset all other defaults
        if ($validated['is_default']) {
            Address::where('user_id', Auth::id())->where('id', '!=', $id)->update(['is_default' => false]);
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
        // First, unset all defaults for this user
        Address::where('user_id', Auth::id())->update(['is_default' => false]);

        // Then set this address as default
        $address = Address::where('user_id', Auth::id())->findOrFail($id);
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
