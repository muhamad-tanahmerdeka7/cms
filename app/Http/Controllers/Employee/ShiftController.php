<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use App\Http\Requests\Employee\StoreShiftRequest;
use App\Http\Requests\Employee\UpdateShiftRequest;

class ShiftController extends Controller
{
    public function index()
    {
        $shifts = Shift::latest()->get();
        return view('employees.shifts.index', compact('shifts'));
    }

    public function create()
    {
        return view('employees.shifts.create');
    }

    public function store(StoreShiftRequest $request)
    {
        Shift::create($request->validated());
        return redirect()->route('shifts.index')
            ->with('success', 'Shift berhasil ditambahkan.');
    }

    public function edit(Shift $shift)
    {
        return view('employees.shifts.edit', compact('shift'));
    }

    public function update(UpdateShiftRequest $request, Shift $shift)
    {
        $shift->update($request->validated());
        return redirect()->route('shifts.index')
            ->with('success', 'Shift berhasil diperbarui.');
    }

    public function destroy(Shift $shift)
    {
        if ($shift->employees()->count() > 0) {
            return back()->with('error', 'Shift masih digunakan oleh karyawan, tidak bisa dihapus.');
        }
        $shift->delete();
        return redirect()->route('shifts.index')
            ->with('success', 'Shift berhasil dihapus.');
    }
}
