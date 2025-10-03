<?php

namespace App\Controllers;

use App\Models\Anggota;
use App\Models\Penggajian;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class AnggotaController extends BaseController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index(){       
        $model = new Anggota();
        $keyword = $this->request->getGet('keyword');
        if ($keyword) {
            $model->orLike('id_anggota', $keyword);
            $model->orLike('nama_depan', $keyword);
            $model->orLike('nama_belakang', $keyword);
            $model->orLike('jabatan', $keyword);
        }
        $data['datas'] = $model->findAll();
        return view('anggota/index', $data);
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
        return view('anggota/create');
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
         $validation = $this->validate([
            'id_anggota' => 'required|numeric',
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'jabatan' => 'required',
            'status_pernikahan' => 'required',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = $this->request->getPost();

        $anggotaModel = new Anggota();
        $anggotaModel->insert($data);
        return redirect()->to('/anggota');
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
        $anggotaModel = new Anggota();
        $data['data'] = $anggotaModel->find($id);
        
        return view('anggota/edit', $data);
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
        $anggotaModel = new Anggota();
        $data = $this->request->getPost();

        $anggotaModel->update($id, $data);
        return redirect()->to('/anggota');
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
        $anggotaModel = new Anggota();
        $penggajianModel = new Penggajian();

        $penggajianModel->where('id_anggota', $id)->delete();
        $anggotaModel->delete($id);
        return redirect()->to('/anggota');
    }
}
