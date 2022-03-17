<?php


namespace App\Services\Discounts\Forms;


class CmsDiscountCreateFormBuilder extends CmsDiscountFormBuilder
{
    public function getFields()
    {
        $fields = [
            $this->fields['name'],
            $this->fields['active_from'],
            $this->fields['active_to'],
            $this->fields['discount_type'],
            $this->fields['discount_value'],
            $this->fields['groups'],
        ];

        return $fields;
    }

    public function getMethod()
    {
        return 'POST';
    }
}
