<?php

namespace App\Models;

use CodeIgniter\Model;

class Penggajian extends Model
{
    protected $table            = 'penggajian';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_anggota', 'id_komponen_gaji'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getPenggajian($keyword)
    {
        $subQueryBuilder = $this->db->table('anggota');
        $subquery = $subQueryBuilder->join('penggajian', 'anggota.id_anggota = penggajian.id_anggota', 'inner')
            ->join('komponen_gaji', 'penggajian.id_komponen_gaji = komponen_gaji.id_komponen_gaji', 'inner')
            ->groupBy('anggota.id_anggota')
            ->select( // kondisi komponen masih di hardcode, harusnya nambah kolom baru buat pengkondisian. Tapi karena gak boleh nambah kolom baru, ini yang paling memungkinkan
                "
                anggota.id_anggota as id,
                anggota.*, 
                SUM(
                    CASE 
                        WHEN 
                            komponen_gaji.satuan = 'Bulan' 
                            AND (komponen_gaji.nama_komponen != 'Tunjangan Istri/Suami' OR
                                ( komponen_gaji.nama_komponen = 'Tunjangan Istri/Suami' AND anggota.status_pernikahan = 'Kawin' )) 
                            AND (komponen_gaji.nama_komponen != 'Tunjangan Anak' OR 
                                ( komponen_gaji.nama_komponen = 'Tunjangan Anak' AND (anggota.jumlah_anak > 0)))
                            THEN 
                                CASE WHEN komponen_gaji.nama_komponen = 'Tunjangan Anak' 
                                    THEN komponen_gaji.nominal * LEAST(GREATEST(anggota.jumlah_anak, 0), 2)
                                ELSE komponen_gaji.nominal
                                END
                        ELSE 0 
                    END
                ) as take_home_pay_monthly, 
                SUM(
                    CASE 
                        WHEN komponen_gaji.satuan = 'periode' THEN komponen_gaji.nominal 
                        ELSE 0 
                    END
                ) as take_home_pay_periode"
            );

        $cur = $this->db->newQuery()->fromSubquery($subquery, 'penggajian');
        if ($keyword) {
            $cur->orLike('id', $keyword);
            $cur->orLike('nama_depan', $keyword);
            $cur->orLike('nama_belakang', $keyword);
            $cur->orLike('jabatan', $keyword);
            $cur->orLike('take_home_pay_monthly', $keyword);
            $cur->orLike('take_home_pay_periode', $keyword);
        }

        
        $res = $cur->get()->getResultArray();

        return $res;
    }
}
