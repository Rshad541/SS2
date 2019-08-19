<?php
require_once '../core/init.php';

$admin = new Admin();

if($admin->isLoggedIn())
{
    Redirect::to('dashboard');
}

if(Input::exists())
{
    if(Token::check(Input::get('token')))
    {
        $validate = new Validate();
        $validation = $validate->check($_POST,[
            'username' =>[
                'display' => 'Username',
                'required' => 'true'
            ],
            'password' =>[
                'display' => 'Password',
                'required' => 'true'
            ],
        ]);

        if($validation->passed())
        {
            $login = $admin->login(Input::get('username'),Input::get('password'));

            if($login)
            {
                Redirect::to('dashboard');
            }
        }
    }
}



View::start('head');
View::end('head'); ?>
<div class="conrainer mt-5">
    <div class="card w-50 m-auto ">
        <div class="card-header bg-primary text-white">
                Cpanel Login
        </div> <!-- card header -->
        <div class="card-body">
            <form method="post" action="" >
                <!-- Username Field -->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                    </div> <!-- input group prepend -->
                        <input type="text" class="form-control" placeholder="Username" autofocus value="<?= escape(Input::get('username')) ?>" name="username">
                    </div> <!-- input group -->
                    <!-- Username Field -->
                    <!-- Password Field -->
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                      </div> <!-- input group prepend -->
                      <input type="password" class="form-control" placeholder="Password" name="password" required="required" >
                    </div> <!-- input group -->
                    <!-- Password Field -->
                    <!-- Button And Token Field -->
                    <input type="hidden" name="token" value="<?= Token::generate(); ?>">
                    <button class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Login</button>
                    <!-- Button And Token Field -->
                </form>
            </div> <!-- card body -->
    </div> <!-- card -->
</div>      <!-- container -->



<?php 
View::start('body');
View::end('body');