<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo e($mailData['title']); ?></title>
    </head>

    <body>
        <h1><?php echo e($mailData['title']); ?></h1>
        <p>Buongiorno,</p>
        <p><?php echo e($mailData['body']); ?></p>

        <p><strong>Dettagli della prenotazione <?php echo e($mailData['operazione']); ?>: </p>
        <ul>
            <li><strong>Data di arrivo:</strong> <?php echo e($mailData['arrivo']); ?></li>
            <li><strong>Data di partenza:</strong> <?php echo e($mailData['partenza']); ?></li>
            <li><strong>Prezzo Totale:</strong> €<?php echo e($mailData['prezzoTotale']); ?></li>
            <br>
            <li><strong>Nome:</strong> <?php echo e($mailData['nome']); ?> <?php echo e($mailData['cognome']); ?></li>
            <li><strong>Email:</strong> <?php echo e($mailData['email']); ?></li>
            <li><strong>Telefono:</strong> <?php echo e($mailData['telefono']); ?></li>
            <li><strong>Stato:</strong> <?php echo e($mailData['stato']); ?></li>
            <li><strong>Ospiti:</strong> <?php echo e($mailData['numAdulti']); ?> adulti e <?php echo e($mailData['numBambini']); ?> bambini</li>
            <li><strong>Orario di arrivo:</strong> <?php echo e($mailData['orario']); ?></li>


        </ul>
        <p> <?php echo $mailData['infoFinali']; ?></p>
    
        <p>Distinti saluti,
        <br>
        <?php echo e($mailData['NomeSaluto']); ?> - Zenzero Holidays
        </p>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\Human-Macchine-Interaction\Riprogettazione Zenzero Holydays\resources\views/email/CustomMail.blade.php ENDPATH**/ ?>