<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContactRequest;
use App\Repositories\ContactRepository;
use Illuminate\Support\Str;

class ContactController extends Controller
{
    private $contactRepository;
    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }
    public function store(ContactRequest $request)
    {
        $input = $request->validated();
        $input["serial"] = "#SD-Store:" . substr(Str::uuid(), 0, 5);
        $brand = $this->contactRepository->store($input);
        return response()->json("Item created successfully with id : $brand->id");
    }
}
