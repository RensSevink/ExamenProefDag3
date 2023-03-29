<h1>Overzicht reserveringen</h1>

<table>
    <thead>
        <tr>
            <th>Voornaam</th>
            <th>Tussenvoegsel</th>
            <th>Achternaam</th>
            <th>Datum</th>
            <th>Volwassenen</th>
            <th>Kinderen</th>
            <th>Baan</th>
            <th>Wijzigen</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['reserveringen'] as $reservering) : ?>
            <tr>
                <td><?php echo $reservering->Voornaam; ?></td>
                <td><?php echo $reservering->Tussenvoegsel; ?></td>
                <td><?php echo $reservering->Achternaam; ?></td>
                <td><?php echo $reservering->Datum; ?></td>
                <td><?php echo $reservering->AantalVolwassen; ?></td>
                <td><?php echo $reservering->AantalKinderen; ?></td>
                <td><?php echo $reservering->Baan; ?></td>
                <td><a href="<?php echo URLROOT; ?>/reservering/wijzigen/<?php echo $reservering->ReserveringId; ?>">Wijzigen</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>