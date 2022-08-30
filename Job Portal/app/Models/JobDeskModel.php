<?php

namespace App\Models;

use CodeIgniter\Model;

class JobDeskModel extends Model
{
    protected $table      = 'job_desk';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $useSoftDeletes = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['idJob', 'idCompany', 'namaJob', 'deskripsiJob'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
