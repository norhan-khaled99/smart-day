<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\RecruitmentRepository;

class RecruitmentController extends Controller
{
    private $recruitmentRepository;
    public function __construct(RecruitmentRepository $recruitmentRepository)
    {
        $this->middleware('auth:admin');
        $this->recruitmentRepository = $recruitmentRepository;
    }
    public function delete($id)
    {
        $brand = $this->recruitmentRepository->delete($id);
        return response()->json("Item with id : $brand->id deleted successfully");
    }

    public function index()
    {
        $text = isset(request()->text) ? request()->text : '';
        return $this->recruitmentRepository->getRecruitments($text, request()->page_size, request()->status);
    }
    public function find($id)
    {
        return $this->recruitmentRepository->geRecruitment($id);
    }
}
