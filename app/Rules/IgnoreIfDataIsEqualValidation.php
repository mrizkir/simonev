<?php 

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IgnoreIfDataIsEqualValidation implements Rule 
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
    private $attributes_alias;
    /**
     * nilai lama
     * 
     * @var string
     */
    private $oldValue;
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
    public function __construct($tableName,$oldValue=null,$clauses = null,$atributes_alias=null)
    {
        $this->tableName=$tableName;
        $this->oldValue=$oldValue;
        $this->clauses=$clauses;
        $this->attributes_alias=$atributes_alias;
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
        $table = \DB::table($this->tableName);  
        if (strtolower($value) == strtolower($this->oldValue)) 
        {
            return true;
        }
        elseif(is_array($this->clauses))
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
        return "Mohon maaf data {$this->attributes_alias} yang di inputkan sudah tersedia. Mohon ganti dengan yang lain";
    }
}