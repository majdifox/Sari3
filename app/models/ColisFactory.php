<?php
namespace App\Models;


class ColisFactory {
    


    public function createColis($ColisData) {
       return new Colis($ColisData['id'] = null,$expediteur_id,$ColisData['itineare_id'],$ColisData['destination'],$ColisData['volume'],$ColisData['poids'],$ColisData['date_depart'],$ColisData['date_arriver'],$ColisData['status'],$ColisData['etat']);
    }
    public function getColis($id) {
        $ColisData =   Colis::get($id);
        if ($colis) {
         return  $this->createColis($ColisData['id'],$expediteur_id,$ColisData['itineare_id'],$ColisData['destination'],$ColisData['volume'],$ColisData['poids'],$ColisData['date_depart'],$ColisData['date_arriver'],$ColisData['status'],$ColisData['etat']);
        }else{
         echo 'not found';
        }
    }
    public function AcceptColis($id){
       $colis = $this->getColis($id);
       $colis->accept();
    }
    public function RefuseColis($id){
       $colis = $this->getColis($id);
       $colis->refuse();
    }
    public function getColisByExpediteur($id) {
        // $sql = "SELECT * FROM colis WHERE expediteur_id = :expediteur_id";
        // $stmt = $this->db->prepare($sql);
        // $stmt = $this->db->bindParam(':expediteur_id',$id);
       
    }
    public function getColisByVillesANDExpediteur($ville,$id) {
        // $sql = "SELECT * FROM colis WHERE expediteur_id = :expediteur_id";
        // $stmt = $this->db->prepare($sql);
        // $stmt = $this->db->bindParam(':expediteur_id',$id);
        // $stmt->exectute();
        // $Colis = $stmt->fetchAll(PDO::FETCH_OBJ);
        // $list = [];
        // $i = 0;
        // foreach ($Colis as $coli) {
        //  $list[$i] = $this->createColis($colis);
        //  $i++;
        // } 
        // return $list;
    }
    public function addColis($ColisData){
      $colis =   $this->createColis($ColisData);
      $colis->create();

    }
    public function CountAll(){
        $colis= Colis::CountAll();
        return $colis;
    }
    public function CountByStatus($status){
        $colis= Colis::CountByStatus($status);
        return $colis;
    }
    public function RecentColis(){
        $colis= Colis::getRecentColis();
        return $colis;
    }

}

