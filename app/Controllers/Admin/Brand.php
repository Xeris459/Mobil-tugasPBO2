<?php

namespace App\Controllers\Admin;

use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Models\BrandModel;

class Brand extends BaseController
{
    use ResponseTrait;
    
    protected $path = 'media/upload';
    public function index()
    {
        $model = new brandModel();

        $user = $model->findAll();

        $data = [
            "title" => "Brand",
            "page"  => "Brand",
            "data"  => $user
        ];

        return view('backend/pages/brand', $data);
    }

    public function create(){
        if(!$this->request->getMethod() == "post") return redirect()->back()->with("error", "illegal http request");

        $rules = [
            'title' => [
                'rules' => 'required|alpha_numeric_space',
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

        if(!$file->isValid()) return redirect()->back()->with("error", "Brand banner tidak valid");

        $model = new brandModel();
        $new_name = $file->getRandomName();

        $file->move($this->path, $new_name);

        $data = [
            'image'     =>  $new_name,
            'detail'    =>  $this->request->getVar('detail'),
            'title'     =>  $this->request->getVar('title'),
            'status'    =>  $this->request->getVar('status')
        ];

        $q = $model->save($data);

        if(!$q) return redirect()->back()->with("error", "gagal menyimpan data brand");

        return redirect()->back()->with("success", "berhasil menyimpan data brand");
    }

    public function update(){
        if(!$this->request->getMethod() == "post") return redirect()->back()->with("error", "illegal http request");

        $file = $this->request->getFile('file');
        $model = new brandModel();

        $data = [
            "id"        =>  $this->request->getVar("id"),
            'detail'    =>  $this->request->getVar('detail'),
            'title'     =>  $this->request->getVar('title'),
            'status'    =>  $this->request->getVar('status')
        ];

        $rules = [
            'title' => [
                'rules' => 'required|alpha_numeric_space',
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
            if(!$file->isValid()) return redirect()->back()->with("error", "Brand banner tidak valid");

            $temp = $model->find($this->request->getVar("id"));

            if(!empty($temp->image))
                if(file_exists("$this->path/$temp->image"))
                    unlink("$this->path/$temp->image");

            $new_name = $file->getRandomName();

            $file->move($this->path, $new_name);

            $data["image"] = $new_name;
        }

        $q = $model->save($data);

        if(!$q) return redirect()->back()->with("error", "gagal menyimpan data brand");

        return redirect()->back()->with("success", "berhasil menyimpan data brand");
    }

    public function detail($id){
        if($this->request->isAJAX()){
            if(!is_null($id)){
                $model = new BrandModel();
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
                $model = new BrandModel();
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