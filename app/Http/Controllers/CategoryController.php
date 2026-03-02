<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    // 1. Danh sách (List)
    public function index() {
        // Chỉ lấy những danh mục chưa xóa mềm
        $categories = Category::where('is_delete', 0)->with('parent')->get();
        return view('category.index', compact('categories'));
    }

    // 2. Form thêm mới (Create)
    public function create() {
        // Lấy danh sách để đổ vào Select "Danh mục cha"
        $parents = Category::where('is_delete', 0)->get();
        return view('category.create', compact('parents'));
    }

    // 3. Lưu bản ghi (Store)
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id', // parent_id phải tồn tại hoặc null
        ]);

        $data = $request->all();

        // Xử lý upload ảnh nếu có
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        Category::create($data);
        return redirect()->route('category.index')->with('success', 'Thêm mới thành công!');
    }

    // 4. Form chỉnh sửa (Edit)
    public function edit($id) {
        $category = Category::findOrFail($id);
        
        // Lấy danh sách cha, loại bỏ chính nó để tránh chọn chính mình làm cha
        $parents = Category::where('is_delete', 0)
                            ->where('id', '!=', $id)
                            ->get();

        return view('category.edit', compact('category', 'parents'));
    }

    // 5. Cập nhật bản ghi (Update)
    public function update(Request $request, $id) {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        // Logic chặn vòng lặp: Không cho chọn con/cháu làm cha
        if ($request->parent_id) {
            $childrenIds = $this->getAllChildrenIds($category);
            if (in_array($request->parent_id, $childrenIds)) {
                return redirect()->back()->withErrors(['parent_id' => 'Không thể chọn con/cháu làm danh mục cha!']);
            }
        }

        $data = $request->all();
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($category->image) Storage::disk('public')->delete($category->image);
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($data);
        return redirect()->route('category.index')->with('success', 'Cập nhật thành công!');
    }

    // 6. Xóa mềm (Destroy)
    public function destroy($id) {
        $category = Category::findOrFail($id);
        $category->update(['is_delete' => 1]); // Chuyển is_delete thành true thay vì xóa bản ghi
        return redirect()->back()->with('success', 'Đã xóa mềm danh mục!');
    }

    // Hàm bổ trợ để lấy tất cả ID của con cháu (đệ quy)
    private function getAllChildrenIds($category) {
        $ids = [];
        foreach ($category->children as $child) {
            $ids[] = $child->id;
            $ids = array_merge($ids, $this->getAllChildrenIds($child));
        }
        return $ids;
    }
}