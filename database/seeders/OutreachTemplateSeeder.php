<?php

namespace Database\Seeders;

use App\Enums\CompanyType;
use App\Models\OutreachTemplate;
use Illuminate\Database\Seeder;

class OutreachTemplateSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->templates() as $template) {
            OutreachTemplate::query()->updateOrCreate(
                ['name' => $template['name']],
                $template,
            );
        }
    }

    /**
     * A starter template per company type so the compose action has something to
     * suggest on day one. Each uses real placeholders and carries an opt-out
     * sentence: under art. 11.7 Telecommunicatiewet every commercial message needs
     * a quick, valid opt-out and the ban covers companies too. Because sending is
     * manual from Outlook, this sentence is the compliance mechanism.
     *
     * @return list<array{name: string, company_type: CompanyType, subject: string, body: string}>
     */
    private function templates(): array
    {
        $optOut = 'Liever geen mail meer van mij? Eén woordje terug en ik haal je uit mijn lijst.';

        return [
            [
                'name' => 'Agency partnership',
                'company_type' => CompanyType::Agency,
                'subject' => 'Samenwerken met {{company_name}}?',
                'body' => "Hoi {{contact_first_name}},\n\n"
                    .'Ik kwam {{website}} tegen en zag dat {{company_name}} mooi werk levert. '
                    .'Wij bouwen web- en maatwerkapplicaties en pakken regelmatig overloop of '
                    ."specialistisch werk op voor bureaus.\n\n"
                    ."Zullen we een keer bellen om te kijken of we elkaar kunnen versterken?\n\n"
                    ."Met vriendelijke groet,\nMecctech Solutions\n\n"
                    .$optOut,
            ],
            [
                'name' => 'Direct client pitch',
                'company_type' => CompanyType::DirectClient,
                'subject' => 'Een idee voor de website van {{company_name}}',
                'body' => "Hoi {{contact_first_name}},\n\n"
                    .'Ik bekeek {{website}} en zie kansen om de site van {{company_name}} sneller '
                    ."en gebruiksvriendelijker te maken. Wij bouwen websites en applicaties op maat.\n\n"
                    .'Vind je het goed als ik een paar concrete verbeterpunten op een rij zet en die '
                    ."met je deel?\n\n"
                    ."Met vriendelijke groet,\nMecctech Solutions\n\n"
                    .$optOut,
            ],
            [
                'name' => 'Staffing agency intro',
                'company_type' => CompanyType::StaffingAgency,
                'subject' => 'Developmentcapaciteit voor {{company_name}}',
                'body' => "Hoi {{contact_first_name}},\n\n"
                    .'Ik zag {{website}} en vroeg me af of {{company_name}} weleens development- of '
                    .'maatwerkvragen krijgt die je nu niet kunt invullen. Die pakken wij graag op als '
                    ."verlengstuk van jullie team.\n\n"
                    ."Zullen we kort kennismaken?\n\n"
                    ."Met vriendelijke groet,\nMecctech Solutions\n\n"
                    .$optOut,
            ],
        ];
    }
}
