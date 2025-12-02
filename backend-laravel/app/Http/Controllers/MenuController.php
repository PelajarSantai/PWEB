<?php
namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        return Menu::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'nullable|string',
            'image_url' => 'nullable|string',
        ]);

        return Menu::create($validated);
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $validated = $request->validate([
            'name' => 'nullable|string',
            'price' => 'nullable|numeric',
            'category' => 'nullable|string',
            'image_url' => 'nullable|string',
        ]);

        $menu->update($validated);

        return $menu;
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return response()->json(['message' => 'Menu deleted']);
    }
}
