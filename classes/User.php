<?php
class User extends Model
{
    
    protected static $table = 'users';

    private $_sessionName;

    private $_cookieName;

    private $_data =[];

    private $_isLoggedIn = false;

    public function __construct($id='')
    {
        $this->_sessionName = Config::get('session/sessionName');
        $this->_cookieName = Config::get('cookie/cookieName');

        if(!$id)
        {
            if(Session::exists($this->_sessionName))
            {
                if($this->_data = $this->find($id))
                {
                    $this->_isLoggedIn = true;
                }
            }
        }else{
            $this->_data = $this->find($id);
        }
    }

    public function login($username = null, $password = null)
    {
        if($username)
        {
            $user = $this->find($username);
            if($user)
            {
                if(Hash::check($password, $user->password))
                {
                    Session::set($this->_sessionName, $user->id);
                    return true;
                }
            }
        }
        return false;
    }

    public function data()
    {
        return $this->_data;
    }

    public function logout()
    {
        Session::delete($this->_sessionName);
    }


}