<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHU - Centre Hospitalier Universitaire</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 800px;
            width: 90%;
            margin: 20px;
        }

        .header {
            background: linear-gradient(45deg, #2c5aa0, #1e4080);
            color: white;
            padding: 40px;
            text-align: center;
        }

        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            font-weight: 300;
        }

        .header p {
            font-size: 1.1em;
            opacity: 0.9;
        }

        .content {
            padding: 50px 40px;
        }

        .welcome-text {
            text-align: center;
            margin-bottom: 40px;
            color: #333;
        }

        .welcome-text h2 {
            font-size: 1.8em;
            margin-bottom: 15px;
            color: #2c5aa0;
        }

        .welcome-text p {
            font-size: 1.1em;
            line-height: 1.6;
            color: #666;
        }

        .options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-top: 40px;
        }

        @media (max-width: 600px) {
            .options {
                grid-template-columns: 1fr;
            }
        }

        .option-card {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 30px 25px;
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            cursor: pointer;
        }

        .option-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            border-color: #2c5aa0;
        }

        .option-card .icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: linear-gradient(45deg, #2c5aa0, #1e4080);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2em;
            color: white;
        }

        .option-card h3 {
            font-size: 1.4em;
            margin-bottom: 15px;
            color: #2c5aa0;
        }

        .option-card p {
            color: #666;
            margin-bottom: 25px;
            line-height: 1.5;
        }

        .btn {
            background: linear-gradient(45deg, #2c5aa0, #1e4080);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 25px;
            font-size: 1em;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(44, 90, 160, 0.3);
        }

        .footer {
            background: #f8f9fa;
            padding: 20px 40px;
            text-align: center;
            border-top: 1px solid #e9ecef;
            color: #666;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>CHU</h1>
            <p>Centre Hospitalier Universitaire</p>
        </div>

        <div class="content">
            <div class="welcome-text">
                <h2>Bienvenue sur notre plateforme</h2>
                <p>Accédez aux services en ligne du CHU. Choisissez l'option qui correspond à vos besoins.</p>
            </div>

            <div class="options">
                <div class="option-card" onclick="window.location.href='demande_de_stage.php'">
                    <div class="icon">📋</div>
                    <h3>Demande de Stage</h3>
                    <p>Étudiants en médecine, soins infirmiers ou autres formations médicales, déposez votre demande de stage.</p>
                    <a href="demande_stage.php" class="btn">Faire une demande</a>
                </div>

                <div class="option-card" onclick="window.location.href='login.php'">
                    <div class="icon">🔐</div>
                    <h3>Authentification</h3>
                    <p>Personnel médical et administratif, connectez-vous à votre espace personnel sécurisé.</p>
                    <a href="authentification.php" class="btn">Se connecter</a>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>&copy; <?php echo date('Y'); ?> CHU - Centre Hospitalier Universitaire. Tous droits réservés.</p>
            <p>Pour toute assistance technique, contactez le service informatique.</p>
        </div>
    </div>

    <script>
        // Animation d'apparition au chargement
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.container');
            container.style.opacity = '0';
            container.style.transform = 'translateY(30px)';
            
            setTimeout(() => {
                container.style.transition = 'all 0.8s ease';
                container.style.opacity = '1';
                container.style.transform = 'translateY(0)';
            }, 100);
        });

        // Effet de clic sur les cartes
        document.querySelectorAll('.option-card').forEach(card => {
            card.addEventListener('click', function(e) {
                // Animation de clic
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = 'translateY(-5px)';
                }, 100);
            });
        });
    </script>
</body>
</html>