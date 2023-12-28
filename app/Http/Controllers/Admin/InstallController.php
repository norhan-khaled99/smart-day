<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EmailNotificationRequest;
use App\Mail\EmailNotification;
use App\Repositories\InstallRepository;
use Illuminate\Support\Facades\Mail;

class InstallController extends Controller
{
    private $installRepository;
    public function __construct(InstallRepository $installRepository)
    {
        $this->middleware('auth:admin');
        $this->installRepository = $installRepository;
    }
    public function delete($id)
    {
        $brand = $this->installRepository->delete($id);
        return response()->json("Item with id : $brand->id deleted successfully");
    }

    public function index()
    {
        $text = isset(request()->text) ? request()->text : '';
        return $this->installRepository->getInstalls($text, request()->page_size, request()->status);
    }
    public function sendEmail(EmailNotificationRequest $request)
    {
        Mail::to($request->email)->send(new EmailNotification($request->validated()));

    }
}
