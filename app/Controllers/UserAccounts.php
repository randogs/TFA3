<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class UserAccounts extends BaseController
{
    public function index(): string
    {
        $userModel = new UserModel();

        return view('user_accounts/index', [
            'title' => 'User Accounts',
            'users' => $userModel->orderBy('id', 'ASC')->findAll(),
        ]);
    }

    public function newForm(): string
    {
        return view('user_accounts/new', [
            'title'  => 'New User',
            'values' => ['username' => '', 'full_name' => ''],
            'errors' => [],
        ]);
    }

    public function create()
    {
        $values = [
            'username'  => trim((string) $this->request->getPost('username')),
            'full_name' => trim((string) $this->request->getPost('full_name')),
        ];

        $rules = [
            'username'  => 'required|max_length[50]|is_unique[users.username]',
            'full_name' => 'required|max_length[100]',
        ];

        if (! $this->validateData($values, $rules)) {
            return view('user_accounts/new', [
                'title'  => 'New User',
                'values' => $values,
                'errors' => $this->validator->getErrors(),
            ]);
        }

        $values['created_at'] = date('Y-m-d H:i:s');
        (new UserModel())->insert($values);

        return redirect()->to(site_url('user-accounts'));
    }

    public function edit(int $id): string
    {
        $user = (new UserModel())->find($id);

        if (! $user) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('user_accounts/new', [
            'title'      => 'Edit User',
            'values'     => $user,
            'errors'     => [],
            'formAction' => 'users/' . $id,
        ]);
    }

    public function update(int $id)
    {
        $model = new UserModel();
        $user = $model->find($id);

        if (! $user) {
            throw PageNotFoundException::forPageNotFound();
        }

        $values = [
            'username'  => trim((string) $this->request->getPost('username')),
            'full_name' => trim((string) $this->request->getPost('full_name')),
        ];

        $avatar = $this->request->getFile('avatar');
        $hasNewAvatar = $avatar !== null
            && $avatar->getError() !== UPLOAD_ERR_NO_FILE;

        $rules = [
            'username'  => "required|max_length[50]|is_unique[users.username,id,{$id}]",
            'full_name' => 'required|max_length[100]',
        ];

        if ($hasNewAvatar) {
            $rules['avatar'] = 'uploaded[avatar]|is_image[avatar]'
                . '|mime_in[avatar,image/jpeg,image/png]'
                . '|ext_in[avatar,jpg,jpeg,png]'
                . '|max_size[avatar,2048]';
        }

        if (! $this->validateData($values, $rules)) {
            return view('user_accounts/new', [
                'title'      => 'Edit User',
                'values'     => array_merge($user, $values),
                'errors'     => $this->validator->getErrors(),
                'formAction' => 'users/' . $id,
            ]);
        }

        if ($hasNewAvatar) {
            $folder = FCPATH . 'uploads/avatars/';

            if (! is_dir($folder) && ! mkdir($folder, 0755, true)) {
                throw new \RuntimeException('Could not create the avatar folder.');
            }

            $extension = $avatar->getMimeType() === 'image/png' ? 'png' : 'jpg';
            $filename = bin2hex(random_bytes(16)) . '.' . $extension;

            if (extension_loaded('gd')) {
                service('image')
                    ->withFile($avatar->getTempName())
                    ->fit(150, 150, 'center')
                    ->save($folder . $filename);
            } else {
                $avatar->move($folder, $filename);
            }

            $values['avatar'] = $filename;
        }

        $model->update($id, $values);

        return redirect()->to(site_url('user-accounts'));
    }
}