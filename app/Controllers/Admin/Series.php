<?php

namespace App\Controllers\Admin;

use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Models\SeriesModel;
use App\Models\BrandModel;

class Series extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $model = new SeriesModel();
        $brandModel = new BrandModel();

        $series = $model->select("series.id, series.title, brand.title as brand, series.created_at, series.status")->join("brand", "brand.id = series.brand_id")->findAll();
        $brand = $brandModel->where("status", "publish")->find();

        $data = [
            "title" => "Series",
            "page"  => "Series",
            "data"  => $series,
            "brand" => $brand
        ];

        return view('backend/pages/series', $data);
    }

    public function create(){
        if(!$this->request->getMethod() == "post") return redirect()->back()->with("error", "illegal http request");

        $rules = [
            'title' => [
                'rules' => 'required',
            ],
            'brand' => [
                'rules' => 'required',
            ],
            'status' => [
                'rules' => 'required|alpha|in_list[publish,unpublish]',
            ],
        ];

        if(!$this->validate($rules)) return redirect()->back()->with("error", $this->validation->getErrors());

        $model = new SeriesModel();

        $data = [
            'brand_id'  =>  $this->request->getVar('brand'),
            'title'     =>  $this->request->getVar('title'),
            'status'    =>  $this->request->getVar('status')
        ];

        $q = $model->save($data);

        if(!$q) return redirect()->back()->with("error", "gagal menyimpan data brand");

        return redirect()->back()->with("success", "berhasil menyimpan data brand");
    }

    public function update(){
        if(!$this->request->getMethod() == "post") return redirect()->back()->with("error", "illegal http request");

        $rules = [
            'title' => [
                'rules' => 'required|alpha_numeric_space',
            ],
            'brand' => [
                'rules' => 'required',
            ],
            'status' => [
                'rules' => 'required|alpha|in_list[publish,unpublish]',
            ],
        ];

        if(!$this->validate($rules)) return redirect()->back()->with("error", $this->validation->getErrors());

        $model = new SeriesModel();

        $data = [
            "id"        =>  $this->request->getVar("id"),
            'brand_id'  =>  $this->request->getVar('brand'),
            'title'     =>  $this->request->getVar('title'),
            'status'    =>  $this->request->getVar('status')
        ];

        $q = $model->save($data);

        if(!$q) return redirect()->back()->with("error", "gagal menyimpan data brand");

        return redirect()->back()->with("success", "berhasil menyimpan data brand");
    }

    public function detail($id){
        if($this->request->isAJAX()){
            if(!is_null($id)){
                $model = new SeriesModel();
                $data = $model->find($id);
        
                if($data){
                    $response = [
                        'status'   => 200,
                        'error'    => null,
                        'result' => $data
                    ];
                    
                    return $this->respond($response);
                }else{
                    return $this->fail('No Data Found with id '.$id, 200, 400);
                }
            } else {
                return $this->fail('bad request', 200, 401);
            }
        } else {
            return $this->fail('You do not have authorization to enter this page', 401);
        }
    }

    public function delete($id){
        if($this->request->isAJAX()){
            if(!is_null($id)){
                $model = new SeriesModel();
                $data = $model->find($id);
        
                if($data){
                    $q = $model->delete($id);
                    $response = [
                        'status'   => 200,
                        'error'    => null,
                        'messages' => [
                            'success' => 'Data Deleted',
                            'message' => $model->errors()
                        ]
                    ];

                    if($q){
                        return $this->respondDeleted($response);
                    }
                }else{
                    return $this->fail('No Data Found with id '.$id, 200, 400);
                }
            } else {
                return $this->fail('bad request', 200, 401);
            }
        } else {
            return $this->fail('You do not have authorization to enter this page', 401);
        }
    }
}