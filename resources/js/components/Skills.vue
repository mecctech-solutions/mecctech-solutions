<template>
    <div class="grid grid-cols-1 mt-5" :class="[ this.more_information ? 'md:grid-cols-3' : 'md:grid-cols-3' ]">
        <skill v-if="! this.more_information || this.more_information_skill === 'Requirements'" @more-information-clicked="handleMoreInformationClicked" description="I make sure it is clear what you want me to build." explanation="" title="Requirements" svg_d="M362.7 19.32C387.7-5.678 428.3-5.678 453.3 19.32L492.7 58.75C517.7 83.74 517.7 124.3 492.7 149.3L444.3 197.7L314.3 67.72L362.7 19.32zM421.7 220.3L188.5 453.4C178.1 463.8 165.2 471.5 151.1 475.6L30.77 511C22.35 513.5 13.24 511.2 7.03 504.1C.8198 498.8-1.502 489.7 .976 481.2L36.37 360.9C40.53 346.8 48.16 333.9 58.57 323.5L291.7 90.34L421.7 220.3z" view_box="0 0 512 512"></skill>
        <skill v-if="! this.more_information || this.more_information_skill === 'Design'" @more-information-clicked="handleMoreInformationClicked" description="I design my code before building it" explanation="" title="Design" svg_d="M224 0H336C362.5 0 384 21.49 384 48V256H0V48C0 21.49 21.49 0 48 0H64L96 64L128 0H160L192 64L224 0zM384 288V320C384 355.3 355.3 384 320 384H256V448C256 483.3 227.3 512 192 512C156.7 512 128 483.3 128 448V384H64C28.65 384 0 355.3 0 320V288H384zM192 464C200.8 464 208 456.8 208 448C208 439.2 200.8 432 192 432C183.2 432 176 439.2 176 448C176 456.8 183.2 464 192 464z" view_box="0 0 384 512"></skill>
        <skill v-if="! this.more_information || this.more_information_skill === 'Functionality'" @more-information-clicked="handleMoreInformationClicked" description="Scalable, readible and maintainable logic" explanation="" title="Functionality" svg_d="M3,16H12V21H3V16M2,10H8V15H2V10M9,10H15V15H9V10M16,10H22V15H16V10M13,16H21V21H13V16M3,4H11V9H3V4M12,4H21V9H12V4Z" view_box="0 0 24 24"></skill>

        <!--  Dummy div to force text on third column -->
<!--        <div v-if="this.more_information">-->
<!--            <img v-show="this.more_information_skill === 'Functionality'" src="images/use_case.svg" alt="Functionality example Laravel" class="p-5">-->
<!--        </div>-->

        <div v-if="this.more_information && this.more_information_skill === 'Requirements'" class="col-span-2 block pl-20 pr-20 md:pr-32 pt-10 text-xl">
            <p>
                Through the use of domain stories I sketch out the business logic you want me to build, before writing any software. In the image below you see an example domain story that is part of a larger warehouse management system. We iterate over this domain story multiple times until we agree on the business logic being correct.
            </p>
            <div class="flex p-10">
                <img src="images/processing_an_order.png" alt="Domain story example" class="p-5">
                <img class="object-scale-down" src="images/create_picklist_from_order.png" alt="Create picklist from order feature in Azure DevOps">
            </div>
            <p>
                After that I start creating work items in Azure DevOps, where each sentence in the domain story becomes a feature. Acceptance criteria are specified according to your requirements, after which I start writing acceptance tests in <code>phpunit</code> that automatically test these criteria:
            </p>
            <br>
            <code><span style="color: #000000">
