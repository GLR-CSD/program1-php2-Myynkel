<?php

class Nummer
{
    private ?int $id;
    private string $AlbumID;
    private string $Titel;
    private string $Duur;
    private string $URL;

    public function __construct(int $id, string $AlbumID, string $Titel, string $Duur, string $URL)
    {
        $this->id = $id;
        $this->AlbumID = $AlbumID;
        $this->Titel = $Titel;
        $this->Duur = $Duur;
        $this->URL = $URL;
    }

    public static function getAll(PDO $db): array
    {
        $stmt = $db->query("SELECT * FROM Nummers");

        $nummers = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $nummer = new Nummer(
                $row["id"],
                $row["AlbumID"],
                $row["Titel"],
                $row["Duur"],
                $row["URL"]
            );
            $nummers[] = $nummer;
        }
        return $nummers;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getAlbumID(): string {
        return $this->AlbumID;
    }

    public function getTitel(): string {
        return $this->Titel;
    }

    public function getDuur(): string {
        return $this->Duur;
    }

    public function getURL(): string {
        return $this->URL;
    }
}