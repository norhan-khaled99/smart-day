<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use App\Models\Recruitment;

class RecruitmentRepository
{
    public function store($input)
    {
        return Recruitment::create($input);
    }
    public function delete($id)
    {
        $recruitment = $this->find($id);
        $recruitment->delete();
        return $recruitment;
    }
    public function getRecruitments($text, $page_size)
    {
        if ($page_size) {
            return Recruitment::where("name", "like", "%" . strtolower($text) . '%')
                ->orderBy("id", "desc")->paginate($page_size);
        }
        return Recruitment::get();
    }
    public function geRecruitment($id)
    {
        return $this->find($id);
    }
    //Commons
    private function find($id, $relations = [])
    {
        $recruitment = Recruitment::with($relations)->find($id);
        if (!$recruitment) throw  new NotFoundException;
        return $recruitment;
    }
}
