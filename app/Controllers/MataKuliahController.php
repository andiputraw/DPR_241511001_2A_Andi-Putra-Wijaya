<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MataKuliahModel;

class MataKuliahController extends BaseController
{
    public function index()
    {
        $model = new MataKuliahModel();
        $data['mata_kuliah'] = $model->findAll();
        return view('mata_kuliah/index', $data);
    }

    public function new()
    {
        return view('mata_kuliah/create');
    }

    public function create()
    {
        $validation = $this->validate([
            'name' => 'required',
            'credits' => 'required|numeric|less_than_equal_to[4]|greater_than_equal_to[0]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new MataKuliahModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'credits' => $this->request->getPost('credits'),
        ];
        $model->insert($data);
        return redirect()->to('/mata-kuliah');
    }

    public function show($id)
    {
        $model = new MataKuliahModel();
        $data['mata_kuliah'] = $model->find($id);
        return view('mata_kuliah/show', $data);
    }

    public function edit($id)
    {
        $model = new MataKuliahModel();
        $data['mata_kuliah'] = $model->find($id);
        return view('mata_kuliah/edit', $data);
    }

    public function update($id)
    {
        $validation = $this->validate([
            'name' => 'required',
            'credits' => 'required|numeric|less_than_equal_to[4]|greater_than_equal_to[0]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new MataKuliahModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'credits' => $this->request->getPost('credits'),
        ];
        $model->update($id, $data);
        return redirect()->to('/mata-kuliah');
    }

    public function delete($id)
    {
        $model = new MataKuliahModel();
        $model->delete($id);
        return redirect()->to('/mata-kuliah');
    }
}
