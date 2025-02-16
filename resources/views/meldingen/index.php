<?php require_once __DIR__.'/../../../config/config.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen</title>
    <?php require_once __DIR__.'/../components/head.php'; ?>
    <link rel="stylesheet" href="C:\laragon\www\storingapp\public_html\css\main.css">
    </head>

<body>

    <?php require_once __DIR__.'/../components/header.php'; ?>

    <div class="container">
        <h1>Meldingen</h1>
        <a href="create.php">Nieuwe melding &gt;</a>

        <?php if(isset($_GET['msg'])) {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        } ?>

        <?php
            //query uitvoeren:
            require_once 'C:\laragon\www\storingapp\config\conn.php';  //verbinding ophalen
            $query = "SELECT * FROM meldingen";                        // query schrijven
            $statement = $conn->prepare($query);                       // van query naar statement
            $statement->execute();                                     //statement uitvoeren
            $meldingen = $statement->fetchAll(PDO::FETCH_ASSOC);       //resultaat ophalen
        ?>

        <table>
            <tr>
                <th>Attractie</th>
                <th>Type</th>
                <th>Melder</th>
                <th>Overige info</th>
                <th>Prioriteit</th>
                <th>Capaciteit</th> <!-- Nieuwe kolom voor capaciteit -->
                <th>Gemeld op</th> <!-- Nieuwe kolom voor gemeld op -->
            </tr>
            <?php foreach($meldingen as $melding): ?>
                <tr>
                    <td><?php echo $melding['attractie']; ?></td>
                    <td><?php echo $melding['type']; ?></td>
                    <td><?php echo $melding['melder']; ?></td>
                    <td><?php echo $melding['overige_info']; ?></td>
                    <td>
                        <?php
                            // Als prioriteit gelijk is aan 1, echo "Ja", anders "Nee"
                            echo $melding['prioriteit'] == 1 ? 'Ja' : 'Nee';
                        ?>
                    </td>
                    <td><?php echo $melding['capaciteit']; ?></td> <!-- Echo voor capaciteit -->
                    <td><?php echo $melding['gemeld_op']; ?></td> <!-- Echo voor gemeld op -->
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>
