<?php

namespace WebSite\Model;


use Website\Controller\AbstractBaseController;

class ProfsManager extends AbstractBaseController
{

    public static $conn;

    public function __construct()
    {
        self::$conn = $this->getConnection();
    }

    public function addCours($matiere,$id,$debutCours,$finCours, $date){
        $statement = self::$conn->prepare('INSERT INTO cours (matieres, prof_id, debut_cours, fin_cours, date) Values (:matiere, :prof_id, :debut_cours, :fin_cours, :date)');
        $statement->execute([
            'matiere' => $matiere,
            'prof_id' => $id,
            'debut_cours' => $debutCours,
            'fin_cours' => $finCours,
            'date' => $date
        ]);
    }

    public function deleteCours($id){
        $statement = self::$conn->prepare('DELETE FROM cours WHERE  cours_id = :id');
        $statement->execute([
            'id'=>$id
        ]);
    }

    public function modifyCoursTime($id,$debutCours,$finCours){
        $statement = self::$conn->prepare('UPDATE cours SET debut_cours = :debut_cours, fin_cours = :fin_cours WHERE cours_id = :id');
        $statement->execute([
            'id' => $id,
            'debut_cours' => $debutCours,
            'fin_cours' => $finCours
        ]);
    }

    public function modifyCoursDate($id,$date){
        $statement = self::$conn->prepare('UPDATE cours SET date = :date WHERE cours_id = :id');
        $statement->execute([
            'id' => $id,
            'date' => $date
        ]);
    }

    public function modifyCoursSubject($id,$matiere){
        $statement = self::$conn->prepare('UPDATE cours SET matieres = :matiere WHERE cours_id = :id');
        $statement->execute([
            'id' => $id,
            'matiere' => $matiere
        ]);
    }

    public function showAllCours(){
        $statement = self::$conn->prepare('SELECT cours_id,matieres,debut_cours,fin_cours,date,nom FROM cours c INNER JOIN users u ON u.user_id = c.prof_id');
        $statement->execute();
        $response = $statement->fetchAll();
        return $response;
    }

    public function showCoursByDate($date){
        $statement = self::$conn->prepare('SELECT * FROM cours WHERE date = :date');
        $statement->execute(['date'=>$date]);
        $response = $statement->fetchAll();
        return $response;
    }

    public function showCoursBySubject($matiere){
        $statement = self::$conn->prepare('SELECT cours_id,matieres,debut_cours,fin_cours,date,nom FROM cours c INNER JOIN users u ON u.user_id = c.prof_id WHERE matieres = :matiere');
        $statement->execute(['matiere'=>$matiere]);
        $response = $statement->fetchAll();
        return $response;
    }

    public function showCoursForTeacher($id){
        $statement = self::$conn->prepare(' SELECT cours_id,matieres,debut_cours,fin_cours,date FROM cours WHERE prof_id = :id');
        $statement->execute(['id' => $id]);
        $response = $statement->fetchAll();
        return $response;
    }

    public function followers($id){
        $statement = self::$conn->prepare('SELECT matieres,date,nom FROM cours_users p INNER JOIN cours c ON c.cours_id = p.id_cours INNER JOIN users u ON u.user_id = p.user_id WHERE c.cours_id = :id  ');
        $statement->execute(['id' => $id]);
        $response = $statement->fetchAll();
        return $response;
    }


}