<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 09/05/2018
 * Time: 13:52
 */

class tb_payments
{
    private $id_payment;
    private $tb_city_id_city;
    private $tb_functon_id_function;
    private $tb_subfunction_id_subfunction;
    private $tb_program_id_program;
    private $tb_action_id_action;
    private $tb_beneficiaries_id_beneficiaries;
    private $tb_source_id_source;
    private $tb_files_id_file;
    private $db_value;

    /**
     * tb_payments constructor.
     * @param $id_payment
     * @param $tb_city_id_city
     * @param $tb_functon_id_function
     * @param $tb_subfunction_id_subfunction
     * @param $tb_program_id_program
     * @param $tb_action_id_action
     * @param $tb_beneficiaries_id_beneficiaries
     * @param $tb_source_id_source
     * @param $tb_files_id_file
     * @param $db_value
     */
    public function __construct($id_payment, $tb_city_id_city, $tb_functon_id_function, $tb_subfunction_id_subfunction, $tb_program_id_program, $tb_action_id_action, $tb_beneficiaries_id_beneficiaries, $tb_source_id_source, $tb_files_id_file, $db_value)
    {
        $this->id_payment = $id_payment;
        $this->tb_city_id_city = $tb_city_id_city;
        $this->tb_functon_id_function = $tb_functon_id_function;
        $this->tb_subfunction_id_subfunction = $tb_subfunction_id_subfunction;
        $this->tb_program_id_program = $tb_program_id_program;
        $this->tb_action_id_action = $tb_action_id_action;
        $this->tb_beneficiaries_id_beneficiaries = $tb_beneficiaries_id_beneficiaries;
        $this->tb_source_id_source = $tb_source_id_source;
        $this->tb_files_id_file = $tb_files_id_file;
        $this->db_value = $db_value;
    }

    /**
     * @return mixed
     */
    public function getIdPayment()
    {
        return $this->id_payment;
    }

    /**
     * @param mixed $id_payment
     */
    public function setIdPayment($id_payment): void
    {
        $this->id_payment = $id_payment;
    }

    /**
     * @return mixed
     */
    public function getTbCityIdCity()
    {
        return $this->tb_city_id_city;
    }

    /**
     * @param mixed $tb_city_id_city
     */
    public function setTbCityIdCity($tb_city_id_city): void
    {
        $this->tb_city_id_city = $tb_city_id_city;
    }

    /**
     * @return mixed
     */
    public function getTbFunctonIdFunction()
    {
        return $this->tb_functon_id_function;
    }

    /**
     * @param mixed $tb_functon_id_function
     */
    public function setTbFunctonIdFunction($tb_functon_id_function): void
    {
        $this->tb_functon_id_function = $tb_functon_id_function;
    }

    /**
     * @return mixed
     */
    public function getTbSubfunctionIdSubfunction()
    {
        return $this->tb_subfunction_id_subfunction;
    }

    /**
     * @param mixed $tb_subfunction_id_subfunction
     */
    public function setTbSubfunctionIdSubfunction($tb_subfunction_id_subfunction): void
    {
        $this->tb_subfunction_id_subfunction = $tb_subfunction_id_subfunction;
    }

    /**
     * @return mixed
     */
    public function getTbProgramIdProgram()
    {
        return $this->tb_program_id_program;
    }

    /**
     * @param mixed $tb_program_id_program
     */
    public function setTbProgramIdProgram($tb_program_id_program): void
    {
        $this->tb_program_id_program = $tb_program_id_program;
    }

    /**
     * @return mixed
     */
    public function getTbActionIdAction()
    {
        return $this->tb_action_id_action;
    }

    /**
     * @param mixed $tb_action_id_action
     */
    public function setTbActionIdAction($tb_action_id_action): void
    {
        $this->tb_action_id_action = $tb_action_id_action;
    }

    /**
     * @return mixed
     */
    public function getTbBeneficiariesIdBeneficiaries()
    {
        return $this->tb_beneficiaries_id_beneficiaries;
    }

    /**
     * @param mixed $tb_beneficiaries_id_beneficiaries
     */
    public function setTbBeneficiariesIdBeneficiaries($tb_beneficiaries_id_beneficiaries): void
    {
        $this->tb_beneficiaries_id_beneficiaries = $tb_beneficiaries_id_beneficiaries;
    }

    /**
     * @return mixed
     */
    public function getTbSourceIdSource()
    {
        return $this->tb_source_id_source;
    }

    /**
     * @param mixed $tb_source_id_source
     */
    public function setTbSourceIdSource($tb_source_id_source): void
    {
        $this->tb_source_id_source = $tb_source_id_source;
    }

    /**
     * @return mixed
     */
    public function getTbFilesIdFile()
    {
        return $this->tb_files_id_file;
    }

    /**
     * @param mixed $tb_files_id_file
     */
    public function setTbFilesIdFile($tb_files_id_file): void
    {
        $this->tb_files_id_file = $tb_files_id_file;
    }

    /**
     * @return mixed
     */
    public function getDbValue()
    {
        return $this->db_value;
    }

    /**
     * @param mixed $db_value
     */
    public function setDbValue($db_value): void
    {
        $this->db_value = $db_value;
    }
}