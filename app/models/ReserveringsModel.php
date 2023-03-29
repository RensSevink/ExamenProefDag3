<?php


class ReserveringsModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getReserveringenByPersoonId($persoonid)
    {
        $this->db->query('
                                        SELECT 
                                            Reservering.Id as ReserveringId,
                                            Reservering.Datum,
                                            Reservering.AantalVolwassen,
                                            Reservering.AantalKinderen,
                                            Persoon.Voornaam,
                                            Persoon.Tussenvoegsel,
                                            Persoon.Achternaam,
                                            Baan.Nummer as Baan           
                                        FROM Reservering
                                        LEFT  JOIN Persoon
                                        ON Reservering.PersoonId = Persoon.Id
                                        LEFT  JOIN Baan
                                        ON Reservering.BaanId = Baan.Id
                                        WHERE PersoonId = :persoonid
                                    ');

        $this->db->bind(':persoonid', $persoonid);
        $results = $this->db->resultSet();

        return $results;
    }

    public function getReserveringenOverzichtByPersoonId($persoonid)
    {
        $this->db->query('
                                        SELECT 
                                            Reservering.Datum,
                                            Reservering.AantalVolwassen,
                                            Reservering.AantalKinderen,
                                            Reservering.AantalUren,
                                            Reservering.BeginTijd,
                                            Reservering.EindTijd,
                                            Persoon.Roepnaam      
                                        FROM Reservering
                                        LEFT  JOIN Persoon
                                        ON Reservering.PersoonId = Persoon.Id
                                        WHERE PersoonId = :persoonid
                                        ORDER BY Datum DESC
                                    ');

        $this->db->bind(':persoonid', $persoonid);
        $results = $this->db->resultSet();

        return $results;
    }

    public function getPersoonById($persoonid)
    {
        $this->db->query('SELECT Voornaam, Tussenvoegsel, Achternaam FROM Persoon WHERE Id = :persoonid');
        $this->db->bind(':persoonid', $persoonid);
        $results = $this->db->single();

        return $results;
    }

    public function getBanen()
    {
        $this->db->query('SELECT Id, Nummer FROM Baan');
        $results = $this->db->resultSet();

        return $results;
    }

    public function getActiveBaanById($reserveringsId)
    {
        $this->db->query('SELECT BaanId FROM Reservering WHERE Id = :reserveringsId');
        $this->db->bind(':reserveringsId', $reserveringsId);
        $results = $this->db->single();

        return $results;
    }

    public function updateBaanNummer($data)
    {
        $this->db->query('UPDATE Reservering SET BaanId = :baanId WHERE Id = :reserveringsId');
        $this->db->bind(':baanId', $data['baanId']);
        $this->db->bind(':reserveringsId', $data['reserveringsId']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function kinderenToegestaan($reserveringsId)
    {
        $this->db->query('SELECT AantalKinderen FROM Reservering WHERE Id = :reserveringsId');
        $this->db->bind(':reserveringsId', $reserveringsId);
        $results = $this->db->single();

        return $results;
    }

    public function getReserveringenTimeById($data)
    {
        $this->db->query('
                                        SELECT 
                                            Reservering.Datum,
                                            Reservering.AantalVolwassen,
                                            Reservering.AantalKinderen,
                                            Reservering.AantalUren,
                                            Reservering.BeginTijd,
                                            Reservering.EindTijd,
                                            Persoon.Roepnaam                 
                                        FROM Reservering
                                        LEFT  JOIN Persoon
                                        ON Reservering.PersoonId = Persoon.Id
                                        WHERE PersoonId = :persoonid
                                        AND Datum > :datum
                                        ORDER BY Datum DESC
                                    ');

        $this->db->bind(':persoonid', $data['persoonId']);
        $this->db->bind(':datum', $data['datum']);
        $results = $this->db->resultSet();

        return $results;
    }
}
