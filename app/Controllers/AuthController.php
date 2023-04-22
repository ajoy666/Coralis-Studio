<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\TokenModel;

class AuthController extends BaseController
{
    protected $helpers = ['form'];

    public function home()
    {
        $data = ['title' => 'Profile'];
        return view('home', $data);
    }

    public function login()
    {
        $data = ['title' => 'Login'];
        return view('auth/login', $data);
    }

    public function process()
    {
        $users = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $dataUser = $users->where(['email' => $email])->first();

        if (!$this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email field must be filled',
                    'valid_email' => 'Email must be valid',
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password field must be filled'
                ]
            ],
        ])) {
            return redirect()->back()->withInput();
        }

        if ($dataUser) {
            if (password_verify($password, $dataUser->password)) {
                session()->set([
                    'email' => $dataUser->email,
                    'surename' => $dataUser->surename,
                    'ava' => $dataUser->ava,
                    'logged_in' => true
                ]);
                return redirect()->to(base_url('home'));
            } else {
                session()->setFlashdata('error', 'Email & Password Not Matched');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('error', 'Email is not registered');
            return redirect()->back();
        }
    }

    public function register()
    {
        $data = ['title' => 'Register',];
        return view('auth/register', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'surename' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Name field must be filled'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email field must be filled',
                    'valid_email' => 'Email must be valid',
                    'is_unique' => 'Email already exist'
                ]
            ],
            'ava' => [
                'rules' => 'uploaded[ava]|max_size[ava,3072]|is_image[ava]|mime_in[ava,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Image field must be filled',
                    'max_size' => 'Image must be under 3 mb',
                    'is_image' => 'Your file is not an image',
                    'mime_in' => 'Image file must be jpg/jpeg/png'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password field must be filled'
                ]
            ],
            'cpassword' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Password field must be filled',
                    'matches' => 'Password must match'
                ]
            ],
        ])) {
            return redirect()->to('register')->withInput();
        }

        $users = new UserModel();

        $ava = $this->request->getFile('ava');
        $avaName = $ava->getRandomName();
        $ava->move('avatar', $avaName);

        $users->insert([
            'surename' => $this->request->getVar('surename'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'ava' => $avaName
        ]);

        session()->setFlashdata('message', 'Register completed, please login');
        return redirect()->to('login');
    }

    function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function forgot()
    {
        $data = ['title' => 'Forgot Password',];
        return view('forgotPass/forgot_password', $data);
    }

    private function sendEmail($tkn)
    {

        $email = \Config\Services::email();
        $title = 'Reset Password';
        $message = 'Click this link to reset your password : <a href="' . base_url() . 'reset-password?email=' . $this->request->getVar('email') . '&token=' . urlencode($tkn) . '"> Reset Password </a>';

        $email->setFrom('azifauzi000@gmail.com');
        $email->setTo($this->request->getVar('email'));

        $email->setSubject($title);
        $email->setMessage($message);

        if ($email->send()) {
            return false;
        } else {
            return true;
        }
    }

    public function forgotSend()
    {
        if (!$this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email field must be filled',
                    'valid_email' => 'Email must be valid',
                ]
            ],
        ])) {
            return redirect()->back()->withInput();
        }

        $users = new UserModel();
        $tokens = new TokenModel();

        $tkn = base64_encode(random_bytes(32));
        $email = $this->request->getVar('email');
        $dataUser = $users->where(['email' => $email])->first();


        if ($dataUser) {
            $tokens->insert([
                'email' => $this->request->getVar('email'),
                'token' => $tkn,
                'created_at' => time()
            ]);

            $this->sendEmail($tkn);
            session()->setFlashdata('message', 'Please check your email to reset password');
            return redirect()->to('forgot-password');
        } else {
            session()->setFlashdata('error', 'Your email has not registered');
            return redirect()->back();
        }
    }

    public function reset()
    {
        $users = new UserModel();
        $tokens = new TokenModel();

        $email = $this->request->getVar('email');
        $token = $this->request->getVar('token');

        $data = ['title' => 'Reset Password'];
        $dataUser = $users->where(['email' => $email])->first();

        if ($dataUser) {
            $dataToken = $tokens->where(['token' => $token])->first();
            if ($dataToken) {
                session()->set(['email' => $dataUser->email, 'token' => $dataToken->token]);
            } else {
                session()->setFlashdata('error', 'Your token has wrong');
                return redirect()->to('login');
            }
        } else {
            session()->setFlashdata('error', 'Your email has wrong');
            return redirect()->to('login');
        }
        return view('forgotPass/reset_password', $data);
    }

    public function changePass()
    {
        if (!$this->validate([
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password field must be filled'
                ]
            ],
            'cpassword' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Password field must be filled',
                    'matches' => 'Password must match'
                ]
            ],
        ])) {
            return redirect()->back()->withInput();
        }

        $password = password_hash($this->request->getVar('password'), PASSWORD_BCRYPT);
        $email = session()->get('email');

        $users = new UserModel();
        $users->where('email', $email)->set('password', $password)->update();

        session()->setFlashdata('message', 'Password has been updated, please login');
        return redirect()->to('login');
    }
}
