<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class CustomerAccounts extends BaseController
{
    public function index(): string
    {
        $customerModel = new CustomerModel();

        return view('customer_accounts/index', [
            'title'     => 'Customer Accounts',
            'customers' => $customerModel->orderBy('id', 'ASC')->findAll(),
        ]);
    }

    public function newForm(): string
    {
        return view('customer_accounts/new', [
            'title'  => 'New Customer',
            'values' => ['full_name' => '', 'email' => '', 'phone' => ''],
            'errors' => [],
        ]);
    }

    public function create()
    {
        $values = [
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'email'     => trim((string) $this->request->getPost('email')),
            'phone'     => trim((string) $this->request->getPost('phone')),
        ];

        $rules = [
            'full_name' => 'required',
            'email'     => 'required|valid_email',
            'phone'     => 'permit_empty',
        ];

        if (! $this->validateData($values, $rules)) {
            return view('customer_accounts/new', [
                'title'  => 'New Customer',
                'values' => $values,
                'errors' => $this->validator->getErrors(),
            ]);
        }

        $values['created_at'] = date('Y-m-d H:i:s');
        (new CustomerModel())->insert($values);

        return redirect()->to(site_url('customer-accounts'));
    }

    public function edit(int $id): string
    {
        $customer = (new CustomerModel())->find($id);

        if (! $customer) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('customer_accounts/new', [
            'title'      => 'Edit Customer',
            'values'     => $customer,
            'errors'     => [],
            'formAction' => 'customers/' . $id,
        ]);
    }

    public function update(int $id)
    {
        $model = new CustomerModel();
        $customer = $model->find($id);

        if (! $customer) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $values = [
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'email'     => trim((string) $this->request->getPost('email')),
            'phone'     => trim((string) $this->request->getPost('phone')),
        ];

        $rules = [
            'full_name' => 'required',
            'email'     => 'required|valid_email',
            'phone'     => 'permit_empty',
        ];

        if (! $this->validateData($values, $rules)) {
            return view('customer_accounts/new', [
                'title'      => 'Edit Customer',
                'values'     => $values,
                'errors'     => $this->validator->getErrors(),
                'formAction' => 'customers/' . $id,
            ]);
        }

        $model->update($id, $values);

        return redirect()->to(site_url('customer-accounts'));
    }
}