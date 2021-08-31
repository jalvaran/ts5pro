<?php

namespace App\Libraries;

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
        $this->session = session();
        $this->user=$this->session->get("user");
        $this->avatar=$this->session->get("avatar");
        /** etc **/
        if(empty($this->user)){
            $this->session->set("user",$this->anonymous);
        }
    }



    public function login($username,$password){
        $return=false;
        $musers=model('App\Modules\Access\Models\Users');
        $user=$musers->get_UserLogin($username,$password);

        if(isset($user[0]["id"])){
            $this->set("user",$user[0]["id"]);
            $this->set("user_name",$user[0]["name"]);
            $this->set("user_designation",$user[0]["designation"]);
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
        $this->session->set($name,$value);
    }

    public function get($name)
    {
        return($this->session->get($name));
    }

}
