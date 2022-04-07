<?php

return [
    "requirements" => [
        "paragraph" => [
            "one" => "Door gebruik te maken van domain stories schets ik de business logica uit, zonder het schrijven van een regel code. In de onderstaande afbeelding kun je een voorbeeld zien van zo'n domain story, welke onderdeel is van een groter warehouse management systeem. Samen itereren we over de domain story, totdat duidelijk is wat er gemaakt moet gaan worden.",
            "two" => "Hierna start ik met het opzetten van het project in Azure DevOps. Iedere zin in de domain story wordt een aparte feature met bijbehorende acceptatie criteria, welke ik gebruik om automatisch acceptatie tests te schrijven: ",
            "three" => "Na het schrijven van de acceptatie test is het tijd om de code te gaan schrijven zodat deze test slaagt!"
        ]
    ],
    "design" => [
        "paragraph" => [
            "one" => "Ik gebruik de domain story om een ontwerp te maken van de code:",
            "two" => "Daarna begin ik met het uitschrijven van de domain story in de code, iedere zin in de story wordt een use case in de code. In het voorbeeld onder 'Requirements' gebruikte ik het aanmaken van een picklijst voor een order, welke vertaald in de use case CreatePicklistFromOrder. Zo'n use case is geprogrammeerd zodat zelfs een niet technisch persoon (met een beetje hulp over de syntax) kan begrijpen wat er staat. Deze use case heeft als input de order referentie, kijkt welke order regels op voorraad zijn en maakt hier een picklijst van:",
            "three" => "Daarna gaan we samen discussieren over de use case, of deze voldoet aan de requirements. Als we het eens zijn over de functionaliteit van een use case ga ik verder met het programmeren van de lagere level logica, zodat de use case ook daadwerkelijk doet wat hij moet doen"
        ]
    ],
    "functionality" => [
        "paragraph" => [
            "one" => "Ik ben gespecialiseerd in het programmeren in Laravel, wat ik gebruik voor het schrijven van al mijn backend logica. Dit is zowel eerder ontworpen business logica als de logica van de infrastructuur. Ik structureer mijn code in een hexagonal / clean architectuur, wat betekent dat ik mijn business logica (uses cases en domein model) scheidt van de infrastructuur en presentatie laag. Hierdoor blijft mijn code clean, onderhoudbaar en schaalbaar. Om een voorbeeld te noemen, in de business logica zul je alleen zien dat er gemaild moet worden naar de klant met een MailerService. In de infrastructuur wordt de MailerService geimplementeerd met een MailchimpMailerService, maar de business logica heeft geen weet van de daadwerkelijke implementatie.",
            "two" => "Uiteraard gebruik ik version control met git, waar ik werk met branches per feature, gebruik ik cleane commits en ben ervaren met het werken met andere mensen via git. Verder zorg ik ervoor dat de juiste relationale database structuur wordt opgezet met MySql en deploy ik de code op een server indien nodig"
        ]
    ],
    "user_interface" => [
        "paragraph" => [
            "one" => "Voordat ik begin met het schrijven van front end software maak ik een schets van het design in Figma aan de hand van de requirements, zodat we snel kunnen itereren hierop. Als het design klaar programmeer ik de UI met HTML5, TailwindCSS en Vue.js. De UI is altijd responsive (schaalt op verschillende scherm groottes) en ik maak hem dynamisch met Vue.js.",
            "two" => "Verder ben ik ervaren met het werken met designers, die het design voor mij maken, zodat ik kan focussen op het programmeren."
        ]
    ]
];
