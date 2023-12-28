<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use App\Models\Area;
use App\Models\City;
use App\Models\Install;

class InstallRepository
{
    public function store($input)
    {
        return Install::create($input);
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
    public function getInstalls($text, $page_size)
    {
        if ($page_size) {
            return Install::where("name", "like", "%" . strtolower($text) . '%')
                ->with(["city", "area"])->orderBy("id", "desc")->paginate($page_size);
        }
        return Install::get();
    }
    //Commons
    private function find($id, $relations = [])
    {
        $service = Install::with($relations)->find($id);
        if (!$service) throw  new NotFoundException;
        return $service;
    }
}
