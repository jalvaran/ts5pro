<?php

namespace App\Modules\TS5\Libraries;

class Session
{
    private $session;//<- Session Framework
    private $user;
    private $avatar;
    private $host;
    private $anonymous="anonymous";
    private $theme;
    private $theme_color;
    private $default_url;
    private $logo;
    private $logo_portrait;
    private $logo_landscape;
    /** Thirdparty */
    private $fb_app_id;
    private $fb_app_secret;
    private $fb_page;

    public function __construct()
    {
        @session_start();
        //$this->session = session();
        if(isset($_SESSION["user"])){
            $this->user=$_SESSION["user"];
        }

        //$this->avatar=$this->session->get("avatar");
        /** etc **/
        if(empty($this->user)){
            $_SESSION["user"]=$this->anonymous;
            //$this->session->set("user",$this->anonymous);
        }
    }



    public function login($username,$password){
        $return=false;
        $musers=model('App\Modules\Access\Models\Users');
        $user=$musers->get_UserLogin($username,$password);

        if(isset($user["id"])){

            $this->set("user",$user["id"]);
            $this->set("user_name",$user["name"]);
            $this->set("user_designation",$user["designation"]);
            return(true);
        }

        return($return);
    }

    /**
     * Si existe un usuario con sesion activa retorna falso o verdadero segun el caso
     * @return bool
     */
    public function get_LoggedIn(){
        if($this->user!=$this->anonymous){
            return(true);
        }else{
            return(false);
        }
    }

    public function set($name,$value)
    {
        //$this->session->set($name,$value);
        $_SESSION[$name]=$value;
    }

    public function get($name)
    {
        //return($this->session->get($name));
        if(isset($_SESSION[$name])){
            return($_SESSION[$name]);
        }else{
            return('');
        }

    }

    /**
     * @return mixed
     */
    public function session_destroy()
    {
        if(isset($_SESSION["user"])){
            session_destroy();
        }
    }

}
