<x-email-layout title="Welkom bij {{ config('app.name') }}"
                preheader="Welkom bij {{ config('app.name') }}">

    <x-slot:header>
        <x-email-header :url="config('app.url')" :companyName="config('app.name')"/>
    </x-slot:header>

    <x-email-heading level="1" color="#333333">Bedankt voor je bestelling</x-email-heading>

    <x-email-paragraph>
        Je bestelling is ontvangen en wordt nu verwerkt.
    </x-email-paragraph>

    <x-email-alert type="info">
        We sturen je een bevestigingsmail zodra je bestelling is verzonden.
    </x-email-alert>

    <x-email-image
        src="/images/notification-logo.png"
        alt="Bedrijfslogo"/>

    <x-email-table>
        <x-email-table-row>
            <x-email-table-header :columns="['Product', 'Aantal', 'Prijs']"/>
        </x-email-table-row>
        <x-email-table-row>
            <x-email-table-cell>cell</x-email-table-cell>
            <x-email-table-cell>cell</x-email-table-cell>
            <x-email-table-cell>cell</x-email-table-cell>
        </x-email-table-row>
        <x-email-table-row>
            <x-email-table-cell>cell</x-email-table-cell>
            <x-email-table-cell>cell</x-email-table-cell>
            <x-email-table-cell>cell</x-email-table-cell>
        </x-email-table-row>
    </x-email-table>

    <x-email-divider/>

    <x-email-card>
        card
    </x-email-card>

    <x-email-heading level="2">Bestellingsoverzicht</x-email-heading>

    <x-email-panel>
        Je account is succesvol aangemaakt. Je kunt nu inloggen met je e-mailadres en het opgegeven wachtwoord.
    </x-email-panel>

    <p style="color: #3d4852; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
        Klik op de onderstaande knop om naar je dashboard te gaan:
    </p>

    <x-email-button :url="route('home')" color="#4CAF50">
        Naar Dashboard
    </x-email-button>

    <p style="color: #3d4852; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
        Als je vragen hebt, neem dan gerust contact op met ons supportteam.
    </p>

    <p style="color: #3d4852; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
        Met vriendelijke groet,<br>
        Het team van {{ config('app.name') }}
    </p>

    <x-email-subcopy :url="route('home')">
        Als je problemen hebt met het klikken op de "Naar Dashboard" knop, kopieer en plak de URL hieronder in je
        webbrowser:
    </x-email-subcopy>

    <x-slot:footer>
        <x-email-footer
            :companyName="config('app.name')"
            companyAddress="Voorbeeldstraat 123, 1234 AB Amsterdam"
            :unsubscribeUrl="route('home', ['email' => $user->email])"
        />
    </x-slot:footer>

</x-email-layout>
