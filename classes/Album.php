<?php

class Album
{
    /** @var int|null het id van het Album */
    private ?int $id;

    /** @var string De naam van het Album */
    private string $naam;

    /** @var string|null De naam van de artiest */
    private string $artiesten;

    /** @var string de datum waarop het album is uitgekomen */
    private string $releaseDatum;

    /** @var string Album cover */
    private string $afbeelding;

    /** @var string Prijs van het album */
    private string $prijs;

    /**
 * @param int|null $id
 * @param string $naam
 * @param string|null $artiesten
 * @param string $releaseDatum
 * @param string $afbeelding
 * @param string $prijs
   */
    public function __construct(?int $id, string $naam, string $artiesten, string $releaseDatum, string $afbeelding, string $prijs)
{
    $this->id = $id;
    $this->naam = $naam;
    $this->artiesten = $artiesten;
    $this->releaseDatum = $releaseDatum;
    $this->afbeelding = $afbeelding;
    $this->prijs = $prijs;
}

    /**
     * Haalt alle Albums op uit de database.
     *
     * @param PDO $db De PDO-databaseverbinding.
     * @return albums[] Een array van Persoon-objecten.
     */

    public static function getAll(PDO $db): array
    {
        $stmt = $db->query("SELECT * FROM Album");

        $albums = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $album = new Album(
                $row['id'],
                $row['naam'],
                $row['artiesten'],
                $row['releaseDatum'],
                $row['afbeelding'],
                $row['prijs']
            );
            $albums[] = $album;
        }

        return $albums;
    }

    public function save(PDO $db): void
    {
        // Voorbereiden van de query
        $stmt = $db->prepare("INSERT INTO Album (naam, artiesten, releaseDatum, afbeelding, prijs) VALUES (:naam, :artiesten, :releaseDatum, :afbeelding, :prijs)");
        $stmt->bindParam(':naam', $this->naam);
        $stmt->bindParam(':artiesten', $this->artiesten);
        $stmt->bindParam(':releaseDatum', $this->releaseDatum);
        $stmt->bindParam(':afbeelding', $this->afbeelding);
        $stmt->bindParam(':prijs', $this->prijs);
        $stmt->execute();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNaam(): string
    {
        return $this->naam;
    }

    /**
     * @param string $naam
     */
    public function setNaam(string $naam): void
    {
        $this->naam = $naam;
    }

    /**
     * @return string
     */
    public function getArtiesten(): string
    {
        return $this->artiesten;
    }

    /**
     * @param string $artiesten
     */
    public function setArtiesten(string $artiesten): void
    {
        $this->artiesten = $artiesten;
    }

    /**
     * @return string
     */
    public function getReleaseDatum(): string
    {
        return $this->releaseDatum;
    }

    /**
     * @param string $releaseDatum
     */
    public function setReleaseDatum(string $releaseDatum): void
    {
        $this->releaseDatum = $releaseDatum;
    }

    /**
     * @return string
     */
    public function getAfbeelding(): string
    {
        return $this->afbeelding;
    }

    /**
     * @param string $afbeelding
     */
    public function setAfbeelding(string $afbeelding): void
    {
        $this->afbeelding = $afbeelding;
    }

    /**
     * @return string
     */
    public function getPrijs(): string
    {
        return $this->prijs;
    }

    /**
     * @param string $prijs
     */
    public function setPrijs(string $prijs): void
    {
        $this->prijs = $prijs;
    }

}