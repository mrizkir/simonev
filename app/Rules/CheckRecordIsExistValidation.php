<?php 

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckRecordIsExistValidation implements Rule 
{
    /**
     * nama table
     * 
     * @var string
     */
    private $tableName;
    /**
     * nama atribut table yang akan dicek
     * 
     * @var string
     */
    private $attributes;
    /**
     * custom parameter for where clause
     * 
     * @var string
     */
    private $clauses = null;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($tableName,$clauses = null)
    {
        $this->tableName=$tableName;
        $this->clauses=$clauses;
    }
        /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attributes
     * @param  mixed  $value
     * @return bool
     */
    public function passes ($attributes, $value) 
    {     
        $this->attributes=$attributes;
        $table = \DB::table($this->tableName);   
        if(is_array($this->clauses))
        {            
            foreach ($this->clauses as $k=>$v)
            {
                switch ($k)
                {
                    case 'where' :
                        $table->where([$v]);
                    break;
                }
            }            
        }
        $bool = !($table->where($attributes,$value)->count() > 0);
        return $bool;
    }
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message () 
    {
        return "Mohon maaf data untuk {$this->attributes} yang di inputkan sudah tersedia. Mohon ganti dengan yang lain";
    }
}