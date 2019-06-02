<?php
class Elective
{
    private $name;
    private $lecturer;
    private $assistant;
    private $busyness;
    private $description;
    private $requirements;
    private $results;
    private $creator;
    
    public function __construct($jsonBody)
    {
        $parametersArr = json_decode($jsonBody, true);
        
        $this->name         = $parametersArr["name"];
        $this->lecturer     = $parametersArr["lecturer"];
        $this->assistant    = $parametersArr["assistant"];
        $this->busyness     = $parametersArr["busyness"];
        $this->description  = $parametersArr["description"];
        $this->requirements = $parametersArr["requirements"];
        $this->results      = $parametersArr["results"];
        if(isset($parametersArr["creator"])){
             $this->creator      = $parametersArr["creator"];
        }
       
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function getLecturer()
    {
        return $this->lecturer;
    }
    
    public function getAssistant()
    {
        return $this->assistant;
    }
    
    public function getBusyness()
    {
        return $this->busyness;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    public function getRequirements()
    {
        return $this->requirements;
    }
    
    public function getResults()
    {
        return $this->results;
    }
    
    public function getCreator()
    {
        return $this->creator;
    }
}
?>