<?php
// Start de sessie
session_start();

if (isset($_SESSION['naam']) && isset($_SESSION['email'])) {
    $naam = $_SESSION['naam'];
    $email = $_SESSION['email'];

    echo "Naam: " . $naam . "<br>";
    echo "E-mail: " . $email . "<br>";

    $host = 'localhost:3307';
    $db   = 'winkel';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        echo "Connected to Winkel";

        $query = "SELECT * FROM producten";
        $stmt = $pdo->query($query);

        if ($stmt->rowCount() > 0) {
            echo "<h2>Geselecteerde gegevens uit de tabel:</h2>";
            echo "<table>";
            echo "<tr><th>product_code</th><th>product_naam</th><th>prijs_per_stuk</th></tr>";

            $ids = array();

            while ($row = $stmt->fetch()) {
                echo "<tr>";
                echo "<td>" . $row['product_code'] . "</td>";
                echo "<td>" . $row['product_naam'] . "</td>";
                echo "<td>" . $row['prijs_per_stuk'] . "</td>";
                echo "</tr>";

                $ids[] = $row['product_code'];
            }

            echo "</table>";

            $_SESSION['ids'] = $ids;
        } else {
            echo "Geen gegevens beschikbaar in de tabel.";
        }
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
} else {
    echo "De sessievariabelen zijn niet ingesteld.";
}
?>
