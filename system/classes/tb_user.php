<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 06/06/2018
 * Time: 15:35
 */

class tb_user
{
    private $id_user;
    private $str_login;
    private $str_senha;
    private $str_name;
    private $str_email;
    private $int_reset;
    private $int_adm;

    /**
     * tb_user constructor.
     * @param $id_user
     * @param $str_login
     * @param $str_senha
     * @param $str_name
     * @param $str_email
     * @param $int_reset
     * @param $int_adm
     */
    public function __construct($id_user, $str_login, $str_senha, $str_name, $str_email, $int_reset, $int_adm)
    {
        $this->id_user = $id_user;
        $this->str_login = $str_login;
        $this->str_senha = $str_senha;
        $this->str_name = $str_name;
        $this->str_email = $str_email;
        $this->int_reset = $int_reset;
        $this->int_adm = $int_adm;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id_user
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }

    /**
     * @return mixed
     */
    public function getStrLogin()
    {
        return $this->str_login;
    }

    /**
     * @param mixed $str_login
     */
    public function setStrLogin($str_login)
    {
        $this->str_login = $str_login;
    }

    /**
     * @return mixed
     */
    public function getStrSenha()
    {
        return $this->str_senha;
    }

    /**
     * @param mixed $str_senha
     */
    public function setStrSenha($str_senha)
    {
        $this->str_senha = $str_senha;
    }

    /**
     * @return mixed
     */
    public function getStrName()
    {
        return $this->str_name;
    }

    /**
     * @param mixed $str_name
     */
    public function setStrName($str_name)
    {
        $this->str_name = $str_name;
    }

    /**
     * @return mixed
     */
    public function getStrEmail()
    {
        return $this->str_email;
    }

    /**
     * @param mixed $str_email
     */
    public function setStrEmail($str_email)
    {
        $this->str_email = $str_email;
    }

    /**
     * @return mixed
     */
    public function getIntReset()
    {
        return $this->int_reset;
    }

    /**
     * @param mixed $int_reset
     */
    public function setIntReset($int_reset)
    {
        $this->int_reset = $int_reset;
    }

    /**
     * @return mixed
     */
    public function getIntAdm()
    {
        return $this->int_adm;
    }

    /**
     * @param mixed $int_adm
     */
    public function setIntAdm($int_adm)
    {
        $this->int_adm = $int_adm;
    }

}