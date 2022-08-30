<?php

namespace App\Models;

use CodeIgniter\Model;

class CVModel extends Model
{
    protected $table      = 'cv';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['idCV', 'idUser', 'idJob', 'idResume'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}
