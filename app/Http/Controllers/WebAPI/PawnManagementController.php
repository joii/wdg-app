<?php

namespace App\Http\Controllers\WebAPI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pawns;
use Illuminate\Support\Facades\DB;

class PawnManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // GET /api/pawns : ดึงข้อมูลทั้งหมด
    public function index()
    {
        return response()->json(Pawns::all());
    }

    /**
     * Show the form for creating a new resource.
     */

    // batch logic
    public function create(Request $request)
    {
        DB::table('pawn_data')->orderBy('pawn_id')->chunk(100, function ($pawns) {
            foreach ($pawns as $pawn) {


                    // Check if pawn_sub100m_data already exists
                    $sub100m = DB::table('pawn_sub100m_data')
                    ->where('pawn_barcode', $pawn->pawn_barcode)
                    ->first();

                    // Check if pawn_sub100nm_data already exists
                    $sub100nm = DB::table('pawn_sub100nm_data')
                    ->where('pawn_barcode', $pawn->pawn_barcode)
                    ->first();

                    // Check if pawn_subnm_data already exists
                    $subnm = DB::table('pawn_subnm_data')
                    ->where('pawn_barcode', $pawn->pawn_barcode)
                    ->first();



                    // ถ้ามี barcode ให้ทำการอัปเดต is_erased ใน pawn_data =1 ,
                    // ใน pawn_sub100m_data =1 และทำการ add data ใหม่โดยให้ค่า is_erased = 0
                    if ($sub100m) {
                        DB::beginTransaction();
                        try {
                            // อัปเดต is_erased ใน pawn_data
                            DB::table('pawn_data')
                                ->where('pawn_id', $pawn->pawn_id)
                                ->update(['is_erased' => 1]);

                            // อัปเดต is_erased ใน pawn_sub100m_data
                            DB::table('pawn_sub100m_data')
                                ->where('pawn_sub100m_id', $sub100m->pawn_sub100m_id)
                                ->update(['is_erased' => 1]);

                            // คัดลอกข้อมูลจาก row เก่า แล้ว insert ใหม่
                            $newData = (array) $sub100m;
                            // unset($newData['pawn_sub100m_id']); // ถ้า id เป็น auto-increment ต้องลบทิ้ง
                            $newData['is_erased'] = 0;

                            DB::table('pawn_sub100m_data')->insert($newData);

                            DB::commit();
                        } catch (\Exception $e) {
                            DB::rollBack();
                            logger()->error('Update failed: ' . $e->getMessage());
                        }
                    }

                    // ถ้ามี barcode ให้ทำการอัปเดต is_erased ใน pawn_data =1 ,
                    // ใน pawn_sub100nm_data =1 และทำการ add data ใหม่โดยให้ค่า is_erased = 0
                    if ($sub100nm) {
                        DB::beginTransaction();
                        try {
                            // อัปเดต is_erased ใน pawn_data
                            DB::table('pawn_data')
                                ->where('pawn_id', $pawn->pawn_id)
                                ->update(['is_erased' => 1]);

                            // อัปเดต is_erased ใน pawn_sub100m_data
                            DB::table('pawn_sub100nm_data')
                                ->where('pawn_sub100nm_id', $sub100nm->pawn_sub100nm_id)
                                ->update(['is_erased' => 1]);

                            // คัดลอกข้อมูลจาก row เก่า แล้ว insert ใหม่
                            $newData = (array) $sub100nm;
                            // unset($newData['pawn_sub100m_id']); // ถ้า id เป็น auto-increment ต้องลบทิ้ง
                            $newData['is_erased'] = 0;

                            DB::table('pawn_sub100nm_data')->insert($newData);

                            DB::commit();
                        } catch (\Exception $e) {
                            DB::rollBack();
                            logger()->error('Update failed: ' . $e->getMessage());
                        }
                    }

                    // ถ้ามี barcode ให้ทำการอัปเดต is_erased ใน pawn_data =1 ,
                    // ใน pawn_subnm_data =1 และทำการ add data ใหม่โดยให้ค่า is_erased = 0
                    if ($subnm) {
                        DB::beginTransaction();
                        try {
                            // อัปเดต is_erased ใน pawn_data
                            DB::table('pawn_data')
                                ->where('pawn_id', $pawn->pawn_id)
                                ->update(['is_erased' => 1]);

                            // อัปเดต is_erased ใน pawn_sub100m_data
                            DB::table('pawn_subnm_data')
                                ->where('pawn_subnm_id', $sub100m->pawn_subnm_id)
                                ->update(['is_erased' => 1]);

                            // คัดลอกข้อมูลจาก row เก่า แล้ว insert ใหม่
                            $newData = (array) $subnm;
                            // unset($newData['pawn_sub100m_id']); // ถ้า id เป็น auto-increment ต้องลบทิ้ง
                            $newData['is_erased'] = 0;

                            DB::table('pawn_subnm_data')->insert($newData);

                            DB::commit();
                        } catch (\Exception $e) {
                            DB::rollBack();
                            logger()->error('Update failed: ' . $e->getMessage());
                        }
                    }

                    // Add to pawns table (online)
                    $pawnData = (array) $pawn;
                    DB::table('pawns')->insert($pawnData);
            }
        });
    }

    /**
     * Store a newly created resource in storage.
     */
     // POST /api/products : สร้างข้อมูลใหม่
    public function store(Request $request)
    {
         // Validation (ตรวจสอบข้อมูล)
        $request->validate([
            'pawn_id' => 'required',
            'pawn_barcode' => 'required|max:255',
        ]);

        $product = Pawns::create($request->all());

        return response()->json($product, 201); // 201 Created
    }

    /**
     * Display the specified resource.
     */
    // GET /api/pawns/{id} : ดึงข้อมูลเดียว
    public function show(Pawns $pawns)
    {
        return response()->json($pawns);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // PUT/PATCH /api/pawns/{id} : อัปเดตข้อมูล
    public function update(Request $request, Pawns $pawns)
    {
        $request->validate([
            'pawn_id' => 'required',
            'pawn_barcode' => 'required|max:255',
        ]);

        $pawns->update($request->all());

        return response()->json($pawns);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pawns $pawns)
    {
         $pawns->delete();
         return response()->json(null, 204); // 204 No Content
    }
}
