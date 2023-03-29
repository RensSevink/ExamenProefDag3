<h1>Details Baan</h1>

<?php if (isset($data['error'])) : ?>
    <div class="error">
        <?php echo $data['error']; ?>
    </div>
<?php endif; ?>

<form action="" method="POST">
    <label for="baan">Baan: </label>
    <select name="baanId">

        <?php if (empty($data['activeBaanId'])) : ?>
            <option disabled selected value> -- select an option -- </option>
        <?php endif; ?>

        <?php foreach ($data['banen'] as $baan) : ?>
            <option value="<?php echo $baan->Id; ?>" <?php echo ($baan->Id == $data['activeBaanId']) ? "selected" : "" ?>><?php echo $baan->Nummer; ?></option>
        <?php endforeach; ?>


    </select>
    <input type="hidden" name="reserveringsId" value="<?php echo $data['reserveringsId'] ?>">
    <input type="submit" value="Wijzigen">
</form>