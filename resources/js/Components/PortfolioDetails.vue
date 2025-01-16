<template>
    <!-- ====== Page Title Section Start -->
    <section
        class="
        ud-relative
        ud-z-10
        ud-pt-[150px]
        ud-pb-[90px]
        ud-mb-20
        ud-overflow-hidden
        ud-mt-20
      "
    >
        <div class="ud-container">
            <div class="ud-flex ud-flex-wrap ud-items-center ud-mx-[-16px]">
                <div class="ud-w-full md:ud-w-8/12 lg:ud-w-7/12 ud-px-4">
                    <div class="ud-max-w-[570px] ud-mb-12 md:ud-mb-0">
                        <h1
                            class="
                  ud-font-bold ud-text-black ud-text-2xl
                  sm:ud-text-3xl
                  ud-mb-5
                "
                        >
                            Case Study
                        </h1>
                        <p
                            class="
                  ud-font-medium
                  ud-text-base
                  ud-text-body-color
                  ud-leading-relaxed
                "
                        >
                            {{ $lang.get('case_study.heading_text') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div>
        <span class="ud-absolute ud-bottom-0 ud-left-0 ud-z-[-1]">
          <svg
              width="730"
              height="206"
              viewBox="0 0 730 206"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
          >
            <rect
                opacity="0.08"
                width="136.991"
                height="563.705"
                transform="matrix(0.632736 0.774368 0.774368 -0.632736 -201.278 330.677)"
                fill="url(#paint0_linear_0:1)"
            />
            <rect
                opacity="0.05"
                width="345.355"
                height="563.705"
                transform="matrix(0.632736 0.774368 0.774368 -0.632736 74 330.677)"
                fill="url(#paint1_linear_0:1)"
            />
            <defs>
              <linearGradient
                  id="paint0_linear_0:1"
                  x1="68.4956"
                  y1="0"
                  x2="68.4956"
                  y2="563.705"
                  gradientUnits="userSpaceOnUse"
              >
                <stop stop-color="#4A6CF7" />
                <stop offset="1" stop-color="#4A6CF7" stop-opacity="0" />
              </linearGradient>
              <linearGradient
                  id="paint1_linear_0:1"
                  x1="172.678"
                  y1="0"
                  x2="172.678"
                  y2="563.705"
                  gradientUnits="userSpaceOnUse"
              >
                <stop stop-color="#4A6CF7" />
                <stop offset="1" stop-color="#4A6CF7" stop-opacity="0" />
              </linearGradient>
            </defs>
          </svg>
        </span>
            <span class="ud-absolute ud-top-0 ud-right-0 ud-z-[-1]">
          <svg
              width="405"
              height="206"
              viewBox="0 0 405 206"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
          >
            <rect
                opacity="0.08"
                width="289.718"
                height="563.705"
                transform="matrix(-0.707107 -0.707107 -0.707107 0.707107 603.461 -125.138)"
                fill="url(#paint0_linear_54:595)"
            />
            <defs>
              <linearGradient
                  id="paint0_linear_54:595"
                  x1="144.859"
                  y1="0"
                  x2="144.859"
                  y2="563.705"
                  gradientUnits="userSpaceOnUse"
              >
                <stop stop-color="#4A6CF7" />
                <stop offset="1" stop-color="#4A6CF7" stop-opacity="0" />
              </linearGradient>
            </defs>
          </svg>
        </span>
        </div>
    </section>
    <!-- ====== Page Title Section End -->

    <!-- ====== Blog Section Start -->
    <section class="ud-pb-20">
        <div class="ud-container">
            <div class="ud-flex ud-flex-wrap ud--mx-5">
                <div class="ud-w-full lg:ud-w-8/12 ud-px-5">
                    <div>
                        <div class="ud-rounded-sm ud-mb-8">
                            <img
                                :src="this.$root.baseUrl() + '/images/portfolio/portfolio-details.jpg'"
                                alt="image"
                                class="ud-w-full ud-object-cover ud-object-center"
                            />
                        </div>
                        <h3
                            class="
                  ud-font-bold ud-text-black ud-text-2xl
                  sm:ud-text-4xl
                  lg:ud-text-3xl
                  ud-mb-7
                "
                        >
                            {{ $lang.get('case_study.title') }}
                        </h3>
                        <p
                            class="
                  ud-text-base
                  sm:ud-text-lg
                  lg:ud-text-base
                  xl:ud-text-lg
                  ud-text-body-color ud-mb-8
                "
                        >
                            {{ $lang.get('case_study.text_section_1') }}
                        </p>
                        <p
                            class="
                  ud-text-base
                  sm:ud-text-lg
                  lg:ud-text-base
                  xl:ud-text-lg
                  ud-text-body-color ud-mb-10
                "
                        >
                            {{
                                $lang.get('case_study.text_section_2')
                            }}
                        </p>
                        <h4
                            class="
                  ud-font-bold ud-text-xl
                  sm:ud-text-2xl
                  lg:ud-text-xl
                  xl:ud-text-2xl
                  ud-text-black ud-mb-8
                "
                        >
                            <span class="ud-text-primary">01.</span> Requirements
                        </h4>
                        <p
                            class="
                  ud-text-base
                  sm:ud-text-lg
                  lg:ud-text-base
                  xl:ud-text-lg
                  ud-text-body-color ud-mb-10
                "
                        >
                            {{
                                $lang.get('case_study.text_section_3')
                            }}
                        </p>
                        <ul class="ud-list ud-list-inside ud-list-disc ud-mb-7">
                            <li
                                class="
                    ud-text-base
                    sm:ud-text-lg
                    lg:ud-text-base
                    xl:ud-text-lg
                    ud-text-primary ud-mb-3
                  "
                            >
                  <span class="ud-text-body-color">
                    {{ $lang.get('case_study.requirement_1') }}
                  </span>
                            </li>
                            <li
                                class="
                    ud-text-base
                    sm:ud-text-lg
                    lg:ud-text-base
                    xl:ud-text-lg
                    ud-text-primary ud-mb-3
                  "
                            >
                  <span class="ud-text-body-color">
                    {{ $lang.get('case_study.requirement_2') }}
                  </span>
                            </li>
                            <li
                                class="
                    ud-text-base
                    sm:ud-text-lg
                    lg:ud-text-base
                    xl:ud-text-lg
                    ud-text-primary ud-mb-3
                  "
                            >
                  <span class="ud-text-body-color">
                    {{ $lang.get('case_study.requirement_3') }}
                  </span>
                            </li>
                            <li
                                class="
                    ud-text-base
                    sm:ud-text-lg
                    lg:ud-text-base
                    xl:ud-text-lg
                    ud-text-primary ud-mb-3
                  "
                            >
                  <span class="ud-text-body-color">
                    {{ $lang.get('case_study.requirement_4') }}
                  </span>
                            </li>
                            <li
                                class="
                    ud-text-base
                    sm:ud-text-lg
                    lg:ud-text-base
                    xl:ud-text-lg
                    ud-text-primary ud-mb-3
                  "
                            >
                  <span class="ud-text-body-color">
                    {{ $lang.get('case_study.requirement_5') }}
                  </span>
                            </li>
                            <li
                                class="
                    ud-text-base
                    sm:ud-text-lg
                    lg:ud-text-base
                    xl:ud-text-lg
                    ud-text-primary ud-mb-3
                  "
                            >
                  <span class="ud-text-body-color">
                    {{ $lang.get('case_study.requirement_6') }}
                  </span>
                            </li>
                            <li
                                class="
                    ud-text-base
                    sm:ud-text-lg
                    lg:ud-text-base
                    xl:ud-text-lg
                    ud-text-primary ud-mb-3
                  "
                            >
                  <span class="ud-text-body-color">
                    {{ $lang.get('case_study.requirement_7') }}
                  </span>
                            </li>
                            <li
                                class="
                    ud-text-base
                    sm:ud-text-lg
                    lg:ud-text-base
                    xl:ud-text-lg
                    ud-text-primary ud-mb-3
                  "
                            >
                  <span class="ud-text-body-color">
                    {{ $lang.get('case_study.requirement_8') }}
                  </span>
                            </li>
                        </ul>
                        <p
                            class="
                  ud-text-base
                  sm:ud-text-lg
                  lg:ud-text-base
                  xl:ud-text-lg
                  ud-text-body-color ud-mb-10
                "
                        >
                            Deze requirements heb ik vervolgens opgesplitst in 4 features: Genereren inkoopadvies, genereren inkoopbestelling, inkoopbestelling mailen naar klant en plannen / plaatsen van inkoopbestellingen. Hier maak ik vervolgens een domain story van: op een visuele manier laten zien wat er gemaakt gaat worden.
                        </p>
                        <div>
                            <img :src="this.$root.baseUrl() + '/images/case_study/features.png'" alt="Features in Azure DevOps">
                            <img :src="this.$root.baseUrl() + '/images/case_study/domain_story.png'" alt="Domain story">
                        </div>
                        <h4
                            class="
                  ud-font-bold ud-text-xl
                  sm:ud-text-2xl
                  lg:ud-text-xl
                  xl:ud-text-2xl
                  ud-text-black ud-mb-8
                "
                        >
                            <span class="ud-text-primary">02.</span> Design
                        </h4>
                        <p
                            class="
                  ud-text-base
                  sm:ud-text-lg
                  lg:ud-text-base
                  xl:ud-text-lg
                  ud-text-body-color ud-mb-8
                "
                        >
                            Per feature schrijf ik een use case, waar ik als eerste mee begin om deze te designen. Ik zal in dit voorbeeld 1 use case uitwerken om het simpel te houden. Laten we de Genereer inkoopadvies feature hiervoor gebruiken.
                        </p>
                        <p
                            class="
                  ud-text-base
                  sm:ud-text-lg
                  lg:ud-text-base
                  xl:ud-text-lg
                  ud-text-body-color ud-mb-8
                "
                        >
                            Voor iedere requirement van de feature schrijf ik een test. Bijvoorbeeld, er moet rekening gehouden worden met minimaal bestelhoeveelheid en bestel in veelvoud van.
                        </p>
                        <pre><code class="language-php" type="prism-dark">/** @test */
public function it_should_generate_purchasing_advice_while_taking_minimum_purchasing_amount_and_purchase_in_multiples_of_into_account_1()
{
    // Given
    $desiredStock = 3;
    $stock = 0;
    $stockLevel = 3;
    $purchaseInMultiplesOf = 2;
    $minimumPurchasingAmount = 5;

    $inventoryItems = InventoryItemFactory::createMultiple(2, [
        'stock' => new Stock($stock, 0, $desiredStock, $stockLevel),
        'purchaseSettings' => new PurchaseSettings($purchaseInMultiplesOf, $minimumPurchasingAmount),
        'supplierId' => $this->peitsmanSupplier->identity(),
        'tags' => collect(['Onderhoudsproducten'])
    ]);

    $this->inventoryItemRepository->saveMultiple($inventoryItems);

    $url = route('generate-purchase-recommendations');

    // When
    $response = $this->post($url, [
        'suppliers' => [
            [
                'id' => (string) $this->peitsmanSupplier->identity(),
                'tags' => [
                    'Onderhoudsproducten'
                ]
            ]
        ]
    ]);

    // Then
    $response->assertExactJson([
        'payload' => [
            'purchase_recommendations' => [
                0 => [
                    'product_code' => $inventoryItems->first()->productCode(),
                    'amount_to_be_purchased' => 6,
                    'supplier_id' => (string) $inventoryItems->first()->supplierId(),
                    'product_code_supplier' => (string) $inventoryItems->first()->externalProductCode(),
                    'tag' => 'Onderhoudsproducten'
                ],
                1 => [
                    'product_code' => $inventoryItems[1]->productCode(),
                    'amount_to_be_purchased' => 6,
                    'supplier_id' => (string) $inventoryItems[1]->supplierId(),
                    'product_code_supplier' => (string) $inventoryItems[1]->externalProductCode(),
                    'tag' => 'Onderhoudsproducten'
                ]
            ]
        ]
    ]);
}
</code></pre>
                    </div>
                </div>
                <div class="ud-w-full lg:ud-w-4/12 ud-px-5">
                    <div
                        class="
                ud-bg-[#F8F9FF] ud-border ud-border-[#D7DFFF] ud-py-9 ud-px-6
                sm:ud-p-9
                lg:ud-px-6
                xl:ud-px-5
                ud-rounded-sm ud-mb-10
              "
                    >
                        <h3 class="ud-font-bold ud-text-primary ud-text-[22px] ud-mb-7">
                            Project Info
                        </h3>
                        <ul>
                            <li class="ud-flex lg:ud-flex-wrap xl:ud-flex-nowrap ud-mb-3">
                  <span
                      class="
                      ud-max-w-[90px]
                      ud-w-full
                      ud-font-medium
                      ud-text-black
                      ud-text-base
                      ud-flex
                      ud-justify-between
                    "
                  >
                    {{ $lang.get('case_study.date') }}
                    <span class="ud-text-body-color">:</span>
                  </span>
                                <span
                                    class="
                      ud-w-full
                      ud-font-medium
                      ud-text-body-color
                      ud-text-base
                      ud-pl-5
                      lg:ud-pl-0
                      xl:ud-pl-5
                    "
                                >
                    {{ $lang.get('case_study.date_value') }}, 21, 2024
                  </span>
                            </li>
                            <li class="ud-flex lg:ud-flex-wrap xl:ud-flex-nowrap ud-mb-3">
                  <span
                      class="
                      ud-max-w-[90px]
                      ud-w-full
                      ud-font-medium
                      ud-text-black
                      ud-text-base
                      ud-flex
                      ud-justify-between
                    "
                  >
                    Tags
                    <span class="ud-text-body-color">:</span>
                  </span>
                                <span
                                    class="
                      ud-w-full
                      ud-font-medium
                      ud-text-body-color
                      ud-text-base
                      ud-pl-5
                      lg:ud-pl-0
                      xl:ud-pl-5
                    "
                                >
                    Laravel, PHP, API, E-Commerce
                  </span>
                            </li>
                            <li class="ud-flex lg:ud-flex-wrap xl:ud-flex-nowrap">
                  <span
                      class="
                      ud-max-w-[90px]
                      ud-w-full
                      ud-font-medium
                      ud-text-black
                      ud-text-base
                      ud-flex
                      ud-justify-between
                    "
                  >
                        {{ $lang.get('case_study.location') }}
                    <span class="ud-text-body-color">:</span>
                  </span>
                                <span
                                    class="
                      ud-w-full
                      ud-font-medium
                      ud-text-body-color
                      ud-text-base
                      ud-pl-5
                      lg:ud-pl-0
                      xl:ud-pl-5
                    "
                                >
                    Delft, Nederland
                  </span>
                            </li>
                        </ul>
                    </div>
                    <div
                        class="
                ud-bg-[#F8F9FF] ud-border ud-border-[#D7DFFF] ud-py-9 ud-px-6
                sm:ud-p-9
                lg:ud-px-6
                xl:ud-px-5
                ud-rounded-sm
              "
                    >
                        <h3 class="ud-font-bold ud-text-primary ud-text-[22px] ud-mb-7">
                            Download Files
                        </h3>
                        <ul>
                            <li class="ud-flex ud-mb-4">
                                <a
                                    href="https://github.com/fmeccanici/plan_purchase_orders/archive/refs/heads/master.zip"
                                    class="
                      ud-w-full
                      ud-flex
                      ud-items-center
                      ud-font-medium
                      ud-text-base
                      ud-text-white
                      ud-bg-primary
                      ud-py-3
                      ud-px-5
                      ud-rounded-sm
                    "
                                >
                    <span class="ud-pr-2">
                      <svg
                          width="21"
                          height="21"
                          viewBox="0 0 21 21"
                          class="ud-fill-current"
                      >
                        <path
                            d="M5.00327 2.6569C4.56125 2.65777 4.13767 2.83419 3.82572 3.14736C3.51377 3.46053 3.339 3.88479 3.33986 4.32682L3.3659 17.6601C3.36676 18.1022 3.54318 18.5257 3.85635 18.8377C4.16952 19.1496 4.59379 19.3244 5.03581 19.3235L15.0358 19.304C15.4778 19.3032 15.9014 19.1267 16.2134 18.8136C16.5253 18.5004 16.7001 18.0761 16.6992 17.6341L16.6797 7.63411L11.6699 2.64389L5.00327 2.6569ZM5.00653 4.32357L10.8398 4.31218L10.848 8.47884L15.0146 8.4707L15.0325 17.6374L5.03256 17.6569L5.00653 4.32357ZM6.68621 10.987L6.68946 12.6536L13.3561 12.6406L13.3529 10.9739L6.68621 10.987ZM6.69271 14.3203L6.69597 15.987L10.8626 15.9788L10.8594 14.3122L6.69271 14.3203Z"
                        />
                      </svg>
                    </span>
                                    <span> Project.zip </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ====== Blog Section End -->

    <!-- ====== Back To Top Start -->
    <a
        href="javascript:void(0)"
        class="
        ud-hidden
        ud-items-center
        ud-justify-center
        ud-bg-primary
        ud-text-white
        ud-w-10
        ud-h-10
        ud-rounded-sm
        ud-fixed
        ud-bottom-8
        ud-right-8
        ud-left-auto
        ud-z-[999]
        hover:ud-shadow-signUp
        ud-transition
        back-to-top
        ud-shadow-md
      "
    >
      <span
          class="
          ud-w-3
          ud-h-3
          ud-border-t
          ud-border-l
          ud-border-white
          ud-rotate-45
          ud-mt-[6px]
        "
      ></span>
    </a>
    <!-- ====== Back To Top End -->
</template>

<script>
import Prism from "prismjs"
import "prismjs/themes/prism.css"
import 'prismjs/components/prism-markup-templating'
import 'prismjs/components/prism-php'
import 'prismjs/components/prism-bash'
import 'prismjs/components/index'

export default {
        props: ['title', 'tags', 'main_image_url', 'images', 'description', 'website_url'],
        data() {
            return {
                view_modal: false
            }
        },
        mounted() {
            window.Prism = window.Prism || {};
            window.Prism.manual = true;
            Prism.highlightAll();
        },
        methods : {
            toggleModal()
            {
                this.view_modal = this.view_modal !== true;
            },
            turnOffModal() {
                this.view_modal = false;
            }
        }

    }
</script>

<style>
    .fade-enter-active,
    .fade-leave-active {
        transition: opacity 0.5s ease;
    }

    .fade-enter-from,
    .fade-leave-to {
        opacity: 0;
    }

    .container {
        position: relative;
    }

    .overlay {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        height: 100%;
        width: 100%;
        opacity: 0;
        transition: .5s ease-in-out;
        background-color: #FFFFFF;
    }

    .container:hover .overlay {
        opacity: 1;
    }

    .text {
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        text-align: center;
    }
</style>
