<?php

namespace App\Controllers;

use App\Models\KomponenGaji;
use App\Models\Penggajian;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class KomponenGajiController extends BaseController
{
    private $validationRules = [
            'id_komponen_gaji' => 'required|numeric',
            'nama_komponen' => 'required',
            'nominal' => 'required',
            'kategori' => 'required',
            'satuan' => 'required',
            'jabatan' => 'required',
    ];

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $model = new KomponenGaji();
        $keyword = $this->request->getGet('keyword');
        if($keyword) {
            $model->orLike('id_komponen_gaji', $keyword);
            $model->orLike('nama_komponen', $keyword);
            $model->orLike('kategori', $keyword);
            $model->orLike('jabatan', $keyword);
            $model->orLike('nominal', $keyword);
            $model->orLike('satuan', $keyword);
        }
        $data['datas'] = $model->findAll();
        return view('komponen_gaji/index', $data);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        return view('komponen_gaji/create');
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $validation = $this->validate($this->validationRules);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = $this->request->getPost();

        $komponenGaji = new KomponenGaji();
        $komponenGaji->insert($data);
        return redirect()->to('/komponen-gaji');
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
     
        $model = new KomponenGaji();
        $data['data'] = $model->find($id);
        return view('komponen_gaji/edit', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        
        $validation = $this->validate($this->validationRules);
        
        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $model = new KomponenGaji();

        $data = $this->request->getPost();
        $model->update($id, $data);
        return redirect()->to('/komponen-gaji');
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        $komponenGajiModel = new KomponenGaji();
        $penggajianModel = new Penggajian();

        $penggajianModel->where('id_komponen_gaji', $id)->delete();
        $komponenGajiModel->delete($id);
        return redirect()->to('/komponen-gaji');
    }
}
