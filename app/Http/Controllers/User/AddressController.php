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
            'type' => 'required|in:home,work,other',
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
            return back()->with('error', 'You can only save up to 3 addresses.');
        }

        $validated['user_id'] = Auth::id();
        $validated['country'] = 'India';
        $validated['is_default'] = $request->has('is_default') ? true : false;

        Address::create($validated);

        return back()->with('success', 'Address added successfully.');
    }

    /**
     * Update an existing address
     */
    public function update(Request $request, $id)
    {
        $address = Address::where('user_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'type' => 'required|in:home,work,other',
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

        $address->update($validated);

        return back()->with('success', 'Address updated successfully.');
    }

    /**
     * Delete an address
     */
    public function destroy($id)
    {
        $address = Address::where('user_id', Auth::id())->findOrFail($id);
        $address->delete();

        return back()->with('success', 'Address deleted successfully.');
    }

    /**
     * Set address as default
     */
    public function setDefault($id)
    {
        $address = Address::where('user_id', Auth::id())->findOrFail($id);
        $address->update(['is_default' => true]);

        return back()->with('success', 'Default address updated.');
    }
}
