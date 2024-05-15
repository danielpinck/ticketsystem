<?php

if (isset($_GET['bidb']) && isset($_SESSION['Rolle']) && $_SESSION['Rolle'] === 'Admin') {
    beitragBearbeiten($db, $_GET['bidb']);
}

function beitragBearbeiten($db, $bidb) {

    $query = "SELECT b.Text, b.Rubrik1, b.Rubrik2, b.Rubrik3, b.Sichtbarkeit, b.UID, u.Anmeldename, u.Rolle, u.EMail, b.Bild 
    FROM beitraege AS b
    LEFT JOIN user AS u ON b.UID = u.UID
    WHERE b.BID = $bidb";

    $result = $db->query($query);

    // Überprüfen, ob Daten vorhanden sind
    if ($result->num_rows > 0) {
        // Daten in Variablen speichern
        while ($row = $result->fetch_assoc()) {
            $text = $row["Text"];
            $rubrik1 = $row["Rubrik1"];
            $rubrik2 = $row["Rubrik2"];
            $rubrik3 = $row["Rubrik3"];
            $sichtbarkeit = $row["Sichtbarkeit"];
            $uid = $row["UID"];
            $anmeldename = $row["Anmeldename"];
            $rolle = $row["Rolle"];
            $email = $row["EMail"];
            $bild = $row["Bild"];
        }
    }
    ?>
    <body>
    <h1 class="flex">Anzeige Bearbeiten</h1>
    <div class="flex">
        <form action="main.php" method="post" enctype="multipart/form-data"> <!--start des erstellen forms-->

            <!-- Füge ein verstecktes Eingabefeld für BID hinzu -->
            <input type="hidden" name="BID" value="<?php echo $bidb; ?>">

            Uid: <?php echo $uid; ?><br>
            Anmeldename: <?php echo $anmeldename; ?><br>
            Rolle: <?php echo $rolle; ?><br>
            E-Mail: <?php echo $email; ?><br><br>


            <select name="Sichtbarkeit" id="2">
                <option value="Öffentlich" <?php if ($sichtbarkeit === 'Öffentlich') echo 'selected'; ?>>Öffentlich</option>
                <option value="Privat" <?php if ($sichtbarkeit === 'Privat') echo 'selected'; ?>>Privat</option>
            </select><br><br>


            Beschreibung <br>
            <textarea name="Beschreibung" style="width: 400px; height: 200px; resize: none;"><?php echo $text; ?></textarea><br><br>
            <!--textfeld zur eingab der Beschreibung.-->

            <div class="grid">
                Besonderheiten <br><br>
                Rubrik 1 &emsp;&emsp;&emsp;&emsp;&ensp;&nbsp;Rubrik 2 &emsp;&emsp;&emsp;&emsp;&ensp;&nbsp;Rubrik 3<br>
                <!--3x Dropdown für die rubriken/tags für die spätere filterung bei der suchanfrage.-->

            <select name="rb1" id="3" style="width: 133px;">
                <option value=''></option>
                <?php
                $query = "SELECT Name FROM rubriken";
                $stmt = $db->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    $rubrikName = $row['Name'];
                    // Überprüfen, ob die aktuelle Rubrik mit Rubrik1 übereinstimmt
                    $selected = ($rubrikName == $rubrik1) ? 'selected' : '';
                    echo '<option value="' . $rubrikName . '" ' . $selected . '>' . $rubrikName . '</option>';
                }
                ?>
            </select>
            <select name="rb2" id="4" style="width: 133px;">
                <option value=''></option>
                <?php
                $query = "SELECT Name FROM rubriken";
                $stmt = $db->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    $rubrikName = $row['Name'];
                    // Überprüfen, ob die aktuelle Rubrik mit Rubrik2 übereinstimmt
                    $selected = ($rubrikName == $rubrik2) ? 'selected' : '';
                    echo '<option value="' . $rubrikName . '" ' . $selected . '>' . $rubrikName . '</option>';
                }
                ?>
            </select>
            <select name="rb3" id="5" style="width: 133px;">
                <option value=''></option>
                <?php
                $query = "SELECT Name FROM rubriken";
                $stmt = $db->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    $rubrikName = $row['Name'];
                    // Überprüfen, ob die aktuelle Rubrik mit Rubrik3 übereinstimmt
                    $selected = ($rubrikName == $rubrik3) ? 'selected' : '';
                    echo '<option value="' . $rubrikName . '" ' . $selected . '>' . $rubrikName . '</option>';
                }
                ?>
            </select>
            <br>
            </div>
            <br>

            Bild:
            <br>
            <?php if (!empty($bild)) : ?>
                <img src="data:image/jpeg;base64,<?php echo base64_encode($bild); ?>" style="max-height: 400px;"><br><br>
            <?php endif; ?>
            
            <input type="file" name="image" id="image"> <br>
            <br>
            <input type="checkbox" name="delete_image" id="delete_image">
            <label for="delete_image">Bild löschen</label>
            <br><br>
            
            <input type="hidden" name="bearbeitung" value="true">

            <input type="submit" value="Aktuallisieren">

        </form>
    </div>

</body>

</html>
<?php
}
?>