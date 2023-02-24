<?php
Class Nameform{
    public $Name;
    public function __construct($names){
        if(!empty($names))
            $this->Name = explode("\n", $names);
        else
            $this->Name = array();
    }
    public function Set_Name($name){
        $FullName=explode(" ",$name);
        if (count($FullName)>2){
            $last= array_pop($FullName);
            array_push($this->Name, $last.", ".implode(" ",$FullName));
        } else
            array_push($this->Name, $FullName[1].", ".$FullName[0]);
        sort($this->Name);
                return $this->Name;
    }
}
?>
