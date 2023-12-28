<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use App\Models\BaseCategory;

class BaseCategoryRepository
{
    public function store($input)
    {
        return BaseCategory::create($input);
    }
    public function update($input)
    {
        $category = $this->find($input["id"]);
        $category->update($input);
        return $category;
    }
    public function delete($id)
    {
        $category = $this->find($id);
        $category->delete();
        return $category;
        
    }
    public function getCategories($text, $page_size, $status)
    {
        if ($page_size) {
            return BaseCategory::where(function ($q) use ($text) {
                $q->where("name_ar", "like", "%" . strtolower($text) . '%')
                    ->orWhere("name_en", "like", "%" . strtolower($text) . '%');
            })->when($status !== null, function ($q) use ($status) {
                $q->where("status", $status);
            })
                ->with("mediaManager")
                ->orderBy("id", "desc")->paginate($page_size);
        }
        return BaseCategory::get();
    }
    public function toggleStatus($id)
    {
        $category = $this->find($id);
        $category->status = $category->status == 1 ? 0 : 1;
        $category->save();
        return $category;
    }
    public function getCategory($id)
    {
        return $this->find($id, ["mediaManager"]);
    }
    //Commons
    private function find($id, $relations = [])
    {
        $category = BaseCategory::with($relations)->find($id);
        if (!$category) throw  new NotFoundException;
        return $category;
    }
}
