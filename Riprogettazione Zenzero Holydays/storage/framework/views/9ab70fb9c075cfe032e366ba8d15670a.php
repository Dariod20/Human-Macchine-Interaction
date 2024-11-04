<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Notifica di Cancellazione Prenotazione</title>
    </head>

    <body>
        <h1><?php echo e($mailData['title']); ?></h1>
        <p>Caro <?php echo e($mailData['nome']); ?> <?php echo e($mailData['cognome']); ?>,</p>
        <p><?php echo e($mailData['body']); ?></p>

        <p><strong>Dettagli della prenotazione cancellata:</strong></p>
        <ul>
            <li><strong>Data di arrivo:</strong> <?php echo e($mailData['arrivo']); ?></li>
            <li><strong>Data di partenza:</strong> <?php echo e($mailData['partenza']); ?></li>
            <li><strong>Prezzo Totale:</strong> €<?php echo e($mailData['prezzoTotale']); ?></li>
            <li><strong>Telefono:</strong> <?php echo e($mailData['telefono']); ?></li>
        </ul>
        <p> Nel caso tu abbia già effettuato il pagamento sarai contattato via mail per il rimborso. <br>Per qualsiasi altro dubbio non esitare a contattarci</p>
        <p>Distinti saluti,<br>Christian Girardelli - Zenzero Holidays</p>
    </body>
</html>
<?php /**PATH C:\mia\ProgrammazioneWeb\Human-Macchine-Interaction\Riprogettazione Zenzero Holydays\resources\views/email/demoMail.blade.php ENDPATH**/ ?>