<span style="color: #0000BB">&lt;?php<br /></span><span style="color: #007700">public&nbsp;function&nbsp;</span><span style="color: #0000BB">it_should_create_a_picklist_from_order_lines_that_are_in_stock</span><span style="color: #007700">()&nbsp;{<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #FF8000">//&nbsp;Given<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$order&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">OrderFactory</span><span style="color: #007700">::</span><span style="color: #0000BB">create</span><span style="color: #007700">([<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #DD0000">"order_lines"&nbsp;</span><span style="color: #007700">=&gt;&nbsp;[<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #DD0000">"product_code"&nbsp;</span><span style="color: #007700">=&gt;&nbsp;</span><span style="color: #DD0000">"Test&nbsp;Product&nbsp;Code&nbsp;1"</span><span style="color: #007700">,<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #DD0000">"on_stock"&nbsp;</span><span style="color: #007700">=&gt;&nbsp;</span><span style="color: #0000BB">false<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #007700">],<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #DD0000">"product_code"&nbsp;</span><span style="color: #007700">=&gt;&nbsp;</span><span style="color: #DD0000">"Test&nbsp;Product&nbsp;Code&nbsp;2"</span><span style="color: #007700">,<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #DD0000">"on_stock"&nbsp;</span><span style="color: #007700">=&gt;&nbsp;</span><span style="color: #0000BB">true<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #007700">]<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]);<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$url&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">route</span><span style="color: #007700">(</span><span style="color: #DD0000">"create-picklist-from-order"</span><span style="color: #007700">);<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #FF8000">//&nbsp;When<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$response&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">$this</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">post</span><span style="color: #007700">(</span><span style="color: #0000BB">$url</span><span style="color: #007700">,&nbsp;[<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #DD0000">"order_reference"&nbsp;</span><span style="color: #007700">=&gt;&nbsp;</span><span style="color: #0000BB">$order</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">reference</span><span style="color: #007700">()<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]<br />&nbsp;&nbsp;&nbsp;&nbsp;)<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #FF8000">//&nbsp;Then<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">self</span><span style="color: #007700">::</span><span style="color: #0000BB">assertEquals</span><span style="color: #007700">(</span><span style="color: #0000BB">1</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">$response</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">picklist</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">orderLines</span><span style="color: #007700">()-&gt;</span><span style="color: #0000BB">count</span><span style="color: #007700">());<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">self</span><span style="color: #007700">::</span><span style="color: #0000BB">assertEquals</span><span style="color: #007700">(</span><span style="color: #DD0000">"Test&nbsp;Product&nbsp;Code&nbsp;2"</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">$response</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">picklist</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">orderLines</span><span style="color: #007700">()-&gt;</span><span style="color: #0000BB">first</span><span style="color: #007700">()-&gt;</span><span style="color: #0000BB">productCode</span><span style="color: #007700">());<br />}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br /></span><span style="color: #0000BB">?&gt;</span>
</span>
            </code>
            <br>
            <br>
            <p>Now it's time to start designing the code that should pass the acceptance test!</p>
        </div>

        <div v-else-if="this.more_information && this.more_information_skill === 'Design'" class="col-span-2 block pl-20 pr-20 md:pr-32 pt-10 text-xl">
            <p>
                Before writing any software I use the developed domain story from the requirements part to make a rough design of the domain model:
<!--                Before writing any front end software I sketch a design in Figma according to your requirements. This way we can iterate on the design easily. After agreeing on the design, I start coding the user interface using HTML5, TailwindCSS and Vue.js. The user interface is always responsive (scales with different screen sizes) and I make them dynamic using Vue.js.-->
            </p>
            <img class="p-10" src="images/order_and_picklists_class_diagram.svg" alt="">
<!--            <img src="images/supra_solutions_figma.png" alt="Design using Figma example" class="p-5">-->
            <p>
                Then I start writing the highest level of code possible: the use case. In the previous example of creating a picklist from an order, the use case name would be CreatePicklistFromOrder. This use case is written such that any non-technical person is able to read it (with a little help about the syntax). This use case should have the order reference as input, looks up the order items that are on stock and create a picklist for these:
            </p>
            <br>
            <code><span style="color: #000000">
                <span style="color: #0000BB">&lt;?php<br /></span><span style="color: #007700">class&nbsp;</span><span style="color: #0000BB">CreatePicklist<br /></span><span style="color: #007700">{<br />&nbsp;&nbsp;&nbsp;&nbsp;private&nbsp;</span><span style="color: #0000BB">OrderRepositoryInterface&nbsp;$orderRepository</span><span style="color: #007700">;<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;</span><span style="color: #0000BB">__construct</span><span style="color: #007700">(</span><span style="color: #0000BB">OrderRepositoryInterface&nbsp;$orderRepository</span><span style="color: #007700">)<br />&nbsp;&nbsp;&nbsp;&nbsp;{<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$this</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">orderRepository&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">$orderRepository</span><span style="color: #007700">;<br />&nbsp;&nbsp;&nbsp;&nbsp;}<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;</span><span style="color: #0000BB">execute</span><span style="color: #007700">(</span><span style="color: #0000BB">CreatePicklistRequestInput&nbsp;$input</span><span style="color: #007700">):&nbsp;</span><span style="color: #0000BB">CreatePicklistRequestResult<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #007700">{<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$order&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">$this</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">orderRepository</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">findByReference</span><span style="color: #007700">(</span><span style="color: #0000BB">$input</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">orderReference</span><span style="color: #007700">());<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$picklist&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">$order</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">createPicklist</span><span style="color: #007700">();<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$backorders&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">$order</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">createBackorders</span><span style="color: #007700">();<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$this</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">orderRepository</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">update</span><span style="color: #007700">(</span><span style="color: #0000BB">$order</span><span style="color: #007700">);<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;new&nbsp;</span><span style="color: #0000BB">CreatePicklistRequestResult</span><span style="color: #007700">(</span><span style="color: #0000BB">$picklist</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">$backorders</span><span style="color: #007700">);<br />&nbsp;&nbsp;&nbsp;&nbsp;}<br />}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br /></span><span style="color: #0000BB">?&gt;</span>
                </span>
            </code>
            <p>
                We discuss the content of the use case, and if it satisfies with your requirements. If we agree on the functionality, I will start building the rest of the application to make the use case fully work.
            </p>
        </div>

        <div v-else-if="this.more_information && this.more_information_skill === 'Functionality'" class="col-span-2 block pl-20 pr-20 md:pr-32 pt-10 text-xl">
            <p>
                My code has a well structured architecture, which separates the business logic from the infrastructure and presentation layer. This keeps the code clean and scalable. I will first start writing the domain layer of the application, containing the business logic discussed.
<!--                I am specialized in using Laravel to write the backbone of the application. My software is readable, scalable, extensible and maintainable. I achieve this by applying techniques like Domain Driven Design, Clean Architecture, Test Driven Development and Software Design Patterns.-->

            </p>
        </div>
    </div>
</template>

<script>
    import Skill from './Skill'

    export default {
        props: [],
        data() {
            return {
                more_information : false,
                more_information_skill : ''
            }
        },
        components: {
            Skill
        },
        mounted() {

        },
        methods : {
            handleMoreInformationClicked(input) {
                let title = input['title'];
                let moreInformation = input['more_information'];

                this.more_information = moreInformation;

                if (moreInformation)
                {
                    this.more_information_skill = title;
                } else {
                    this.more_information_skill = '';
                }
            }
        }
    }
</script>
