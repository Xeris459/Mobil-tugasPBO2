<?php

namespace App\Controllers;
use CodeIgniter\Exceptions\PageNotFoundException;

class Home extends BaseController
{
    public function index()
    {
        $brandModel = new \App\Models\BrandModel;
        $carsModel = new \App\Models\CarsModel;
        $bannerModel = new \App\Models\BannerModel;

        $data = [
            "brand" => $brandModel->select("id, image")->where("status", "publish")->find(),
            "banner" => $bannerModel->select("image")->where("status", "publish")->find(),
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

    public function detail($id)
    {
        $carsModel = new \App\Models\CarsModel;
        $brandModel = new \App\Models\BrandModel;
        $detailModel = new \App\Models\DetailModel;

        $detail = $carsModel->select("cars.id, cars.image, cars.title, brand.title as brand, brand_id, cars.detail")
                            ->join("brand", "brand.id = cars.brand_id")
                            ->where("cars.status", "publish")
                            ->where("cars.id", $id)
                            ->first();
        if(!$detail) throw new PageNotFoundException("Mobil Tidak ditemukan");
        
        $brand = $brandModel->find($detail->brand_id);
        $cars = $carsModel->select("cars.id, cars.image, cars.title, brand.title as brand, cars.detail")
                            ->join("brand", "brand.id = cars.brand_id")
                            ->where("cars.status", "publish")
                            ->like("cars.title", $this->request->getVar("model") ?? "")
                            ->like("cars.brand_id", $this->request->getVar("brand") ?? $id ??"")
                            ->find();
        $carDetail = $detailModel->where("car_id", $detail->id)->find();
        $data = [
            "cars"  => $cars,
            "brand" => $brand,
            "detail" => $detail,
            "carDetail" => $carDetail
        ];    

        return view('frontend/pages/detail', $data);
    }

    public function login()
    {
        return view('backend/pages/login');
    }
}