<?php

return [
    'heading_text' => 'Op deze pagina laat ik stap voor stap zien hoe ik een project aanpak.',
    'title' => 'Genereren inkoopbestellingen',
    'date' => 'Datum',
    'location' => 'Locatie',
    'date_value' => 'Augustus',
    'text_section_1' => 'Het doel van deze applicatie is automatisch inkoopbestellingen te genereren op basis van de huidige voorraad. Deze inkoopbestellingen worden geexporteerd en daarna gemaild.',
    'text_section_2' => 'Verder moet dit op bepaalde tijdstippen en dagen gebeuren: bestelmomenten van de leverancier. Iedere dag plant de applicatie taken in die een potentiele inkoopbestelling genereren.',
    'text_section_3' => 'Allereerst begin ik met het vergaren van de requirements samen met de klant. Hieruit volgen verschillende features die ik in Azure DevOps beschrijf. De requirements voor dit project waren als volgt.',
    'requirement_1' => 'Product groepen worden onderscheiden door middel van een tag in Picqer',
    'requirement_2' => 'Als (vrije voorraad + vul voorraad aan tot niveau) < bestelniveau dan moet er besteld worden: vul voorraad aan tot niveau - vrije voorraad - te ontvangen',
    'requirement_3' => 'Het inkoop advies houdt rekening met minimale bestelhoeveelheid en bestel in veelvoud van',
    'requirement_4' => 'Er wordt rekening gehouden met minimaal bestelbedrag leverancier',
    'requirement_5' => 'Per leverancier een ander export bestand welke gemaild wordt naar de klant',
    'requirement_6' => 'Leverancier kan 0, 1 of meerdere bestelmomenten per dag hebben',
    'requirement_7' => 'Iedere minuut wordt gekeken of een inkoop order gegenereerd moet worden',
    'requirement_8' => 'Gemiste bestelmomenten van voorgande dagen worden niet ingehaald',
    'back_to_portfolio' => 'Terug naar portfolio',
];
