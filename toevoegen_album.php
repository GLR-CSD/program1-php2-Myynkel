<?php
// Start de sessie
// Deze gaan we gebruiken om de form values en de errors op te slaan
session_start();

// Controleer of het verzoek via POST is gedaan
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Valideer de ingediende gegevens
    $errors = [];
    $formValues = [
        'naam' => $_POST['naam'] ?? '',
        'artiesten' => $_POST['artiesten'] ?? '',
        'releaseDatum' => $_POST['releaseDatum'] ?? '',
        'afbeelding' => $_POST['afbeelding'] ?? '',
        'prijs' => $_POST['prijs'] ?? '',
    ];

    // Valideer voornaam
    if (empty($_POST['naam'])) {
        $errors['naam'] = "Naam is verplicht.";
    }

    // Valideer achternaam
    if (empty($_POST['artiesten'])) {
        $errors['artiesten'] = "Artiest is verplicht.";
    }

    // Valideer e-mailadres
    if (empty($_POST['releaseDatum'])) {
        $errors['releaseDatum'] = "releaseDatum is verplicht.";
    }

    //Valideer afbeelding upload
    if (isset($_FILES['afbeelding']) && $_FILES['afbeelding']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['afbeelding']['tmp_name'];
        $fileName = $_FILES['afbeelding']['name'];
        $filesize = $_FILES['afbeelding']['size'];
        $fileType = $_FILES['afbeelding']['type'];
        $fileNameCmps = explode('.', $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = ['jpg','gif','png'];
        if (!in_array($fileExtension, $allowedfileExtensions)) {
            $errors['afbeelding'] = 'Ongeldig Bestandstype. Alleen JPG, GIF of PNG';
        } else {
            $uploadFileDir = 'uploads/';
            $dest_path = $uploadFileDir . $fileName;

            if (!move_uploaded_file($fileTmpPath, $dest_path)) {
                $errors['afbeelding'] = 'Er was een probleem bij het uploaden';
            }
        }
    } else {
        $errors['afbeelding'] = "Afbeelding uploaden is verplicht.";
    }

    // Als er geen validatiefouten zijn, voeg de persoon toe aan de database
    if (empty($errors)) {
        require_once 'db.php';
        require_once 'classes/Album.php';

        // Maak een nieuw Persoon object met de ingediende gegevens
        $album = new Album(
            null,
            $_POST['naam'],
            $_POST['artiesten'],
            $_POST['releaseDatum'],
            $dest_path,
            $_POST['prijs']
        );

        // Voeg de persoon toe aan de database
        $album->save($db);

    } else {
        // Sla de fouten en formulier waarden op in sessievariabelen
        $_SESSION['errors'] = $errors;
        $_SESSION['formValues'] = $formValues;
    }

    // Stuur de gebruiker terug naar de index.php
    header("Location: album.php");
    exit;

} else {
    header("Location: album.php");
}