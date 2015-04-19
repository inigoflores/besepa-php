<?php
/**
 * Created by PhpStorm.
 * User: asierm
 * Date: 19/4/15
 * Time: 16:13
 */

namespace Besepa\Entity;


class Debit implements EntityInterface{


    public $id;

    public $status;

    public $reference;

    public $description;

    public $collect_at;

    public $amount;

    public $debtor_bank_account_id;

    public $creditor_bank_account_id;

    public $sent_at;

    /**
     * @var Customer
     */
    public $customer;

    /**
     * @var BankAccount
     */
    public $debtor_bank_account;

    /**
     * @var BankAccount
     */
    public $creditor_bank_account;


    /**
     * @param Customer $customer
     */
    public function  setCustomer(Customer $customer){
        $this->customer = $customer;
    }


    /**
     * @param BankAccount $bankAccount
     */
    public function  setDebtorBankAccount(BankAccount $bankAccount){
        $this->debtor_bank_account = $bankAccount;
    }

    /**
     * @param BankAccount $bankAccount
     */
    public function  setCreditorBankAccount(BankAccount $bankAccount){
        $this->creditor_bank_account = $bankAccount;
    }


    function getId(){
        return $this->id;
    }

} 