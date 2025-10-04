<?php

namespace App\Controllers;

use App\Models\Anggota;
use App\Models\KomponenGaji;
use App\Models\Penggajian;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class PenggajianController extends BaseController
{
    public function get_komponen_gaji_data($id)
    {
        $anggotaModel = new Anggota();
        $anggota = $anggotaModel->find($id);

        $komponenGajiModel = new KomponenGaji();
        $komponenGaji = $komponenGajiModel->orWhere('jabatan', $anggota['jabatan'])->orWhere('jabatan', 'Semua')->findAll();
        return $komponenGaji;
    }
    public function get_komponen_gaji($id)
    {
        return $this->response->setJSON($this->get_komponen_gaji_data($id));
    }
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $anggotaModel =  new Penggajian();


        $keyword = $this->request->getGet('keyword');



        $data['datas'] = $anggotaModel->getPenggajian($keyword);


        for ($i = 0; $i < count($data['datas']); $i++) {
            // TODO: hitung harian
            // TODO: tambah take home pay harian ke per-bulan
            // TODO: tambah take home pay harian ke per-periode
            $data['datas'][$i]['take_home_pay_periode'] += $data['datas'][$i]['take_home_pay_monthly'] * 60;
        }
        return view('penggajian/index', $data);
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
        $anggotaModel = new Anggota();


        $data['penggajian'] = $anggotaModel
            ->join('penggajian', 'anggota.id_anggota = penggajian.id_anggota', 'left')
            ->join('komponen_gaji', 'penggajian.id_komponen_gaji = komponen_gaji.id_komponen_gaji', 'inner')
            ->where('anggota.id_anggota', $id)->findAll();

        $data['nama'] = $data['penggajian'][0]['nama_depan'] . ' ' . $data['penggajian'][0]['nama_belakang'];

        $data['totalBulanan'] = 0;
        $data['totalPeriode'] = 0;

        foreach ($data['penggajian'] as $penggajian) {
            if ($penggajian['satuan'] == 'Bulan') {
                $data['totalBulanan'] += $penggajian['nominal'];
            } else if ($penggajian['satuan'] == 'Periode') {
                $data['totalPeriode'] += $penggajian['nominal'];
            }
        }

        // 1 periode
        $data['totalPeriode'] += $data['totalBulanan'] * 60;

        return view('penggajian/show', $data);
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        $anggotaModel = new Anggota();
        /**
         *  LEFT JOIN penggajian p ON p.id_anggota = a.id_anggota 
         *  WHERE p.id_komponen_gaji IS NULL 
         */
        $data['anggota'] = $anggotaModel->join('penggajian', 'anggota.id_anggota = penggajian.id_anggota', 'left')
            ->where('penggajian.id_komponen_gaji', null)
            ->select('anggota.id_anggota, anggota.nama_depan, anggota.nama_belakang')
            ->findAll();
        return view('penggajian/create', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $input = $this->request->getPost();

        $input['penggajian'] = array_filter($input['penggajian'], function ($value) {
            return !empty($value);
        });

        if (empty($input['penggajian'])) {
            return redirect()->back()->with('errors', ['komponen penggajian' => 'Penggajian tidak boleh kosong']);
        }

        $penggajianModel = new Penggajian();
        $insertData = [];

        foreach ($input['penggajian'] as  $value) {
            $insertData[] = [
                'id_anggota' => $input['id_anggota'],
                'id_komponen_gaji' => $value
            ];
        }

        $penggajianModel->insertBatch($insertData);
        return redirect()->to('/penggajian');
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
        $anggota = $anggotaModel
            ->join('penggajian', 'anggota.id_anggota = penggajian.id_anggota', 'inner')
            ->join('komponen_gaji', 'penggajian.id_komponen_gaji = komponen_gaji.id_komponen_gaji', 'inner')
            ->where('penggajian.id_anggota', $id)
            ->findAll($id);

        $data['anggota'] = $anggota[0];
        $data['penggajian'] = $anggota;

        return view('penggajian/edit', $data);
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
        $input = $this->request->getPost();
        $input['penggajian'] = array_filter($input['penggajian'], function ($value) {
            return !empty($value);
        });

        if (empty($input['penggajian'])) {
            return redirect()->back()->with('errors', ['komponen penggajian' => 'Penggajian tidak boleh kosong']);
        }


        $penggajianModel = new Penggajian();
        $penggajianModel->where('id_anggota', $id)->delete();

        $insertData = [];
        foreach ($input['penggajian'] as  $value) {
            $insertData[] = [
                'id_anggota' => $id,
                'id_komponen_gaji' => $value
            ];
        }

        $penggajianModel->insertBatch($insertData);

        return redirect()->to('/penggajian');
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
        $penggajianModel = new Penggajian();

        $penggajianModel->where('id_anggota', $id)->delete();
        return redirect()->to('/penggajian');
    }
}
