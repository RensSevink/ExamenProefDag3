<?php


class Reservering extends controller
{
    private $ReserveringsModel;

    public function __construct()
    {
        $this->ReserveringsModel = $this->model('ReserveringsModel');
    }


    // omdat geen login is, is er geen session variabel daarom gebruik ik id 1 Mazin Jamil als test
    public function index()
    {
        $reserveringen = $this->ReserveringsModel->getReserveringenByPersoonId(1);

        $data = [
            'reserveringen' => $reserveringen
        ];

        $this->view('reservering/index', $data);
    }

    public function wijzigen($id = null)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            try {
                $filteredPost = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);


                $postData = [
                    'reserveringsId' => $filteredPost['reserveringsId'],
                    'baanId' => $filteredPost['baanId']
                ];

                $kinderen = $this->ReserveringsModel->kinderenToegestaan($postData['reserveringsId'])->AantalKinderen;

                if ($kinderen > 1 && $postData['baanId'] <= 6) {

                    $banen = $this->ReserveringsModel->getBanen();
                    $actiefBaanId = $this->ReserveringsModel->getActiveBaanById($id);

                    $data = [
                        'error' => 'Deze baan is niet bedoelt voor kinderen',
                        'reserveringsId' => $id,
                        'activeBaanId' => $actiefBaanId->BaanId,
                        'banen' => $banen
                    ];

                    $this->view('reservering/wijzigen', $data);
                    exit;
                }
            } catch (Exception $e) {
                echo $e->getMessage();
                header('Refresh: 3; URL=' . URLROOT . '/reservering');
                exit;
            }

            $this->ReserveringsModel->updateBaanNummer($postData);

            echo "De baan is gewijzigd";
            header('Refresh: 3; URL=' . URLROOT . '/reservering');
            exit;
        } else {

            if ($id == null) {
                echo 'Geen id';
                header('Refresh: 3; URL=' . URLROOT . '/reservering');
                exit;
            }

            $banen = $this->ReserveringsModel->getBanen();
            $actiefBaanId = $this->ReserveringsModel->getActiveBaanById($id);


            $data = [
                'reserveringsId' => $id,
                'activeBaanId' => $actiefBaanId->BaanId,
                'banen' => $banen
            ];

            $this->view('reservering/wijzigen', $data);
        }
    }

    public function overzicht()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            try {


                $filteredPost = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $postData = [
                    'datum' => $filteredPost['datum'],
                    'persoonId' => 1
                ];

                $newReserveringen = $this->ReserveringsModel->getReserveringenTimeById($postData);
                $volNaam = $this->ReserveringsModel->getPersoonById(1);

                if (empty($newReserveringen)) {
                    $error = 'Er zijn geen reserveringen vanaf deze datum';
                }

                if ($postData['datum'] > date('Y-m-d')) {
                    $error = 'Er is geen informatie over deze periode';
                }

                $data = [
                    'volledigeNaam' => "$volNaam->Voornaam $volNaam->Tussenvoegsel $volNaam->Achternaam",
                    'reserveringen' => $newReserveringen,
                    'error' => $error ?? ''
                ];

                $this->view('reservering/overzicht', $data);
            } catch (Exception $e) {
                echo $e->getMessage();
                header('Refresh: 3; URL=' . URLROOT . '/reservering');
                exit;
            }
            exit;
        }

        $reserveringen = $this->ReserveringsModel->getReserveringenOverzichtByPersoonId(1);
        $volNaam = $this->ReserveringsModel->getPersoonById(1);

        $data = [
            'volledigeNaam' => "$volNaam->Voornaam $volNaam->Tussenvoegsel $volNaam->Achternaam",
            'reserveringen' => $reserveringen
        ];

        $this->view('reservering/overzicht', $data);
    }
}
