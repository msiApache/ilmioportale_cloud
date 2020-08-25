<?php


namespace Ilmioportale\Controller;

use Ilmioportale\Mapper\UsersMapper;

class UsersController
{
    /**
     * @var UsersMapper
     */
    private $usersMapper;

    /**
     * UsersController constructor.
     * @param $config
     */
    private $config;

    public function __construct($config)
    {
        $this->usersMapper = new UsersMapper($config);
        $this->config = $config;
    }

    /**
     * @return array|bool
     */
    public function findViewUsers()
    {
        $text = 'Si prega di inserire un ID ACCOUNT  corretto! ';
        $message = '<script type="text/javascript">
			alert("' . $text . '")
			</script>';
        if (isset($_POST['searchUtenti'])) {
            $id = $_POST['id'];
            $result = $this->usersMapper->findView($id);
            if ($id != 0 && $id != null) {
                return $result;
            } else {
                echo $message;
            }
        }
    }

    public function fetchAllView()
    {
        if (isset($_POST['submitListaUtenti'])) {
            $this->usersMapper->fetchAllView();
        }
    }

    public function insertUsers()
    {
        $textValid = 'Inserimento effettuato con successo ';
        $messageValid = '<script type="text/javascript">
			alert("' . $textValid . '")
			</script>';

        $textError = 'Si prega di inserire i campi obbligatori ';
        $messageError = '<script type="text/javascript">
			alert("' . $textError . '")
			</script>';

        if (isset($_POST['insertSubmitUsers'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if (
                $username != null && $username != ''
                && $password != null && $password != ''
            ) {
                $this->usersMapper->insert($username, $password);
                echo $messageValid;
            } else {
                echo $messageError;
            }
        }
    }

    public function updateUsers()
    {
        $textValid = 'Aggiornamento effettuato con successo ';
        $messageValid = '<script type="text/javascript">
			alert("' . $textValid . '")
			</script>';

        $textError = 'Si prega di inserire i campi obbligatori ';
        $messageError = '<script type="text/javascript">
			alert("' . $textError . '")
			</script>';

        if (isset($_POST['updateSubmitUsers'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $id = $_POST['id'];
            if (
                $username != null && $username != ''
                && $password != null && $password != ''
                && $id != null && $id != 0
            ) {
                $this->usersMapper->update($username, $password, $id);
                echo $messageValid;
            } else {
                echo $messageError;
            }
        }
    }

    public function deleteUsers()
    {
        $textValid = 'Cancellazione effettuata con successo ';
        $messageValid = '<script type="text/javascript">
			alert("' . $textValid . '")
			</script>';

        $textError = 'Si prega di inserire un ID ACCOUNT valido ';
        $messageError = '<script type="text/javascript">
			alert("' . $textError . '")
			</script>';

        if (isset($_POST['deleteSubmitUsers'])) {
            $id = $_POST['id'];
            if ($id != null && $id != 0) {
                $this->usersMapper->delete($id);
                echo $messageValid;
            } else {
                echo $messageError;
            }
        }
    }

    public function login()
    {
        $this->usersMapper->login();
    }

}