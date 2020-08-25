<?php

namespace Ilmioportale\Controller;

use Ilmioportale\Mapper\VehiclesMapper;

class VehiclesController
{

    /**
     * @var VehiclesMapper
     */
    private $vehiclesMapper;

    /**
     * VehiclesController constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->vehiclesMapper = new VehiclesMapper($config);
    }

    public function fetchAllView()
    {
        $this->vehiclesMapper->fetchAllView() ;
    }

    public function fetchAllViewGestionale()
    {
        if (isset($_POST['submitListaVeicoli'])) {
            $this->vehiclesMapper->fetchAllView();
        }
    }


    /**
     * @return array|bool|string
     */
    public function findViewVehicles()
    {
        $text = 'Si prega di inserire un ID del veicolo corretto! ';
        $message = '<script type="text/javascript">
			alert("' . $text . '")
			</script>';
        if (isset($_POST['searchVehicles'])) {
            $id = $_POST['id'];
            $result = $this->vehiclesMapper->findView($id);
            if ($id != 0 && $id != null) {
                return $result;
            } else {
                echo $message;
            }
        }
    }

    public function findViewVehiclesIndex($id)
    {
            return $this->vehiclesMapper->findViewIndex($id);
    }

    public function insertVehicles()
    {
        $textValid = 'Inserimento effettuato con successo ';
        $messageValid = '<script type="text/javascript">
			alert("' . $textValid . '")
			</script>';

        $textError = 'Si prega di inserire i campi obbligatori ';
        $messageError = '<script type="text/javascript">
			alert("' . $textError . '")
			</script>';

        if (isset($_POST['insertSubmitVehicles'])) {
            $classe = strtoupper($_POST['classe']);
            $targa = strtoupper($_POST['targa']);
            $modello = strtoupper($_POST['modello']);
            $scad_assicurazione = $_POST['scad_assicurazione'];
            $scad_bollo = $_POST['scad_bollo'];
            $scad_revisione = $_POST['scad_revisione'];
            $km_ult_rev = $_POST['km_ult_rev'];
            if (
                $classe != null && $classe != ''
                && $targa != null && $targa != ''
                && $modello != null && $modello != ''
                && $scad_assicurazione != null && $scad_assicurazione != ''
                && $scad_bollo != null && $scad_bollo != ''
                && $scad_revisione != null && $scad_revisione != ''
                && $km_ult_rev != null && $km_ult_rev != 0
            ) {
                $this->vehiclesMapper->insert($classe, $targa, $modello, $scad_assicurazione, $scad_bollo, $scad_revisione, $km_ult_rev);
                echo $messageValid;
            } else {
                echo $messageError;
            }
        }
    }

    public function deleteVehicles()
    {
        $textValid = 'Cancellazione effettuata con successo ';
        $messageValid = '<script type="text/javascript">
			alert("' . $textValid . '")
			</script>';

        $textError = 'Si prega di inserire un ID valido ';
        $messageError = '<script type="text/javascript">
			alert("' . $textError . '")
			</script>';

        if (isset($_POST['deleteSubmitVehicles'])) {
            $id = $_POST['id'];
            if ($id != null && $id != 0) {
                $this->vehiclesMapper->delete($id);
                echo $messageValid;
            } else {
                echo $messageError;
            }
        }
    }

    public function updateVehicles()
    {
        $textValid = 'Aggiornamento effettuato con successo ';
        $messageValid = '<script type="text/javascript">
			alert("' . $textValid . '")
			</script>';

        $textError = 'Si prega di inserire i campi obbligatori ';
        $messageError = '<script type="text/javascript">
			alert("' . $textError . '")
			</script>';

        if (isset($_POST['updateSubmitVehicles'])) {
            $id = $_POST['id'];
            $classe = strtoupper($_POST['classe']);
            $targa = strtoupper($_POST['targa']);
            $modello = strtoupper($_POST['modello']);
            $scad_assicurazione = $_POST['scad_assicurazione'];
            $scad_bollo = $_POST['scad_bollo'];
            $scad_revisione = $_POST['scad_revisione'];
            $km_ult_rev = $_POST['km_ult_rev'];
            if (
                $id != null && $id != 0
                && $classe != null && $classe != ''
                && $targa != null && $targa != ''
                && $modello != null && $modello != ''
                && $scad_assicurazione != null && $scad_assicurazione != ''
                && $scad_bollo != null && $scad_bollo != ''
                && $scad_revisione != null && $scad_revisione != ''
                && $km_ult_rev != null && $km_ult_rev != 0
            ) {
                $this->vehiclesMapper->update($classe, $targa, $modello, $scad_assicurazione, $scad_bollo, $scad_revisione, $km_ult_rev, $id);
                echo $messageValid;
            } else {
                echo $messageError;
            }
        }
    }


    public function dataMsgVehicles($idVehicles)
    {
        $classe = 'classe';
        $targa = 'targa';
        $modello = 'modello';
        $scadAssicurazione = 'scad_assicurazione';
        $scadBollo = 'scad_bollo';
        $scadRevisione = 'scad_revisione';
        $tableHead = '
<table class="table table-striped">
  <thead style="background: #cfd1d6">
    <tr style="padding: 20px">
      <th scope="col">CLASSE</th>
      <th scope="col">TARGA</th>
      <th scope="col">MODELLO</th>
      <th scope="col">SCADENZA ASSICURAZIONE</th>
      <th scope="col ">SCADENZA BOLLO</th>
      <th scope="col">SCADENZA REVISIONE</th>
    </tr>
  </thead>';

        $tableBody = '<tbody>
<tr style="background: #f2f2f2">
      ';

        $tableFooter = '
    </tr>
  </tbody>
</table>';

        switch ($idVehicles) {
            case 'aprilia' :
                 $idVehicles = 1;
                break;
            case 'suzuki' :
                 $idVehicles = 2;
                break;
            case 'astra' :
                 $idVehicles = 3;
                break;
            case 'insignia' :
                 $idVehicles = 4;
                break;
        }
        return
            $tableHead .
            $tableBody .
            '<td style="text-align: center">' . $this->vehiclesMapper->dataMsgVehicles($classe, $idVehicles) . '</td>' .
            '<td style="text-align: center">' . $this->vehiclesMapper->dataMsgVehicles($targa, $idVehicles) . '</td>' .
            '<td style="text-align: center">' . $this->vehiclesMapper->dataMsgVehicles($modello, $idVehicles) . '</td>' .
            '<td style="text-align: center">' . $this->vehiclesMapper->dataMsgVehicles($scadAssicurazione, $idVehicles) . '</td>' .
            '<td style="text-align: center">' . $this->vehiclesMapper->dataMsgVehicles($scadBollo, $idVehicles) . '</td>' .
            '<td style="text-align: center">' . $this->vehiclesMapper->dataMsgVehicles($scadRevisione, $idVehicles) . '</td>' .
            $tableFooter;
    }
}