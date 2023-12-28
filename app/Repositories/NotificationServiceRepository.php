<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use App\Models\Area;
use App\Models\City;
use App\Models\NotificationService;

class NotificationServiceRepository
{
    public function store($input)
    {
        return NotificationService::create($input);
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
    public function getNotificationServices($text, $page_size)
    {
        if ($page_size) {
            return NotificationService::where("name", "like", "%" . strtolower($text) . '%')
                ->with(["city", "area"])->orderBy("id", "desc")->paginate($page_size);
        }
        return NotificationService::get();
    }
    //Commons
    private function find($id, $relations = [])
    {
        $service = NotificationService::with($relations)->find($id);
        if (!$service) throw  new NotFoundException;
        return $service;
    }
}
