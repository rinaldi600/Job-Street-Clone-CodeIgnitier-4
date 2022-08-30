<?php

namespace App\Validation;

class getEmail {
    public function email_company(string $str, string $fields, array $data) {
        $companyModel = new \App\Models\CompanyModel();
        $getEmail = $companyModel->where('emailCompany', $data['email'])->first();
        if (isset($getEmail)) {
            return true;
        } else {
            return false;
        }
    }
}
