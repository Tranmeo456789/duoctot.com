<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use App\Model\Shop\UsersModel as MainModel;
use App\Model\Shop\UsersModel;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class SyncTdoctorController extends ShopFrontEndController
{
    public function transferUsers()
    {
        // Lấy user_id lớn nhất hiện tại ở database chính
        $lastUserId = DB::connection('mysql')->table('user')->max('user_id');
        $totalInserted = 0;
        // Lấy các user có user_id lớn hơn user_id lớn nhất ở database chính
        DB::connection('mysql_share_data')->table('user')
            ->where('user_id', '>', $lastUserId)
            ->orderBy('user_id', 'asc')
            ->chunk(100, function ($users) use (&$totalInserted) {
                foreach ($users as $user) {
                    DB::connection('mysql')->table('user')->insert([
                        'user_id' => $user->user_id,
                        'email' => $user->email,
                        'email_info' => $user->email_info,
                        'fullname' => $user->fullname,
                        'phone' => $user->phone,
                        'password' => $user->password,
                        'avatar' => $user->avatar,
                        'gender' => $user->gender,
                        'user_status' => $user->user_status,
                        'user_type_id' => $user->user_type_id,
                        'is_admin' => $user->is_admin,
                        'is_add_product' => $user->is_add_product,
                        'details' => $user->details,
                        'created_at' => $user->created_at,
                        'updated_at' => $user->updated_at,
                        'use_date' => $user->use_date,
                        'paid' => $user->paid,
                        'address' => $user->address,
                        'lat_long_address' => $user->lat_long_address,
                        'sex' => $user->sex,
                        'id_facebook' => $user->id_facebook,
                        'id_google' => $user->id_google,
                        'present' => $user->present,
                        'balance' => $user->balance,
                        'show_phone' => $user->show_phone,
                        'refer_type' => $user->refer_type,
                        'refer_id' => $user->refer_id,
                        'province_id' => $user->province_id,
                        'district_id' => $user->district_id,
                        'isSentMessage' => $user->isSentMessage,
                        'domain_register' => $user->domain_register,
                        'is_free' => $user->is_free,
                        'redirect_url' => $user->redirect_url,
                        'type_account' => $user->type_account,
                        'ref_register' => $user->ref_register,
                        'codeRef' => $user->codeRef,
                        'info_bank' => $user->info_bank,
                        'reward_points' => $user->reward_points,
                        'num_import_code_ref' => $user->num_import_code_ref,
                        'slug' => $user->slug
                    ]);
                    $totalInserted++;
                }
            });
        return response()->json([
            'message' => 'Transfer User completed successfully!',
            'total_inserted' => $totalInserted
        ]);
    }
    public function transferUserToken()
    {
        // Lấy id lớn nhất hiện tại ở database chính
        $lastUserId = DB::connection('mysql')->table('user_token')->max('id');
        $totalInserted = 0;
        // Lấy các user có user_id lớn hơn id lớn nhất ở database chính
        DB::connection('mysql_share_data')->table('user_token')
            ->where('id', '>', $lastUserId)
            ->orderBy('id', 'asc')
            ->chunk(100, function ($userTokens) use (&$totalInserted) {
                foreach ($userTokens as $item) {
                    DB::connection('mysql')->table('user_token')->insert([
                        'id' => $item->id,
                        'user_id' => $item->user_id,
                        'token' => $item->token,
                        'created_by' => $item->created_by,
                        'created_at' => $item->created_at,
                        'updated_at' => $item->updated_at,
                    ]);
                    $totalInserted++;
                }
            });
        return response()->json([
            'message' => 'transferUserToken completed successfully!',
            'total_inserted' => $totalInserted
        ]);
    }
    public function transferUserValues()
    {
        // Lấy id lớn nhất hiện tại ở database chính
        $lastItemId = DB::connection('mysql')->table('user_values')->max('id');
        $totalInserted = 0;
        // Lấy các user có user_id lớn hơn id lớn nhất ở database chính
        DB::connection('mysql_share_data')->table('user_values')
            ->where('id', '>', $lastItemId)
            ->orderBy('id', 'asc')
            ->chunk(100, function ($items) use (&$totalInserted) {
                foreach ($items as $item) {
                    DB::connection('mysql')->table('user_values')->insert([
                        'id' => $item->id,
                        'user_id' => $item->user_id,
                        'user_field' => $item->user_field,
                        'value' => $item->value
                    ]);
                    $totalInserted++;
                }
            });
        return response()->json([
            'message' => 'transferUserValues completed successfully!',
            'total_inserted' => $totalInserted
        ]);
    }
    public function transferWarehouses()
    {
        // Lấy id lớn nhất hiện tại ở database chính
        $lastItemId = DB::connection('mysql')->table('warehouses')->max('id');
        $totalInserted = 0;
        // Lấy các item có id lớn hơn id lớn nhất ở database chính
        DB::connection('mysql_share_data')->table('warehouses')
            ->where('id', '>', $lastItemId)
            ->orderBy('id', 'asc')
            ->chunk(100, function ($items) use (&$totalInserted) {
                foreach ($items as $item) {
                    DB::connection('mysql')->table('warehouses')->insert([
                        'id' => $item->id,
                        'name' => $item->name,
                        'local' => $item->local,
                        'province_id' => $item->province_id,
                        'district_id' => $item->district_id,
                        'ward_id' => $item->ward_id,
                        'address' => $item->address,
                        'user_id' => $item->user_id,
                        'product_id' => $item->product_id,
                        'created_at' => $item->created_at,
                        'created_by' => $item->created_by,
                        'updated_at' => $item->updated_at,
                        'updated_by' => $item->updated_by,
                    ]);
                    $totalInserted++;
                }
            });
        return response()->json([
            'message' => 'transferWarehouses completed successfully!',
            'total_inserted' => $totalInserted
        ]);
    }
    public function transferProducers()
    {
        // Lấy id lớn nhất hiện tại ở database chính
        $lastItemId = DB::connection('mysql')->table('producers')->max('id');
        $totalInserted = 0;
        // Lấy các item có id lớn hơn id lớn nhất ở database chính
        DB::connection('mysql_share_data')->table('producers')
            ->where('id', '>', $lastItemId)
            ->orderBy('id', 'asc')
            ->chunk(100, function ($items) use (&$totalInserted) {
                foreach ($items as $item) {
                    DB::connection('mysql')->table('producers')->insert([
                        'id' => $item->id,
                        'name' => $item->name,
                        'created_by' => $item->created_by,
                        'updated_by' => $item->updated_by,
                        'created_at' => $item->created_at,
                        'updated_at' => $item->updated_at,
                    ]);
                    $totalInserted++;
                }
            });
        return response()->json([
            'message' => 'transferProducers completed successfully!',
            'total_inserted' => $totalInserted
        ]);
    }
    public function transferUnits()
    {
        // Lấy id lớn nhất hiện tại ở database chính
        $lastItemId = DB::connection('mysql')->table('units')->max('id');
        $totalInserted = 0;
        // Lấy các item có id lớn hơn id lớn nhất ở database chính
        DB::connection('mysql_share_data')->table('units')
            ->where('id', '>', $lastItemId)
            ->orderBy('id', 'asc')
            ->chunk(100, function ($items) use (&$totalInserted) {
                foreach ($items as $item) {
                    DB::connection('mysql')->table('units')->insert([
                        'id' => $item->id,
                        'name' => $item->name,
                        'created_by' => $item->created_by,
                        'updated_by' => $item->updated_by,
                        'created_at' => $item->created_at,
                        'updated_at' => $item->updated_at,
                    ]);
                    $totalInserted++;
                }
            });
        return response()->json([
            'message' => 'transferUnits completed successfully!',
            'total_inserted' => $totalInserted
        ]);
    }
    public function transferTrademarks()
    {
        // Lấy id lớn nhất hiện tại ở database chính
        $lastItemId = DB::connection('mysql')->table('trademarks')->max('id');
        $totalInserted = 0;
        // Lấy các item có id lớn hơn id lớn nhất ở database chính
        DB::connection('mysql_share_data')->table('trademarks')
            ->where('id', '>', $lastItemId)
            ->orderBy('id', 'asc')
            ->chunk(100, function ($items) use (&$totalInserted) {
                foreach ($items as $item) {
                    DB::connection('mysql')->table('trademarks')->insert([
                        'id' => $item->id,
                        'name' => $item->name,
                        'created_by' => $item->created_by,
                        'updated_by' => $item->updated_by,
                        'created_at' => $item->created_at,
                        'updated_at' => $item->updated_at,
                    ]);
                    $totalInserted++;
                }
            });
        return response()->json([
            'message' => 'transferTrademarks completed successfully!',
            'total_inserted' => $totalInserted
        ]);
    }
    public function transferProducts()
    {
        // Lấy id lớn nhất hiện tại ở database chính
        $lastItemId = DB::connection('mysql')->table('products')->max('id');
        $totalInserted = 0;
        // Lấy các item có id lớn hơn id lớn nhất ở database chính
        DB::connection('mysql_share_data')->table('products')
            ->where('id', '>', $lastItemId)
            ->orderBy('id', 'asc')
            ->chunk(100, function ($items) use (&$totalInserted) {
                foreach ($items as $item) {
                    DB::connection('mysql')->table('products')->insert([
                        'id' => $item->id,
                        'name' => $item->name,
                        'type' => $item->type,
                        'code' => $item->code,
                        'cat_product_id' => $item->cat_product_id,
                        'cat_product_parent_id' => $item->cat_product_parent_id,
                        'producer_id' => $item->producer_id,
                        'tick' => $item->tick,
                        'type_price' => $item->type_price,
                        'price' => $item->price,
                        'list_prices' => $item->list_prices,
                        'price_vat' => $item->price_vat,
                        'percent_discount' => $item->percent_discount,
                        'coefficient' => $item->coefficient,
                        'type_vat' => $item->type_vat,
                        'packing' => $item->packing,
                        'expiration_date' => $item->expiration_date,
                        'unit_id' => $item->unit_id,
                        'sell_area' => $item->sell_area,
                        'amout_max' => $item->amout_max,
                        'quantity_in_stock' => $item->quantity_in_stock,
                        'country_id' => $item->country_id,
                        'dosage_forms' => $item->dosage_forms,
                        'trademark_id' => $item->trademark_id,
                        'brand_origin_id' => $item->brand_origin_id,
                        'inventory' => $item->inventory,
                        'inventory_min' => $item->inventory_min,
                        'specification' => $item->specification,
                        'benefit' => $item->benefit,
                        'elements' => $item->elements,
                        'general_info' => $item->general_info,
                        'prescribe' => $item->prescribe,
                        'dosage' => $item->dosage,
                        'note' => $item->note,
                        'preserve' => $item->preserve,
                        'image' => $item->image,
                        'albumImage' => $item->albumImage,
                        'albumImageHash' => $item->albumImageHash,
                        'featurer' => $item->featurer,
                        'long' => $item->long,
                        'wide' => $item->wide,
                        'high' => $item->high,
                        'mass' => $item->mass,
                        'user_id' => $item->user_id,
                        'status_product' => $item->status_product,
                        'slug' => $item->slug,
                        'discount_ref' => $item->discount_ref,
                        'discount_tdoctor' => $item->discount_tdoctor,
                        'contact' => $item->contact,
                        'keyword_search' => $item->keyword_search,
                        'meta_keywords' => $item->meta_keywords,
                        'meta_description' => $item->meta_description,
                        'show_price' => $item->show_price,
                        'prescription_drug' => $item->prescription_drug,
                        'created_by' => $item->created_by,
                        'created_at' => $item->created_at,
                        'updated_by' => $item->updated_by,
                        'updated_at' => $item->updated_at,
                    ]);
                    $totalInserted++;
                }
            });
        return response()->json([
            'message' => 'transferProducts completed successfully!',
            'total_inserted' => $totalInserted
        ]);
    }
    public function productWarehouse()
    {
        // Lấy id lớn nhất hiện tại ở database chính
        $lastItemId = DB::connection('mysql')->table('product_warehouse')->max('id');
        $totalInserted = 0;
        // Lấy các item có id lớn hơn id lớn nhất ở database chính
        DB::connection('mysql_share_data')->table('product_warehouse')
            ->where('id', '>', $lastItemId)
            ->orderBy('id', 'asc')
            ->chunk(100, function ($items) use (&$totalInserted) {
                foreach ($items as $item) {
                    DB::connection('mysql')->table('product_warehouse')->insert([
                        'id' => $item->id,
                        'product_id' => $item->product_id,
                        'warehouse_id' => $item->warehouse_id,
                        'quantity' => $item->quantity,
                    ]);
                    $totalInserted++;
                }
            });
        return response()->json([
            'message' => 'productWarehouse completed successfully!',
            'total_inserted' => $totalInserted
        ]);
    }
    public function transferImportCoupon()
    {
        // Lấy id lớn nhất hiện tại ở database chính
        $lastItemId = DB::connection('mysql')->table('import_coupon')->max('id');
        $totalInserted = 0;
        // Lấy các item có id lớn hơn id lớn nhất ở database chính
        DB::connection('mysql_share_data')->table('import_coupon')
            ->where('id', '>', $lastItemId)
            ->orderBy('id', 'asc')
            ->chunk(100, function ($items) use (&$totalInserted) {
                foreach ($items as $item) {
                    DB::connection('mysql')->table('import_coupon')->insert([
                        'id' => $item->id,
                        'name' => $item->name,
                        'date' => $item->date,
                        'warehouse_id' => $item->warehouse_id,
                        'user_id' => $item->user_id,
                        'list_products' => $item->list_products,
                        'total' => $item->total,
                        'created_at' => $item->created_at,
                        'created_by' => $item->created_by,
                        'updated_at' => $item->updated_at,
                        'updated_by' => $item->updated_by,
                        'deleted_at' => $item->deleted_at,
                        'deleted_by' => $item->deleted_by,
                    ]);
                    $totalInserted++;
                }
            });
        return response()->json([
            'message' => 'transferImportCoupon completed successfully!',
            'total_inserted' => $totalInserted
        ]);
    }
}
