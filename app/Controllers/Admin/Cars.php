<?php

namespace App\Controllers\Admin;

use CodeIgniter\API\ResponseTrait;
use App\Models\CarsModel;
use App\Models\BrandModel;
use App\Models\DetailModel;
use App\Controllers\BaseController;

class Cars extends BaseController
{
    use ResponseTrait;
    protected $path = 'media/upload';
    public function index()
    {
        $model = new CarsModel();
        $brandModel = new BrandModel();

        $cars = $model->select("cars.title, cars.detail, cars.status, cars.created_at, brand.title as brand, cars.id")
                        ->join("brand", "brand.id = cars.brand_id")->findAll();
        $brand = $brandModel->where("status", "publish")->find();

        $data = [
            "title" => "Cars",
            "page"  => "Cars",
            "data"  => $cars,
            "brand" => $brand
        ];

        return view('backend/pages/cars', $data);
    }

    public function create(){
        // dd($this->request->getVar());

        if(!$this->request->getMethod() == "post") return redirect()->back()->with("error", "illegal http request");

        $rules = [
            'title' => [
                'rules' => 'required',
            ],
            'brand' => [
                'rules' => 'required',
            ],
            'detail' => [
                'rules' => 'required',
            ],
            'status' => [
                'rules' => 'required|alpha|in_list[publish,unpublish]',
            ],
            'file' => [
                'rules' => 'is_image[file]|max_size[file,2048]|mime_in[file,image/png,image/jpg,image/jpeg]|ext_in[file,png,jpg,jpeg]',
            ]
        ];

        if(!$this->validate($rules)) return redirect()->back()->with("error", $this->validation->getErrors());

        $file = $this->request->getFile('file');

        if(!$file->isValid()) return redirect()->back()->with("error", "Mobil Thumbnail tidak valid");

        $model = new CarsModel();
        $detailModel = new DetailModel();
        $new_name = $file->getRandomName();

        $file->move($this->path, $new_name);

        $model->db->transBegin();

        $dataCar = [
            'image'     =>  $new_name,
            'detail'    =>  $this->request->getVar('detail'),
            'title'     =>  $this->request->getVar('title'),
            'brand_id'  =>  $this->request->getVar('brand'),
            'status'    =>  $this->request->getVar('status')
        ];

        $q = $model->save($dataCar);
        $id = $model->getInsertID();

        if(!empty($this->request->getVar("field")) && !empty($this->request->getVar("value"))){
            $field = $this->request->getVar("field");
            $value = $this->request->getVar("value");
            $dataDetail = [];

            foreach ($field  as $key => $val) {
                $dataDetail[] = [
                    "car_id" => $id,
                    "title" => $val,
                    "value" => $value[$key]
                ];
            }

            $detailModel->insertBatch($dataDetail);
        }

        if ($model->db->transStatus() === false) {
            $model->db->transRollback();
            return redirect()->back()->with("error", "gagal menyimpan data Mobil");
        } else {
            $model->db->transCommit();
            return redirect()->back()->with("success", "berhasil menyimpan data Mobil");
        }
    }

    public function detail($id){
        if($this->request->isAJAX()){
            if(!is_null($id)){
                $model = new CarsModel();
                $detailModel = new DetailModel();
                $data = $model->find($id);
        
                if($data){
                    $response = [
                        'status'   => 200,
                        'error'    => null,
                        'result' => $data,
                        "more_detail" => $detailModel->where("car_id", $id)->find()
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

    public function update(){
        // dd($this->request->getVar());
        if(!$this->request->getMethod() == "post") return redirect()->back()->with("error", "illegal http request");

        $file = $this->request->getFile('file');
        $model = new CarsModel();
        $detailModel = new DetailModel();

        $tempDetail = $detailModel->where("car_id", $this->request->getVar('id'))->find();

        $dataCar = [
            'id'        =>  $this->request->getVar('id'),
            'detail'    =>  $this->request->getVar('detail'),
            'title'     =>  $this->request->getVar('title'),
            'brand_id'  =>  $this->request->getVar('brand'),
            'status'    =>  $this->request->getVar('status')
        ];

        $rules = [
            'title' => [
                'rules' => 'required',
            ],
            'brand' => [
                'rules' => 'required',
            ],
            'detail' => [
                'rules' => 'required',
            ],
            'status' => [
                'rules' => 'required|alpha|in_list[publish,unpublish]',
            ],
        ];

        if(!empty($file->getName())) 
            $rules["file"] = ['rules' => 'is_image[file]|max_size[file,2048]|mime_in[file,image/png,image/jpg,image/jpeg]|ext_in[file,png,jpg,jpeg]'];

        if(!$this->validate($rules)) return redirect()->back()->with("error", $this->validation->getErrors());

        if(!empty($file->getName())) {
            if(!$file->isValid()) return redirect()->back()->with("error", "Mobil Thumbnail tidak valid");

            $temp = $model->find($this->request->getVar("id"));

            if(!empty($temp->image))
                if(file_exists("$this->path/$temp->image"))
                    unlink("$this->path/$temp->image");

            $new_name = $file->getRandomName();

            $file->move($this->path, $new_name);

            $dataCar["image"] = $new_name;
        }

        $model->db->transBegin();
        $model->save($dataCar);

        if(!empty($this->request->getVar("field")) && !empty($this->request->getVar("value"))){
            $field = $this->request->getVar("field");
            $value = $this->request->getVar("value");
            $fieldid = $this->request->getVar("fieldID");
            
            $dataDetailUpdpate = [];
            $dataDetailSave = [];
            $listDetailID = [];

            foreach ($field  as $key => $val) {
                if(empty($fieldid[$key]) && (!empty($value[$key]) || !empty($val))){
                    $dataDetailSave[] = [
                        "car_id" => $this->request->getVar('id'),
                        "title" => $val,
                        "value" => $value[$key]
                    ];

                    continue;
                }
                
                if(!empty($fieldid[$key])){
                    $dataDetailUpdpate[] = [
                        "title" => $val,
                        "value" => $value[$key]
                    ];
                
                    $dataDetailUpdpate[$key]["id"] =  $fieldid[$key];
                    $listDetailID[] = $fieldid[$key];
                }
            }

            // dd($dataDetailSave);
            if($dataDetailUpdpate) $detailModel->updateBatch($dataDetailUpdpate, "id");
            
            if($listDetailID)
                $detailModel->where("car_id", $this->request->getVar('id'))->whereNotIn("id", $listDetailID)->delete();

            if($dataDetailSave) $detailModel->insertBatch($dataDetailSave);

        } else {
            if(!empty($tempDetail))
                $detailModel->where("car_id", $this->request->getVar('id'))->delete();
        }

        if ($model->db->transStatus() === false) {
            $model->db->transRollback();
            return redirect()->back()->with("error", "gagal menyimpan data Mobil");
        } else {
            $model->db->transCommit();
            return redirect()->back()->with("success", "berhasil menyimpan data Mobil");
        }
    }

    public function delete($id){
        if($this->request->isAJAX()){
            if(!is_null($id)){
                $model = new CarsModel();
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
                        if(!empty($data->image))
                            if(file_exists("$this->path/$data->image"))
                                unlink("$this->path/$data->image");

                        $model = new DetailModel();
                        $model->where("car_id", $id)->delete();
                                
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