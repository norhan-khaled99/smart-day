<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\BusinessConstractorRequest;
use App\Repositories\BusinessContractorRepository;

class BusinessContractorController extends Controller
{
    private $businessContractorRepository;
    public function __construct(BusinessContractorRepository $businessContractorRepository)
    {
        $this->businessContractorRepository = $businessContractorRepository;
    }
    public function store(BusinessConstractorRequest $request)
    {
        $brand = $this->businessContractorRepository->store($request->validated());
        return response()->json("Item created successfully with id : $brand->id");
    }
    public function getAreas()
    {
        return $this->businessContractorRepository->getAreas();
    }
    public function getCities()
    {
        return $this->businessContractorRepository->getCities();
    }
}
