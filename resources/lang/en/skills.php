<?php

return [
    "requirements" => [
        "paragraph" => [
            "one" => "Through the use of domain stories I sketch out the business logic you want me to build, before writing any software. In the image below you see an example domain story that is part of a larger warehouse management system. We iterate over this domain story multiple times until we agree on the business logic being correct.",
            "two" => "After that I start creating work items in Azure DevOps, where each sentence in the domain story becomes a feature. Acceptance criteria are specified according to your requirements, after which I start writing acceptance tests in phpunit that automatically test these criteria:",
            "three" => "Now it's time to start designing the code that should pass the acceptance test!"
        ]
    ],
    "design" => [
        "paragraph" => [
            "one" => "Before writing any software, I use the developed domain story from the requirements part to make a rough design of the domain model:",
            "two" => "Then I start writing the highest level of code possible: the use case. In the previous example of creating a picklist from an order, the use case name would be CreatePicklistFromOrder. This use case is written such that any non-technical person is able to read it (with a little help about the syntax). This use case should have the order reference as input, looks up the order items that are on stock and create a picklist for these:",
            "three" => "We discuss the content of the use case, and if it satisfies with your requirements. If we agree on the functionality, I will start building the rest of the application to make the use case fully work."
        ]
    ],
    "functionality" => [
        "paragraph" => [
            "one" => "I am specialized in using Laravel as a backend framework, which I use to create all the necessary functionalities, My Laravel code has a well structured architecture, that separates the business logic from the infrastructure and presentation layer. This keeps the code clean, maintainable, readable and scalable. I will first start writing the domain layer of the application, containing the business logic discussed. I will make the acceptance tests pass using dummy interface implementations. After that I will start writing the infrastructure, for example an EloquentOrderRepository or a MailChimpMailerService.",
            "two" => "Of course I use version control with git, keep my commits clean and small, and am experienced in working with other developers on git. Furthermore I will set up the required relational database structure, and will deploy the code on a server if needed."
        ]
    ],
    "user_interface" => [
        "paragraph" => [
            "one" => "Before writing any front end software I sketch a design in Figma according to your requirements. This way we can iterate on the design easily. After agreeing on the design, I start coding the user interface using HTML5, TailwindCSS and Vue.js. The user interface is always responsive (scales with different screen sizes) and I make them dynamic using Vue.js.",
            "two" => "I am also experienced in working with other designers that create the design for me, after which I build the UI."
        ]
    ]
];
