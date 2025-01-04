<?php

namespace App\Controllers;

use App\Models\UserModel;

class SetupCtrl extends BaseController
{
    public function hashPasswords()
    {
        $userModel = new UserModel();

        // Hash the admin password
        $userModel->update(1, ['password' => password_hash('admin', PASSWORD_DEFAULT)]);

        // Hash the customer password
        $userModel->update(2, ['password' => password_hash('fina', PASSWORD_DEFAULT)]);

        return 'Passwords have been hashed successfully!';
    }
}
