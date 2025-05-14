<x-email-layout title="Duikclub Nemo | Wachtwoord herstellen"
                preheader="Je hebt een wachtwoord herstel-link aangevraagd.">

    <x-slot:header>
        <x-email-header/>
    </x-slot:header>

    <x-email-paragraph>
        Beste {{ $notifiable->first_name }},
    </x-email-paragraph>

    <x-email-paragraph>
        Je ontvangt deze e-mail omdat we een verzoek hebben ontvangen om je wachtwoord opnieuw in te stellen.
    </x-email-paragraph>

    <x-email-button :url="$url">
        Wachtwoord resetten
    </x-email-button>

    <x-email-paragraph>
        Deze link om het wachtwoord te resetten verloopt over 60 minuten. <br>
        Als u geen wachtwoord opnieuw heeft aangevraagd, hoeft u verder niets te doen.
    </x-email-paragraph>

    <x-email-subcopy :url="$url">
        Als je problemen hebt met het klikken op de "Wachtwoord resetten" knop, kopieer en plak de URL hieronder in je
        webbrowser:
    </x-email-subcopy>

    <x-slot:footer>
        <x-email-footer/>
    </x-slot:footer>

</x-email-layout>
