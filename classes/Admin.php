<?php 
class Admin extends Model
{
    protected static $table = 'admins';


    private $_sessionName = 'ADM1NS3SS10NNAM3';

    private $_cookieName;

    private $_data =[];

    private $_isLoggedIn = false;

    public function __construct($id='')
    {

        if(!$id)
        {
            if(Session::exists($this->_sessionName))
            {
                $id = Session::get($this->_sessionName);
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

    public function isLoggedIn()
    {
        return $this->_isLoggedIn;
    }


}