<h1>Reserveringen van <?php echo $data['volledigeNaam'] ?></h1>

<form action="" method="POST">
    <label for="datum">Datum</label>
    <input type="date" name="datum" id="datum">
    <input type="submit" value="Toon Reserveringen">
</form>

<table>
    <thead>
        <tr>
            <th>Naam</th>
            <th>Datum</th>
            <th>Aantal uren</th>
            <th>Begintijd</th>
            <th>Eindtijd</th>
            <th>Aantal volwassenen</th>
            <th>Aantal kinderen</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['reserveringen'] as $reservering) : ?>
            <tr>
                <td><?php echo $reservering->Roepnaam; ?></td>
                <td><?php echo $reservering->Datum; ?></td>
                <td><?php echo $reservering->AantalUren; ?></td>
                <td><?php echo $reservering->BeginTijd; ?></td>
                <td><?php echo $reservering->EindTijd; ?></td>
                <td><?php echo $reservering->AantalVolwassen; ?></td>
                <td><?php echo $reservering->AantalKinderen; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if (isset($data['error'])) : ?>
    <div class="error">
        <?php echo $data['error']; ?>
    </div>
<?php endif; ?>