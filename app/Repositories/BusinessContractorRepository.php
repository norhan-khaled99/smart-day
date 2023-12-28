<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use App\Models\Area;
use App\Models\BusinessContractor;
use App\Models\City;

class BusinessContractorRepository
{
    public function store($input)
    {
        return BusinessContractor::create($input);
    }
    public function getCities()
    {
        return City::get();
    }
    public function getAreas()
    {
        return Area::get();
    }

    public function delete($id)
    {
        $service = $this->find($id);
        $service->delete();
        return $service;
    }
    public function getBusinessContractors($text, $page_size)
    {
        if ($page_size) {
            return BusinessContractor::where("company_name", "like", "%" . strtolower($text) . '%')
                ->with(["city", "area"])->orderBy("id", "desc")->paginate($page_size);
        }
        return BusinessContractor::get();
    }
    //Commons
    private function find($id, $relations = [])
    {
        $service = BusinessContractor::with($relations)->find($id);
        if (!$service) throw  new NotFoundException;
        return $service;
    }
}
