<?php

namespace App\Services;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class WishlistMergeService
{
    /**
     * Merge guest wishlist from session to authenticated user's database wishlist
     *
     * @return void
     */
    public function mergeGuestWishlistToUser()
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return;
        }

        $userId = Auth::id();
        $guestWishlist = Session::get('wishlist', []);

        // If no guest wishlist, nothing to merge
        if (empty($guestWishlist)) {
            return;
        }

        $mergedCount = 0;
        $skippedCount = 0;

        foreach ($guestWishlist as $productId => $item) {
            // Check if this product is already in the user's wishlist
            $existingWishlist = Wishlist::where('user_id', $userId)
                ->where('product_id', $productId)
                ->first();

            if (!$existingWishlist) {
                // Add to database
                try {
                    Wishlist::create([
                        'user_id' => $userId,
                        'product_id' => $productId,
                    ]);
                    $mergedCount++;
                } catch (\Exception $e) {
                    Log::error('Wishlist merge error', [
                        'user_id' => $userId,
                        'product_id' => $productId,
                        'error' => $e->getMessage()
                    ]);
                }
            } else {
                $skippedCount++;
            }
        }

        // Clear session wishlist after merge
        Session::forget('wishlist');

        // Log the merge activity
        Log::info('Wishlist merged', [
            'user_id' => $userId,
            'merged' => $mergedCount,
            'skipped' => $skippedCount,
            'total' => count($guestWishlist)
        ]);
    }

    /**
     * Get total wishlist count for current user (session + database)
     *
     * @return int
     */
    public function getTotalWishlistCount()
    {
        $count = 0;

        // Count session wishlist for guests
        if (!Auth::check()) {
            $guestWishlist = Session::get('wishlist', []);
            $count = count($guestWishlist);
        } else {
            // Count database wishlist for authenticated users
            $count = Wishlist::where('user_id', Auth::id())->count();
        }

        return $count;
    }
}
