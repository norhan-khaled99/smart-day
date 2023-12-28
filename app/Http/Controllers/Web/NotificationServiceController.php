<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\NotificationServiceRequest;
use App\Repositories\NotificationServiceRepository;

class NotificationServiceController extends Controller
{
    private $notificationServiceRepository;
    public function __construct(NotificationServiceRepository $notificationServiceRepository)
    {
        $this->notificationServiceRepository = $notificationServiceRepository;
    }
    public function store(NotificationServiceRequest $request)
    {
        $brand = $this->notificationServiceRepository->store($request->validated());
        return response()->json("Item created successfully with id : $brand->id");
    }
    public function getAreas()
    {
        return $this->notificationServiceRepository->getAreas();
    }
    public function getCities()
    {
        return $this->notificationServiceRepository->getCities();
    }
}
