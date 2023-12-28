<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\BusinessContractorRepository;

class BusinessContractorController extends Controller
{
    private $businessContractorRepository;
    public function __construct(BusinessContractorRepository $businessContractorRepository)
    {
        $this->middleware('auth:admin');
        $this->businessContractorRepository = $businessContractorRepository;
    }
    public function delete($id)
    {
        $brand = $this->businessContractorRepository->delete($id);
        return response()->json("Item with id : $brand->id deleted successfully");
    }

    public function index()
    {
        $text = isset(request()->text) ? request()->text : '';
        return $this->businessContractorRepository->getBusinessContractors($text, request()->page_size, request()->status);
    }
}
