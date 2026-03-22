<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Tests\TestCase;

/**
 * Multi-user scenario tests for Address CRUD operations.
 *
 * Uses a minimal in-memory SQLite schema to sidestep the broken migration
 * chain (products table has no base migration in this repo). Schema is
 * created fresh in setUp() and rows are cleaned in tearDown().
 *
 * Covers: store, edit, update, destroy, setDefault
 * Security: cross-user access prevention
 * Business rules: max 3 per category, auto-default, sticky default
 */
class AddressCrudTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->createTestSchema();
    }

    protected function tearDown(): void
    {
        DB::table('addresses')->delete();
        DB::table('users')->delete();
        parent::tearDown();
    }

    // ─── Minimal schema (only tables needed for address tests) ────────────────

    private function createTestSchema(): void
    {
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('users');

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->boolean('phone_verified')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('address_category', 20)->default('delivery');
            $table->string('type')->nullable()->default('home');
            $table->string('name');
            $table->string('phone', 15);
            $table->text('address_line_1');
            $table->text('address_line_2')->nullable();
            $table->string('city', 100);
            $table->string('state', 100);
            $table->string('pincode', 6);
            $table->string('country', 100)->default('India');
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });
    }

    // ─── Shared helpers ───────────────────────────────────────────────────────

    private function addressPayload(array $overrides = []): array
    {
        return array_merge([
            'address_category' => 'delivery',
            'type'             => 'home',
            'name'             => 'Test User',
            'phone'            => '9876543210',
            'address_line_1'   => '123 Main Street',
            'address_line_2'   => 'Apt 4B',
            'city'             => 'Mumbai',
            'state'            => 'Maharashtra',
            'pincode'          => '400001',
            'country'          => 'India',
            'is_default'       => false,
        ], $overrides);
    }

    private function makeUser(): User
    {
        return User::create([
            'name'     => 'User ' . uniqid(),
            'email'    => 'user_' . uniqid() . '@test.com',
            'password' => bcrypt('password'),
        ]);
    }

    private function makeAddress(User $user, array $overrides = []): Address
    {
        return Address::create(array_merge($this->addressPayload(), ['user_id' => $user->id], $overrides));
    }

    // ─── Authentication guard ─────────────────────────────────────────────────

    public function test_guest_cannot_store_address(): void
    {
        $response = $this->postJson('/user/addresses', $this->addressPayload());
        $response->assertUnauthorized();
    }

    public function test_guest_cannot_edit_address(): void
    {
        $user    = $this->makeUser();
        $address = $this->makeAddress($user);

        $response = $this->getJson("/user/addresses/{$address->id}/edit");
        $response->assertUnauthorized();
    }

    public function test_guest_cannot_delete_address(): void
    {
        $user    = $this->makeUser();
        $address = $this->makeAddress($user);

        $response = $this->deleteJson("/user/addresses/{$address->id}");
        $response->assertUnauthorized();
    }

    // ─── Store (POST /user/addresses) ─────────────────────────────────────────

    public function test_user_can_store_delivery_address(): void
    {
        $user = $this->makeUser();

        $response = $this->actingAs($user)
            ->postJson('/user/addresses', $this->addressPayload());

        $response->assertOk()->assertJsonFragment(['success' => true]);
        $this->assertDatabaseHas('addresses', [
            'user_id' => $user->id,
            'name'    => 'Test User',
            'pincode' => '400001',
        ]);
    }

    public function test_first_address_is_auto_set_as_default(): void
    {
        $user = $this->makeUser();

        $this->actingAs($user)->postJson('/user/addresses', $this->addressPayload(['is_default' => false]));

        $this->assertDatabaseHas('addresses', [
            'user_id'    => $user->id,
            'is_default' => true,
        ]);
    }

    public function test_user_can_store_billing_address(): void
    {
        $user = $this->makeUser();

        $response = $this->actingAs($user)
            ->postJson('/user/addresses', $this->addressPayload(['address_category' => 'billing']));

        $response->assertOk()->assertJsonFragment(['success' => true]);
        $this->assertDatabaseHas('addresses', [
            'user_id'          => $user->id,
            'address_category' => 'billing',
        ]);
    }

    public function test_store_validates_required_fields(): void
    {
        $user = $this->makeUser();

        $response = $this->actingAs($user)->postJson('/user/addresses', []);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'phone', 'address_line_1', 'city', 'state', 'pincode']);
    }

    public function test_store_validates_phone_must_be_10_digits(): void
    {
        $user = $this->makeUser();

        $response = $this->actingAs($user)
            ->postJson('/user/addresses', $this->addressPayload(['phone' => '12345']));

        $response->assertUnprocessable()->assertJsonValidationErrors(['phone']);
    }

    public function test_store_validates_pincode_must_be_6_digits(): void
    {
        $user = $this->makeUser();

        $response = $this->actingAs($user)
            ->postJson('/user/addresses', $this->addressPayload(['pincode' => '123']));

        $response->assertUnprocessable()->assertJsonValidationErrors(['pincode']);
    }

    // ─── Max 3 addresses per category ────────────────────────────────────────

    public function test_cannot_store_more_than_3_delivery_addresses(): void
    {
        $user = $this->makeUser();
        for ($i = 0; $i < 3; $i++) {
            $this->makeAddress($user, ['address_category' => 'delivery']);
        }

        $response = $this->actingAs($user)
            ->postJson('/user/addresses', $this->addressPayload(['address_category' => 'delivery']));

        $response->assertStatus(422)->assertJsonFragment(['success' => false]);
    }

    public function test_cannot_store_more_than_3_billing_addresses(): void
    {
        $user = $this->makeUser();
        for ($i = 0; $i < 3; $i++) {
            $this->makeAddress($user, ['address_category' => 'billing']);
        }

        $response = $this->actingAs($user)
            ->postJson('/user/addresses', $this->addressPayload(['address_category' => 'billing']));

        $response->assertStatus(422)->assertJsonFragment(['success' => false]);
    }

    public function test_billing_limit_does_not_affect_delivery_limit(): void
    {
        $user = $this->makeUser();
        for ($i = 0; $i < 3; $i++) {
            $this->makeAddress($user, ['address_category' => 'billing']);
        }

        $response = $this->actingAs($user)
            ->postJson('/user/addresses', $this->addressPayload(['address_category' => 'delivery']));

        $response->assertOk()->assertJsonFragment(['success' => true]);
    }

    // ─── Cross-user security ──────────────────────────────────────────────────

    public function test_user_a_cannot_edit_user_b_address(): void
    {
        $userA   = $this->makeUser();
        $userB   = $this->makeUser();
        $address = $this->makeAddress($userB);

        $response = $this->actingAs($userA)->getJson("/user/addresses/{$address->id}/edit");

        $response->assertNotFound();
    }

    public function test_user_a_cannot_update_user_b_address(): void
    {
        $userA   = $this->makeUser();
        $userB   = $this->makeUser();
        $address = $this->makeAddress($userB);

        $response = $this->actingAs($userA)
            ->putJson("/user/addresses/{$address->id}", $this->addressPayload(['name' => 'Hacked Name']));

        $response->assertNotFound();
        $this->assertDatabaseMissing('addresses', ['id' => $address->id, 'name' => 'Hacked Name']);
    }

    public function test_user_a_cannot_delete_user_b_address(): void
    {
        $userA   = $this->makeUser();
        $userB   = $this->makeUser();
        $address = $this->makeAddress($userB);

        $response = $this->actingAs($userA)->deleteJson("/user/addresses/{$address->id}");

        $response->assertNotFound();
        $this->assertDatabaseHas('addresses', ['id' => $address->id]);
    }

    public function test_user_a_cannot_set_default_on_user_b_address(): void
    {
        $userA   = $this->makeUser();
        $userB   = $this->makeUser();
        $address = $this->makeAddress($userB, ['is_default' => false]);

        $response = $this->actingAs($userA)->postJson("/user/addresses/{$address->id}/set-default");

        $response->assertNotFound();
        $this->assertDatabaseHas('addresses', ['id' => $address->id, 'is_default' => false]);
    }

    // ─── Edit (GET /user/addresses/{id}/edit) ────────────────────────────────

    public function test_user_can_fetch_own_address_for_edit(): void
    {
        $user    = $this->makeUser();
        $address = $this->makeAddress($user, ['name' => 'Sandeep']);

        $response = $this->actingAs($user)->getJson("/user/addresses/{$address->id}/edit");

        $response->assertOk()
            ->assertJsonFragment(['success' => true])
            ->assertJsonPath('address.name', 'Sandeep');
    }

    // ─── Update (PUT /user/addresses/{id}) ───────────────────────────────────

    public function test_user_can_update_own_address(): void
    {
        $user    = $this->makeUser();
        $address = $this->makeAddress($user, ['name' => 'Old Name']);

        $response = $this->actingAs($user)
            ->putJson("/user/addresses/{$address->id}", $this->addressPayload(['name' => 'New Name']));

        $response->assertOk()->assertJsonFragment(['success' => true]);
        $this->assertDatabaseHas('addresses', ['id' => $address->id, 'name' => 'New Name']);
    }

    public function test_update_validates_phone(): void
    {
        $user    = $this->makeUser();
        $address = $this->makeAddress($user);

        $response = $this->actingAs($user)
            ->putJson("/user/addresses/{$address->id}", $this->addressPayload(['phone' => '123']));

        $response->assertUnprocessable()->assertJsonValidationErrors(['phone']);
    }

    public function test_update_setting_default_clears_others_in_same_category(): void
    {
        $user  = $this->makeUser();
        $addr1 = $this->makeAddress($user, ['is_default' => true]);
        $addr2 = $this->makeAddress($user, ['is_default' => false]);

        $this->actingAs($user)
            ->putJson("/user/addresses/{$addr2->id}", $this->addressPayload(['is_default' => true]));

        $this->assertDatabaseHas('addresses', ['id' => $addr1->id, 'is_default' => false]);
        $this->assertDatabaseHas('addresses', ['id' => $addr2->id, 'is_default' => true]);
    }

    public function test_update_is_default_false_does_not_clear_others(): void
    {
        $user  = $this->makeUser();
        $addr1 = $this->makeAddress($user, ['is_default' => true]);
        $addr2 = $this->makeAddress($user, ['is_default' => false]);

        $this->actingAs($user)
            ->putJson("/user/addresses/{$addr2->id}", $this->addressPayload(['is_default' => false]));

        $this->assertDatabaseHas('addresses', ['id' => $addr1->id, 'is_default' => true]);
    }

    // ─── Destroy (DELETE /user/addresses/{id}) ───────────────────────────────

    public function test_user_can_delete_own_address(): void
    {
        $user    = $this->makeUser();
        $address = $this->makeAddress($user);

        $response = $this->actingAs($user)->deleteJson("/user/addresses/{$address->id}");

        $response->assertOk()->assertJsonFragment(['success' => true]);
        $this->assertDatabaseMissing('addresses', ['id' => $address->id]);
    }

    public function test_deleting_nonexistent_address_returns_404(): void
    {
        $user = $this->makeUser();

        $response = $this->actingAs($user)->deleteJson('/user/addresses/99999');

        $response->assertNotFound();
    }

    // ─── Set Default (POST /user/addresses/{id}/set-default) ─────────────────

    public function test_user_can_set_address_as_default(): void
    {
        $user  = $this->makeUser();
        $addr1 = $this->makeAddress($user, ['is_default' => true]);
        $addr2 = $this->makeAddress($user, ['is_default' => false]);

        $response = $this->actingAs($user)->postJson("/user/addresses/{$addr2->id}/set-default");

        $response->assertOk()->assertJsonFragment(['success' => true]);
        $this->assertDatabaseHas('addresses', ['id' => $addr1->id, 'is_default' => false]);
        $this->assertDatabaseHas('addresses', ['id' => $addr2->id, 'is_default' => true]);
    }

    public function test_set_default_only_affects_same_category(): void
    {
        $user          = $this->makeUser();
        $deliveryAddr  = $this->makeAddress($user, ['address_category' => 'delivery', 'is_default' => true]);
        $billingAddr2  = $this->makeAddress($user, ['address_category' => 'billing',  'is_default' => true]);
        $deliveryAddr2 = $this->makeAddress($user, ['address_category' => 'delivery', 'is_default' => false]);

        $this->actingAs($user)->postJson("/user/addresses/{$deliveryAddr2->id}/set-default");

        $this->assertDatabaseHas('addresses', ['id' => $deliveryAddr->id,  'is_default' => false]);
        $this->assertDatabaseHas('addresses', ['id' => $billingAddr2->id, 'is_default' => true]);
    }

    // ─── Multi-user isolation ─────────────────────────────────────────────────

    public function test_two_users_can_each_have_3_addresses_independently(): void
    {
        $userA = $this->makeUser();
        $userB = $this->makeUser();

        for ($i = 0; $i < 3; $i++) {
            $this->makeAddress($userA, ['address_category' => 'delivery']);
            $this->makeAddress($userB, ['address_category' => 'delivery']);
        }

        $responseA = $this->actingAs($userA)
            ->postJson('/user/addresses', $this->addressPayload(['address_category' => 'delivery']));
        $responseB = $this->actingAs($userB)
            ->postJson('/user/addresses', $this->addressPayload(['address_category' => 'delivery']));

        $responseA->assertStatus(422)->assertJsonFragment(['success' => false]);
        $responseB->assertStatus(422)->assertJsonFragment(['success' => false]);
    }

    public function test_user_a_default_does_not_affect_user_b_default(): void
    {
        $userA  = $this->makeUser();
        $userB  = $this->makeUser();
        $addrA1 = $this->makeAddress($userA, ['is_default' => true]);
        $addrB1 = $this->makeAddress($userB, ['is_default' => true]);

        $this->actingAs($userA)->postJson('/user/addresses', $this->addressPayload(['is_default' => true]));

        $this->assertDatabaseHas('addresses', ['id' => $addrB1->id, 'is_default' => true]);
        $this->assertDatabaseHas('addresses', ['id' => $addrA1->id, 'is_default' => false]);
    }

    // ─── Default category fallback ────────────────────────────────────────────

    public function test_store_defaults_to_delivery_when_category_is_omitted(): void
    {
        $user    = $this->makeUser();
        $payload = $this->addressPayload();
        unset($payload['address_category']);

        $this->actingAs($user)->postJson('/user/addresses', $payload);

        $this->assertDatabaseHas('addresses', [
            'user_id'          => $user->id,
            'address_category' => 'delivery',
        ]);
    }
}
