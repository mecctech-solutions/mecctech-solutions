<template>
    <div class="grid grid-cols-1 mt-5" :class="[ this.more_information ? 'md:grid-cols-4' : 'md:grid-cols-4' ]">
        <skill v-if="! this.more_information || this.more_information_skill === $lang.get('about.requirements')" @more-information-clicked="handleMoreInformationClicked" :description="$lang.get('about.requirements_summary')" explanation="" :title="$lang.get('about.requirements')" svg_d="M362.7 19.32C387.7-5.678 428.3-5.678 453.3 19.32L492.7 58.75C517.7 83.74 517.7 124.3 492.7 149.3L444.3 197.7L314.3 67.72L362.7 19.32zM421.7 220.3L188.5 453.4C178.1 463.8 165.2 471.5 151.1 475.6L30.77 511C22.35 513.5 13.24 511.2 7.03 504.1C.8198 498.8-1.502 489.7 .976 481.2L36.37 360.9C40.53 346.8 48.16 333.9 58.57 323.5L291.7 90.34L421.7 220.3z" view_box="0 0 512 512"></skill>
        <skill v-if="! this.more_information || this.more_information_skill === $lang.get('about.design')" @more-information-clicked="handleMoreInformationClicked" :description="$lang.get('about.design_summary')" explanation="" :title="$lang.get('about.design')" svg_d="M224 0H336C362.5 0 384 21.49 384 48V256H0V48C0 21.49 21.49 0 48 0H64L96 64L128 0H160L192 64L224 0zM384 288V320C384 355.3 355.3 384 320 384H256V448C256 483.3 227.3 512 192 512C156.7 512 128 483.3 128 448V384H64C28.65 384 0 355.3 0 320V288H384zM192 464C200.8 464 208 456.8 208 448C208 439.2 200.8 432 192 432C183.2 432 176 439.2 176 448C176 456.8 183.2 464 192 464z" view_box="0 0 384 512"></skill>
        <skill v-if="! this.more_information || this.more_information_skill === $lang.get('about.functionality')" @more-information-clicked="handleMoreInformationClicked" :description="$lang.get('about.functionality_summary')" explanation="" :title="$lang.get('about.functionality')" svg_d="M3,16H12V21H3V16M2,10H8V15H2V10M9,10H15V15H9V10M16,10H22V15H16V10M13,16H21V21H13V16M3,4H11V9H3V4M12,4H21V9H12V4Z" view_box="0 0 24 24"></skill>
        <skill v-if="! this.more_information || this.more_information_skill === $lang.get('about.user_interface')" @more-information-clicked="handleMoreInformationClicked" :description="$lang.get('about.user_interface_summary')" explanation="" :title="$lang.get('about.user_interface')" svg_d="M3,16H12V21H3V16M2,10H8V15H2V10M9,10H15V15H9V10M16,10H22V15H16V10M13,16H21V21H13V16M3,4H11V9H3V4M12,4H21V9H12V4Z" view_box="0 0 24 24"></skill>

        <div v-if="this.more_information && this.more_information_skill === $lang.get('about.requirements')" class="md:col-span-2 block pl-20 pr-20 md:pr-32 pt-10 text-xl">
            <p>
                {{ $lang.get('skills.requirements.paragraph.one') }}
            </p>
            <div class="flex md:p-10 md:flex-row flex-col">
                <img src="images/processing_an_order.png" alt="Domain story example" class="p-5">
                <img class="object-scale-down" src="images/create_picklist_from_order.png" alt="Create picklist from order feature in Azure DevOps">
            </div>
            <p>
                {{ $lang.get('skills.requirements.paragraph.two') }}
            </p>
            <br>
            <code class="break-words md:break-normal"><span style="color: #000000">
                <span style="color: #0000BB">&lt;?php<br /></span><span style="color: #007700">public&nbsp;function&nbsp;</span><span style="color: #0000BB">it_should_create_a_picklist_from_order_lines_that_are_in_stock</span><span style="color: #007700">()&nbsp;{<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #FF8000">//&nbsp;Given<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$order&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">OrderFactory</span><span style="color: #007700">::</span><span style="color: #0000BB">create</span><span style="color: #007700">([<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #DD0000">"order_lines"&nbsp;</span><span style="color: #007700">=&gt;&nbsp;[<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #DD0000">"product_code"&nbsp;</span><span style="color: #007700">=&gt;&nbsp;</span><span style="color: #DD0000">"Test&nbsp;Product&nbsp;Code&nbsp;1"</span><span style="color: #007700">,<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #DD0000">"on_stock"&nbsp;</span><span style="color: #007700">=&gt;&nbsp;</span><span style="color: #0000BB">false<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #007700">],<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #DD0000">"product_code"&nbsp;</span><span style="color: #007700">=&gt;&nbsp;</span><span style="color: #DD0000">"Test&nbsp;Product&nbsp;Code&nbsp;2"</span><span style="color: #007700">,<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #DD0000">"on_stock"&nbsp;</span><span style="color: #007700">=&gt;&nbsp;</span><span style="color: #0000BB">true<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #007700">]<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]);<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$url&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">route</span><span style="color: #007700">(</span><span style="color: #DD0000">"create-picklist-from-order"</span><span style="color: #007700">);<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #FF8000">//&nbsp;When<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$response&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">$this</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">post</span><span style="color: #007700">(</span><span style="color: #0000BB">$url</span><span style="color: #007700">,&nbsp;[<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #DD0000">"order_reference"&nbsp;</span><span style="color: #007700">=&gt;&nbsp;</span><span style="color: #0000BB">$order</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">reference</span><span style="color: #007700">()<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]<br />&nbsp;&nbsp;&nbsp;&nbsp;)<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #FF8000">//&nbsp;Then<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">self</span><span style="color: #007700">::</span><span style="color: #0000BB">assertEquals</span><span style="color: #007700">(</span><span style="color: #0000BB">1</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">$response</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">picklist</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">orderLines</span><span style="color: #007700">()-&gt;</span><span style="color: #0000BB">count</span><span style="color: #007700">());<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">self</span><span style="color: #007700">::</span><span style="color: #0000BB">assertEquals</span><span style="color: #007700">(</span><span style="color: #DD0000">"Test&nbsp;Product&nbsp;Code&nbsp;2"</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">$response</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">picklist</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">orderLines</span><span style="color: #007700">()-&gt;</span><span style="color: #0000BB">first</span><span style="color: #007700">()-&gt;</span><span style="color: #0000BB">productCode</span><span style="color: #007700">());<br />}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br /></span><span style="color: #0000BB">?&gt;</span>
                </span>
            </code>
            <br>
            <br>
            <p>
                {{ $lang.get('skills.requirements.paragraph.three') }}
            </p>
        </div>

        <div v-else-if="this.more_information && this.more_information_skill === $lang.get('about.design')" class="md:col-span-2 block pl-20 pr-20 md:pr-32 pt-10 text-xl">
            <p>
                {{ $lang.get('skills.design.paragraph.one') }}
            </p>
            <img class="p-10" src="images/order_and_picklists_class_diagram.svg" alt="">
            <p>
                {{ $lang.get('skills.design.paragraph.two') }}
            </p>
            <br>
            <code class="break-words md:break-normal"><span style="color: #000000">
                <span style="color: #0000BB">&lt;?php<br /></span><span style="color: #007700">class&nbsp;</span><span style="color: #0000BB">CreatePicklist<br /></span><span style="color: #007700">{<br />&nbsp;&nbsp;&nbsp;&nbsp;private&nbsp;</span><span style="color: #0000BB">OrderRepositoryInterface&nbsp;$orderRepository</span><span style="color: #007700">;<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;</span><span style="color: #0000BB">__construct</span><span style="color: #007700">(</span><span style="color: #0000BB">OrderRepositoryInterface&nbsp;$orderRepository</span><span style="color: #007700">)<br />&nbsp;&nbsp;&nbsp;&nbsp;{<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$this</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">orderRepository&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">$orderRepository</span><span style="color: #007700">;<br />&nbsp;&nbsp;&nbsp;&nbsp;}<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;public&nbsp;function&nbsp;</span><span style="color: #0000BB">execute</span><span style="color: #007700">(</span><span style="color: #0000BB">CreatePicklistRequestInput&nbsp;$input</span><span style="color: #007700">):&nbsp;</span><span style="color: #0000BB">CreatePicklistRequestResult<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #007700">{<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$order&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">$this</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">orderRepository</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">findByReference</span><span style="color: #007700">(</span><span style="color: #0000BB">$input</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">orderReference</span><span style="color: #007700">());<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$picklist&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">$order</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">createPicklist</span><span style="color: #007700">();<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$backorders&nbsp;</span><span style="color: #007700">=&nbsp;</span><span style="color: #0000BB">$order</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">createBackorders</span><span style="color: #007700">();<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">$this</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">orderRepository</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">update</span><span style="color: #007700">(</span><span style="color: #0000BB">$order</span><span style="color: #007700">);<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;new&nbsp;</span><span style="color: #0000BB">CreatePicklistRequestResult</span><span style="color: #007700">(</span><span style="color: #0000BB">$picklist</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">$backorders</span><span style="color: #007700">);<br />&nbsp;&nbsp;&nbsp;&nbsp;}<br />}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br /></span><span style="color: #0000BB">?&gt;</span>
                </span>
            </code>
            <p>
                {{ $lang.get('skills.design.paragraph.three') }}
            </p>
        </div>

        <div v-else-if="this.more_information && this.more_information_skill === $lang.get('about.functionality')" class="col-span-2 block pl-20 pr-20 md:pr-32 pt-10 text-xl">
            <p>
                {{ $lang.get('skills.functionality.paragraph.one') }}
            </p>
            <img v-show="this.more_information_skill === $lang.get('about.functionality')" src="images/use_case.png" alt="Functionality example Laravel" class="p-10 mx-auto">
            <p>
                {{ $lang.get('skills.functionality.paragraph.two') }}
            </p>
        </div>

        <div v-else-if="this.more_information && this.more_information_skill === $lang.get('about.user_interface')" class="col-span-2 block pl-20 pr-20 md:pr-32 pt-10 text-xl">
            <p>
                {{ $lang.get('skills.user_interface.paragraph.one') }}
            </p>
            <img v-show="this.more_information_skill === $lang.get('about.user_interface')" src="images/supra_solutions_figma.png" alt="Design using Figma example" class="p-10 mx-auto">
            <p>
                {{ $lang.get('skills.user_interface.paragraph.two') }}
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
