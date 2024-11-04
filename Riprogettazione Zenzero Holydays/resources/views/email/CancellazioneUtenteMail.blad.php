<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Notifica di Cancellazione Prenotazione da Parte dell'Utente</title>
    </head>

    <body>
        <h1>Notifica di Cancellazione Prenotazione</h1>
        <p>Caro Admin,</p>
        <p>Un utente ha appena cancellato una prenotazione. Di seguito i dettagli della prenotazione:</p>

        <p><strong>Dettagli della prenotazione cancellata:</strong></p>
        <ul>
            <li><strong>Nome Utente:</strong> {{ $mailData['nome'] }} {{ $mailData['cognome'] }}</li>
            <li><strong>Email Utente:</strong> {{ $mailData['email'] }}</li>
            <li><strong>Telefono:</strong> {{ $mailData['telefono'] }}</li>
            <li><strong>Data di Arrivo:</strong> {{ $mailData['arrivo'] }}</li>
            <li><strong>Data di Partenza:</strong> {{ $mailData['partenza'] }}</li>
            <li><strong>Prezzo Totale:</strong> €{{ $mailData['prezzoTotale'] }}</li>
        </ul>

        <p>Controlla se sono necessari eventuali aggiornamenti o rimborsi per questa cancellazione. Per ulteriori dettagli, puoi accedere al sistema di prenotazione.</p>

        <p>Distinti saluti,<br>Il Sistema di Notifiche - Zenzero Holidays</p>
    </body>
</html>
