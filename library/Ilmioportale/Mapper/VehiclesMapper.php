<?php

namespace Ilmioportale\Mapper;

use DateTime;
use Exception;
use Ilmioportale\Absctracts\Connection;
use PDO;
use PDOException;

class VehiclesMapper extends Connection
{

    /**
     * @var PDO
     */
    private $conn;

    private const SELECT = ' SELECT * FROM vehicles ';
    private const FIND = ' SELECT * FROM vehicles where id = :id ';
    private const INSERT = ' INSERT INTO vehicles (classe, targa, modello, scad_assicurazione, scad_bollo, scad_revisione, km_ult_rev) VALUES (:classe, :targa, :modello, :scad_assicurazione, :scad_bollo, :scad_revisione, :km_ult_rev)';
    private const UPDATE = ' UPDATE vehicles SET classe = :classe, targa = :targa, modello = :modello, scad_assicurazione = :scad_assicurazione, scad_bollo = :scad_bollo, scad_revisione = :scad_revisione, km_ult_rev = :km_ult_rev WHERE id = :id ';
    private const DELETE = ' DELETE FROM vehicles WHERE id = :id ';

    /**
     * VehiclesMapper constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->conn = parent::__construct($config);
    }


    /**
     * @return array|bool
     */
    public function fetchAll()
    {
        try {
            $stmt = $this->conn->prepare(self::SELECT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function find($id)
    {
        try {
            $stmt = $this->conn->prepare(self::FIND);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }

    /**
     * @param $classe
     * @param $targa
     * @param $modello
     * @param $scad_assicurazione
     * @param $scad_bollo
     * @param $scad_revisione
     * @param $km_ult_rev
     * @return bool
     */
    public function insert($classe, $targa, $modello, $scad_assicurazione, $scad_bollo, $scad_revisione, $km_ult_rev)
    {
        try {
            $stmt = $this->conn->prepare(self::INSERT);
            $stmt->bindParam(':classe', $classe);
            $stmt->bindParam(':targa', $targa);
            $stmt->bindParam(':modello', $modello);
            $stmt->bindParam(':scad_assicurazione', $scad_assicurazione);
            $stmt->bindParam(':scad_bollo', $scad_bollo);
            $stmt->bindParam(':scad_revisione', $scad_revisione);
            $stmt->bindParam(':km_ult_rev', $km_ult_rev);
            $stmt->execute();
            /*echo "New records created successfully";*/
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }

    /**
     * @param $classe
     * @param $targa
     * @param $modello
     * @param $scad_assicurazione
     * @param $scad_bollo
     * @param $scad_revisione
     * @param $km_ult_rev
     * @param $id
     * @return bool
     */
    public function update($classe, $targa, $modello, $scad_assicurazione, $scad_bollo, $scad_revisione, $km_ult_rev, $id)
    {
        try {
            $stmt = $this->conn->prepare(self::UPDATE);
            $stmt->bindParam(':classe', $classe);
            $stmt->bindParam(':targa', $targa);
            $stmt->bindParam(':modello', $modello);
            $stmt->bindParam(':scad_assicurazione', $scad_assicurazione);
            $stmt->bindParam(':scad_bollo', $scad_bollo);
            $stmt->bindParam(':scad_revisione', $scad_revisione);
            $stmt->bindParam(':km_ult_rev', $km_ult_rev);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            /*echo "Records update successfully";*/
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        try {
            $stmt = $this->conn->prepare(self::DELETE);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            /*echo "Records delete successfully";*/
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }


    /**
     * @return array|bool
     */
    public function fetchAllView()
    {
        try {
            $stmt = $this->conn->prepare(self::SELECT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $rows = [];
            echo "<div class='container-fluid' style='padding-top: 50px'>";
            echo "<table class=\"table table-striped\" style='background: #fff'>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>CLASSE</th>";
            echo "<th>TARGA</th>";
            echo "<th>MODELLO</th>";
            echo "<th>SCADENZA ASSICURAZIONE</th>";
            echo "<th>SCADENZA BOLLO</th>";
            echo "<th>SCADENZA REVISIONE</th>";
            echo "<th>KM ULTIMA REVISIONE</th>";
            echo "</tr>";
            foreach ($result as $row) {
                $format = 'd-m-Y';
                $rowAssicurazione = $row['scad_assicurazione'];
                $rowBollo = $row['scad_bollo'];
                $rowRevisione = $row['scad_revisione'];
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['classe'] . "</td>";
                echo "<td>" . $row['targa'] . "</td>";
                echo "<td>" . $row['modello'] . "</td>";
                echo "<td>" . $this->dateFormatAssicurazione($rowAssicurazione, $format) . "</td>";
                echo "<td>" . $this->dateFormatBollo($rowBollo, $format) . "</td>";
                echo "<td>" . $this->dateFormatRevisione($rowRevisione, $format) . "</td>";
                echo "<td>" . $row['km_ult_rev'] . "</td>";
                echo "</tr>";
                echo "</div>";
                $rows[] = $row;
            }
            return $rows ;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }

    /**
     * @param $id
     * @return array|bool
     */
    public function findView($id)
    {
        try {
            $stmt = $this->conn->prepare(self::FIND);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $rows = [];
            echo "<div class='container-fluid' style='padding-top: 50px'>";
            echo "<table class=\"table table-striped\" style='background: #fff'>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>CLASSE</th>";
            echo "<th>TARGA</th>";
            echo "<th>MODELLO</th>";
            echo "<th>SCADENZA ASSICURAZIONE</th>";
            echo "<th>SCADENZA BOLLO</th>";
            echo "<th>SCADENZA REVISIONE</th>";
            echo "<th>KM ULTIMA REVISIONE</th>";
            echo "</tr>";
            foreach ($result as $row) {
                $format = 'd-m-Y';
                $rowAssicurazione = $row['scad_assicurazione'];
                $rowBollo = $row['scad_bollo'];
                $rowRevisione = $row['scad_revisione'];
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['classe'] . "</td>";
                echo "<td>" . $row['targa'] . "</td>";
                echo "<td>" . $row['modello'] . "</td>";
                echo "<td>" . $this->dateFormatAssicurazione($rowAssicurazione, $format) . "</td>";
                echo "<td>" . $this->dateFormatBollo($rowBollo, $format) . "</td>";
                echo "<td>" . $this->dateFormatRevisione($rowRevisione, $format) . "</td>";
                echo "<td>" . $row['km_ult_rev'] . "</td>";
                echo "</tr>";
                echo "</div>";
                $rows[] = $row;
            }
            return $rows;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }

    public function findViewIndex($id)
    {
        try {
            $stmt = $this->conn->prepare(self::FIND);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $rows = [];
            foreach ($result as $row) {
                $format = 'd-m-Y';
                $rowAssicurazione = $row['scad_assicurazione'];
                $rowBollo = $row['scad_bollo'];
                $rowRevisione = $row['scad_revisione'];
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['classe'] . "</td>";
                echo "<td>" . $row['targa'] . "</td>";
                echo "<td>" . $row['modello'] . "</td>";
                echo "<td>" . $this->dateFormatAssicurazione($rowAssicurazione, $format) . "</td>";
                echo "<td>" . $this->dateFormatBollo($rowBollo, $format) . "</td>";
                echo "<td>" . $this->dateFormatRevisione($rowRevisione, $format) . "</td>";
                echo "<td>" . $row['km_ult_rev'] . "</td>";
                echo "</tr>";
                $rows[] = $row;
            }
            return $rows;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }

    ###########################  FUNZIONI PER IL FORMAT DELLA DATA ASSICURAZIONE, BOLLO, REVISIONE ###########################

    /**
     * @param $rowAssicurazione
     * @param $format
     * @return bool|false|string
     */
    private function dateFormatAssicurazione($rowAssicurazione, $format)
    {
        try {
            $scadAssicurazione = new DateTime($rowAssicurazione);
            $scadAssicurazione = date_format($scadAssicurazione, $format);
            return $scadAssicurazione;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }

    /**
     * @param $rowBollo
     * @param $format
     * @return bool|false|string
     */
    private function dateFormatBollo($rowBollo, $format)
    {
        try {
            $scadBollo = new DateTime($rowBollo);
            $scadBollo = date_format($scadBollo, $format);
            return $scadBollo;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }

    /**
     * @param $rowRevisione
     * @param $format
     * @return bool|false|string
     */
    private function dateFormatRevisione($rowRevisione, $format)
    {
        try {
            $scadRevisione = new DateTime($rowRevisione);
            $scadRevisione = date_format($scadRevisione, $format);
            return $scadRevisione;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }

    public function dataMsgVehicles($dataType, $idVehicles)
    {
        try {
            $stmt = $this->conn->prepare(self::FIND);
            $stmt->bindParam(':id', $idVehicles);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $rows = [];
            foreach ($result as $row) {
                $format = 'd-m-Y';
                $rowAssicurazione = $row['scad_assicurazione'];
                $rowBollo = $row['scad_bollo'];
                $rowRevisione = $row['scad_revisione'];
                 $row['id'];
                 $row['classe'] ;
                 $row['targa'] ;
                 $row['modello'] ;
                 $this->dateFormatAssicurazione($rowAssicurazione, $format);
                 $this->dateFormatBollo($rowBollo, $format);
                 $this->dateFormatRevisione($rowRevisione, $format);
                 $row['km_ult_rev'];
                $rows[] = $row;
            }
            switch ($dataType){
                case 'id' :
                    return $row['id'];
                case 'classe' :
                    return $row['classe'] ;
                case 'targa' :
                    return $row['targa'];
                case 'modello' :
                    return  $row['modello'];
                case 'scad_assicurazione' :
                    return  $this->dateFormatAssicurazione($rowAssicurazione, $format);
                case 'scad_bollo' :
                    return  $this->dateFormatBollo($rowBollo, $format);
                case 'scad_revisione' :
                    return $this->dateFormatRevisione($rowRevisione, $format);
                case 'km_ult_rev' :
                    return $row['km_ult_rev'];
                default :
                    return $rows;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return TRUE;
    }
}