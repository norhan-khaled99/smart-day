<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\NotificationServiceRepository;

class NotificationServiceController extends Controller
{
    private $notificationServiceRepository;
    public function __construct(NotificationServiceRepository $notificationServiceRepository)
    {
        $this->middleware('auth:admin');
        $this->notificationServiceRepository = $notificationServiceRepository;
    }
    public function delete($id)
    {
        $brand = $this->notificationServiceRepository->delete($id);
        return response()->json("Item with id : $brand->id deleted successfully");
    }

    public function index()
    {
        $text = isset(request()->text) ? request()->text : '';
        return $this->notificationServiceRepository->getNotificationServices($text, request()->page_size, request()->status);
    }
}
