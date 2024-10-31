<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Notifica di Cancellazione Prenotazione</title>
    </head>

    <body>
        <h1>{{ $mailData['title'] }}</h1>
        <p>Caro {{ $mailData['nome'] }} {{ $mailData['cognome'] }},</p>
        <p>{{ $mailData['body'] }}</p>

        <p><strong>Dettagli della prenotazione cancellata:</strong></p>
        <ul>
            <li><strong>Data di arrivo:</strong> {{ $mailData['arrivo'] }}</li>
            <li><strong>Data di partenza:</strong> {{ $mailData['partenza'] }}</li>
            <li><strong>Prezzo Totale:</strong> €{{ $mailData['prezzoTotale'] }}</li>
            <li><strong>Telefono:</strong> {{ $mailData['telefono'] }}</li>
        </ul>

        <p>Distinti saluti,<br>Christian Girardelli - Zenzero Holidays</p>
    </body>
</html>
