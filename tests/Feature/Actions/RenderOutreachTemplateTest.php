<?php

use App\Actions\RenderOutreachTemplate;
use App\Models\OutreachTemplate;
use App\Models\Prospect;

it('substitutes all five placeholders in subject and body', function () {
    $prospect = Prospect::factory()->create([
        'name' => 'Acme BV',
        'website' => 'https://www.acme.nl/vacatures',
        'contact_first_name' => 'Jan',
        'contact_last_name' => 'Jansen',
    ]);

    $template = OutreachTemplate::factory()->create([
        'subject' => 'Idea for {{company_name}} ({{domain}})',
        'body' => 'Hi {{contact_first_name}} {{contact_last_name}}, I saw {{website}}.',
    ]);

    $rendered = RenderOutreachTemplate::run($template, $prospect);

    expect($rendered['subject'])->toBe('Idea for Acme BV (acme.nl)')
        ->and($rendered['body'])->toBe('Hi Jan Jansen, I saw https://www.acme.nl/vacatures.');
});

it('tolerates whitespace inside the placeholder braces', function () {
    $prospect = Prospect::factory()->create(['name' => 'Acme BV']);

    $template = OutreachTemplate::factory()->create([
        'subject' => 'Hi {{ company_name }}',
        'body' => 'Hi {{company_name}}',
    ]);

    $rendered = RenderOutreachTemplate::run($template, $prospect);

    expect($rendered['subject'])->toBe('Hi Acme BV')
        ->and($rendered['body'])->toBe('Hi Acme BV');
});

it('leaves unknown placeholders untouched', function () {
    $prospect = Prospect::factory()->create(['name' => 'Acme BV']);

    $template = OutreachTemplate::factory()->create([
        'subject' => 'Hi {{company_name}}',
        'body' => 'Ask about {{ceo_dog_name}}',
    ]);

    $rendered = RenderOutreachTemplate::run($template, $prospect);

    expect($rendered['body'])->toBe('Ask about {{ceo_dog_name}}');
});

it('substitutes a null contact field to an empty string', function () {
    $prospect = Prospect::factory()->create([
        'name' => 'Acme BV',
        'contact_first_name' => null,
    ]);

    $template = OutreachTemplate::factory()->create([
        'subject' => 'Subject',
        'body' => 'Hi {{contact_first_name}}, hello.',
    ]);

    $rendered = RenderOutreachTemplate::run($template, $prospect);

    expect($rendered['body'])->toBe('Hi , hello.')
        ->and($rendered['body'])->not->toContain('{{contact_first_name}}');
});

it('never interprets Blade syntax in the template body', function () {
    $prospect = Prospect::factory()->create(['name' => 'Acme BV']);

    $template = OutreachTemplate::factory()->create([
        'subject' => 'Subject',
        'body' => "Value: {{ 7*7 }} @php echo 'pwned'; @endphp",
    ]);

    $rendered = RenderOutreachTemplate::run($template, $prospect);

    expect($rendered['body'])->toBe("Value: {{ 7*7 }} @php echo 'pwned'; @endphp")
        ->and($rendered['body'])->not->toContain('49');
});
