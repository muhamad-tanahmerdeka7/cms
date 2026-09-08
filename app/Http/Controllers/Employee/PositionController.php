<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Http\Requests\Employee\StorePositionRequest;
use App\Http\Requests\Employee\UpdatePositionRequest;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::latest()->get();
        return view('employees.positions.index', compact('positions'));
    }

    public function create()
    {
        return view('employees.positions.create');
    }

    public function store(StorePositionRequest $request)
    {
        Position::create($request->validated());
        return redirect()->route('positions.index')
            ->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function edit(Position $position)
    {
        return view('employees.positions.edit', compact('position'));
    }

    public function update(UpdatePositionRequest $request, Position $position)
    {
        $position->update($request->validated());
        return redirect()->route('positions.index')
            ->with('success', 'Jabatan berhasil diperbarui.');
    }

    public function destroy(Position $position)
    {
        if ($position->employees()->count() > 0) {
            return back()->with('error', 'Jabatan masih memiliki karyawan, tidak bisa dihapus.');
        }
        $position->delete();
        return redirect()->route('positions.index')
            ->with('success', 'Jabatan berhasil dihapus.');
    }
}
