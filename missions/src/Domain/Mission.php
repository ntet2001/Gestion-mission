<?php 

/**
 * Here is my class "mission"
 * @var $lieu; 
 * @var $dateMission;
 * @var $titre;
 * @var $annexe;
 * @var $descriptions;
 * @var $statut;
 * @var $rapportid;
 * @var $employeid;
 */
class Mission {
    private $lieu; 
    private $dateMission;
    private $titre;
    private $annexe;
    private $descriptions;
    private $statut;
    private $rapportid;
    private $employeid;

    function __construct($lieu,$dateMission,$titre,$annexe,$descriptions,$statut,$rapportid,$employeid)
    {
        $this->lieu = $lieu;   
        $this->dateMission = $dateMission;   
        $this->titre = $titre;   
        $this->annexe = $annexe;   
        $this->descriptions = $descriptions;   
        $this->statut = $statut;   
        $this->rapportid = $rapportid;   
        $this->employeid = $employeid;   
    }

    // function qui permet de recuperer la liste des infos de mission
    public function infoMission () : array
    {
        $datas["lieu"] =  $this->lieu;
        $datas["dateMission"] =  $this->dateMission;
        $datas["titre"] =  $this->titre;
        $datas["annexe"] =  $this->annexe;
        $datas["descriptions"] =  $this->descriptions;
        $datas["statut"] =  $this->statut;
        $datas["rapportId"] =  $this->rapportid;
        $datas["employeId"] =  $this->employeid;

        return $datas;
    }
}