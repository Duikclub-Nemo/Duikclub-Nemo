<x-email-layout title="Duikclub Nemo | E-mailadres bevestigen"
                preheader="Jouw e-mailadres is nog niet bevestigd.">

    <x-slot:header>
        <x-email-header/>
    </x-slot:header>

    <x-email-paragraph>
        Beste {{ $notifiable->first_name }},
    </x-email-paragraph>

    <x-email-paragraph>
        Klik op de knop hieronder om uw e-mailadres te bevestigen.
    </x-email-paragraph>

    <x-email-button :url="$url">
        E-mailadres bevestigen
    </x-email-button>

    <x-email-paragraph>
        Als je geen account hebt aangemaakt, hoef je verder niets te doen.
    </x-email-paragraph>

    <x-email-subcopy :url="$url">
        Als je problemen hebt met het klikken op de "E-mailadres bevestigen" knop, kopieer en plak de URL hieronder in je
        webbrowser:
    </x-email-subcopy>

    <x-slot:footer>
        <x-email-footer/>
    </x-slot:footer>

</x-email-layout>
