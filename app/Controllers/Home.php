<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $brandModel = new \App\Models\BrandModel;
        $carsModel = new \App\Models\CarsModel;

        $data = [
            "brand" => $brandModel->select("id, image")->where("status", "publish")->find(),
            "cars" => $carsModel->select("cars.id, cars.image, cars.title, brand.title as brand, cars.detail")
                                    ->join("brand", "brand.id = cars.brand_id")->where("cars.status", "publish")->find()
        ];

        return view('frontend/pages/home', $data);
    }

    public function search($id = null)
    {
        $brandModel = new \App\Models\BrandModel;
        $carsModel = new \App\Models\CarsModel;

        $cars = $carsModel->select("cars.id, cars.image, cars.title, brand.title as brand, cars.detail")
                            ->join("brand", "brand.id = cars.brand_id")
                            ->where("cars.status", "publish")
                            ->like("cars.title", $this->request->getVar("model") ?? "")
                            ->like("cars.brand_id", $this->request->getVar("brand") ?? $id ??"")
                            ->find();
        $brandDetail = $brandModel->find($id);

        $data = [
            "brand" => $brandModel->select("id, title")->where("status", "publish")->find(),
            "cars"  => $cars,
            "isBrand" => !empty($id),
            "brandDetail" => $brandDetail,
            "model" => $this->request->getVar("model") ?? "",
            "currentBrand" => $this->request->getVar("brand") ?? $id ?? ""
        ];

        return view('frontend/pages/search', $data);
    }

    public function detail()
    {
        return view('frontend/pages/detail');
    }

    public function login()
    {
        return view('backend/pages/login');
    }
}