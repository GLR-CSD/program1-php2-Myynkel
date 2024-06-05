<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personenlijst</title>
    <link rel="stylesheet" href="public/css/simple.css">
</head>
<body>
<h1>Album lijst</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Naam</th>
        <th>Artiesten</th>
        <th>Release Datum</th>
        <th>Afbeelding</th>
        <th>Prijs</th>
    </tr>
    <?php foreach ($albums as $album): ?>
        <tr>
            <td><?= $album->getId() ?></td>
            <td><?= $album->getNaam() ?></td>
            <td><?= $album->getArtiesten() ?></td>
            <td><?= $album->getReleaseDatum() ?></td>
            <td><img src="public/albumcovers/<?= $album->getAfbeelding()?>"></td>
            <td><?= $album->getPrijs() ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<div class="notice">
    <h2>Persoon Toevoegen:</h2>
    <?php if (!empty($errors)): ?>
        <div style="color: red;">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form action="toevoegen_album.php" method="post">
        <label for="naam">Naam:</label>
        <input type="text" id="naam" name="naam" value="<?= $formValues['naam'] ?? '' ?>" required>
        <?php if (isset($errors['naam'])): ?>
            <span style="color: red;"><?= $errors['naam'] ?></span>
        <?php endif; ?><br>

        <label for="artiesten">Artiesten:</label>
        <input type="text" id="artiesten" name="artiesten" value="<?= $formValues['artiesten'] ?? '' ?>"  required>
        <?php if (isset($errors['artiesten'])): ?>
            <span style="color: red;"><?= $errors['artiesten'] ?></span>
        <?php endif; ?><br>

        <label for="releaseDatum">Release Datum:</label>
        <input type="date" id="releaseDatum" name="releaseDatum" value="<?= $formValues['releaseDatum'] ?? '' ?>">
        <?php if (isset($errors['releaseDatum'])): ?>
            <span style="color: red;"><?= $errors['releaseDatum'] ?></span>
        <?php endif; ?><br>

        <label for="afbeelding">Afbeelding:</label>
        <input type="file" id="afbeelding" name="afbeelding" value="<?= $formValues['afbeelding'] ?? '' ?>">
        <?php if (isset($errors['afbeelding'])): ?>
            <span style="color: red;"><?= $errors['afbeelding'] ?></span>
        <?php endif; ?><br>

        <label for="prijs">Prijs:</label><br>
        <input type="text" id="prijs" name="prijs" value="<?= $formValues['prijs'] ?? '' ?>"  required>
        <?php if (isset($errors['prijs'])): ?>
            <span style="color: red;"><?= $errors['prijs'] ?></span>
        <?php endif; ?><br>
        <input type="submit" value="Toevoegen">
    </form>
</div>
