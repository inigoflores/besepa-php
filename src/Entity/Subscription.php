<?php
/**
 * Created by PhpStorm.
 * User: asierm
 * Date: 19/4/15
 * Time: 16:13
 */

namespace Besepa\Entity;


class Subscription implements EntityInterface{


    public $id;

    public $status;

    public $starts_at;

    public $setup_fee;

    public $product_id;

    public $bank_account_id;

    public $metadata;


    /**
     * @var Customer
     */
    public $customer;

    /**
     * @var BankAccount
     */
    public $debtor_bank_account;

    /**
     * @var Product
     */
    public $product;


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
     * @param Product $product
     */
    public function  setProduct(Product $product){
        $this->product = $product;
    }


    function getId(){
        return $this->id;
    }

} 