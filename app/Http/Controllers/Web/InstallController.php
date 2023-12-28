<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\InstallRequest;
use App\Repositories\InstallRepository;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\City;

class InstallController extends Controller
{
    private $installRepository;

    public function __construct(InstallRepository $installRepository)
    {
        $this->installRepository = $installRepository;
    }

    public function store(InstallRequest $request)
    {
        $input = $request->validated();
        $input["serial"] = "#SD-Store:" . substr(Str::uuid(), 0, 5);
        $brand = $this->installRepository->store($input);
        return response()->json("Item created successfully with id : $brand->id");
    }

    public function getAreas()
    {
        return $this->installRepository->getAreas();
    }

    public function getCities()
    {
        return $this->installRepository->getCities();
    }

    public function updateCityStatus(Request $request, $cityId)
    {
        $newStatus = $request->input('status');
        $city = City::find($cityId);

        if (!$city) {
            return response()->json(['error' => 'City not found'], 404);
        }
        $city->status = $newStatus;
        $city->save();
        return response()->json(['message' => 'City status updated successfully']);
    }

}
