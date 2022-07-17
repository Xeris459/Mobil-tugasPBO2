<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class User extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $model = new UserModel();

        $user = $model->findAll();

        $data = [
            "title" => "Admin",
            "page"  => "admin",
            "data"  => $user
        ];

        return view('backend/pages/admin', $data);
    }

    public function create(){
        if(!$this->request->getMethod() == "post") return redirect()->back()->with("error", "illegal http request");

        $rules = [
            'name' => [
                'rules' => 'required',
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    "required" => "{field} harus di isi",
                    "valid_email" => "{field} tidak valid",
                    'is_unique' =>'Email already used'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    "required" => "{field} harus di isi",
                    'min_length' =>'{field} minimal memiliki 8 karakter'
                ]
            ],
            'repassword' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    "required" => "Confirmasi Password harus di isi",
                    'matches' =>'Confirmasi Password tidak sama dengan password field'
                ]
            ],                  
        ];

        if(!$this->validate($rules)) return redirect()->back()->with("error", $this->validation->getErrors());

        $model = new UserModel();

        $data = [
            'username'      => $this->request->getVar('name'),
            'email'         => $this->request->getVar('email'),
            'password'      => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT)
        ];

        $q = $model->save($data);

        if(!$q) return redirect()->back()->with("error", "gagal menyimpan data admin");

        return redirect()->back()->with("success", "berhasil menyimpan data admin");
    }

    public function update(){
        if(!$this->request->getMethod() == "post") return redirect()->back()->with("error", "illegal http request");
        
        $id = $this->request->getVar('id');
        $rules = [
            'name' => [
                'rules' => 'required',
            ],
            'email' => [
                'rules' => "required|valid_email|is_unique[users.email,id,$id]",
                'errors' => [
                    "required" => "{field} harus di isi",
                    "valid_email" => "{field} tidak valid",
                    'is_unique' =>'Email already used'
                ]
            ],                 
        ];

        if(!empty($this->request->getVar("password")) || !empty($this->request->getVar("repassword"))){
            $rules["password"] = ['rules' => 'required|min_length[8]',
                                    'errors' => [
                                        "required" => "{field} harus di isi",
                                        'min_length' =>'{field} minimal memiliki 8 karakter'
                                    ]
                                ];
            $rules["repassword"] = ['rules' => 'required|matches[password]',
                                    'errors' => [
                                        "required" => "Confirmasi Password harus di isi",
                                        'matches' =>'Confirmasi Password tidak sama dengan password field'
                                    ]
                                ];
        }

        if(!$this->validate($rules)) return redirect()->back()->with("error", $this->validator->getErrors());

        $model = new UserModel();

        $data = [
            'username'      => $this->request->getVar('name'),
            'email'         => $this->request->getVar('email'),
            'id'            => $id
        ];

        if(!empty($this->request->getVar("password"))) $data["password"] = password_hash($this->request->getVar('password'), PASSWORD_BCRYPT);

        $q = $model->save($data);

        if(!$q) return redirect()->back()->with("error", "gagal merubah data admin");

        return redirect()->back()->with("success", "berhasil merubah data admin");
    }

    public function detail($id){
        if($this->request->isAJAX()){
            if(!is_null($id)){
                $model = new UserModel();
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
                $model = new UserModel();
                $data = $model->find($id);
        
                if($data){
                    $model->delete($id);
                    $response = [
                        'status'   => 200,
                        'error'    => null,
                        'messages' => [
                            'success' => 'Data Deleted',
                            'message' => $model->errors()
                        ]
                    ];
                    
                    return $this->respondDeleted($response);
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