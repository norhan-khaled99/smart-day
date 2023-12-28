<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RecruitmentRequest;
use App\Repositories\RecruitmentRepository;

class RecruitmentController extends Controller
{
    private $recruitmentRepository;
    public function __construct(RecruitmentRepository $recruitmentRepository)
    {
        $this->recruitmentRepository = $recruitmentRepository;
    }
    public function store(RecruitmentRequest $request)
    {

        $brand = $this->recruitmentRepository->store($request->validated());
        return response()->json("Item created successfully with id : $brand->id");
    }
}
