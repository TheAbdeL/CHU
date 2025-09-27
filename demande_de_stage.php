<!DOCTYPE HTML>
<html lang="fr">

<head>
    <title>Demande de stage</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style type="text/css">
        body {
            background-color: #f0f8ff;
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: inline-block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="date"] {
            width: calc(100% - 20px);
        }

        .btn-primary {
            background-color: #3498db;
            border: 1px solid #3498db;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            border: 1px solid #2980b9;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 style="color: #3498db;">Demande de stage</h2>
        <form method="post" action="traitement_des_demandes.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom" required autofocus>
            </div>

            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Prénom" required>
            </div>

            <div class="form-group">
                <label for="cin">CIN :</label>
                <input type="text" name="cin" id="cin" class="form-control" placeholder="CIN" required>
            </div>

            <div class="form-group">
                <label for="niveau">Niveau :</label>
                <select name="niveau" id="niveau" class="form-control" required>
                    <option selected disabled>Niveau</option>
                    <option value="Bac +2">Bac+2</option>
                    <option value="Bac +3">Bac+3</option>
                    <option value="Bac +5">Bac+5</option>
                </select>
            </div>

            <div class="form-group">
                <label for="etablissement">Etablissement :</label>
                <input type="text" name="etablissement" id="etablissement" class="form-control" placeholder="Etablissement" required>
            </div>

            <div class="form-group">
                <label for="tel">Tél :</label>
                <input type="text" maxlength="10" name="tel" id="tel" class="form-control" placeholder="Tél" required>
            </div>

            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
            </div>

            <div class="form-group">
                <label for="service">Service :</label>
                <select name="service" id="service" class="form-control" required>
                    <option selected disabled>Service</option>
                    <option value="SI">Service informatique</option>
                    <option value="Service 1">Service 1</option>
                    <option value="Service 2">Service 2</option>
                </select>
            </div>

            <div class="form-group">
                <label for="date_debut">Date début :</label>
                <input type="date" id="date_debut" name="date_debut" class="form-control" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" required>
            </div>

            <div class="form-group">
                <label for="date_fin"> Date fin :</label>
                <input type="date" id="date_fin" name="date_fin" class="form-control" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" required>
            </div>

            <div class="form-group">
                <label for="cv">CV :</label>
                <input type="file" name="cv" id="cv" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="lm">Lettre de motivation :</label>
                <input type="file" name="lm" id="lm" class="form-control" required>
            </div>

            <div class="form-group">
                <button type="submit" name="envoyer" id="envoi" class="btn btn-primary">Envoyer</button>
            </div>
        </form>
    </div>

    </body>

</html>
