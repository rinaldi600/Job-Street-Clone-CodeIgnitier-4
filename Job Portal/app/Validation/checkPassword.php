<?php

namespace App\Validation;

class checkPassword {
    public function check_password(string $str, string $fields, array $data) {
        $companyModel = new \App\Models\CompanyModel();
        $getEmail = $companyModel->where('emailCompany', $data['email'])->first();
        if (isset($getEmail)) {
            if (password_verify($data['password'], $getEmail['passwordCompany'])) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
