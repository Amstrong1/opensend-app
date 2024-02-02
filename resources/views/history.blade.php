<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 m-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg mx-4 text-center">
            <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
            <!--Tabs navigation-->
            <ul class="mb-5 flex list-none flex-row flex-wrap border-b-0 pl-0" role="tablist" data-te-nav-ref>
                <li role="presentation" class="flex-auto text-center">
                    <a href="#tabs-cashin"
                        class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-4 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400"
                        data-te-toggle="pill" data-te-target="#tabs-cashin" data-te-nav-active role="tab"
                        aria-controls="tabs-cashin" aria-selected="true">{{ __('message.hRecharge') }}</a>
                </li>
                <li role="presentation" class="flex-auto text-center">
                    <a href="#tabs-transfert"
                        class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-4 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400"
                        data-te-toggle="pill" data-te-target="#tabs-transfert" role="tab"
                        aria-controls="tabs-transfert" aria-selected="false">{{ __('message.hTransfert') }}</a>
                </li>
                <li role="presentation" class="flex-auto text-center">
                    <a href="#tabs-cashout"
                        class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-4 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400"
                        data-te-toggle="pill" data-te-target="#tabs-cashout" role="tab"
                        aria-controls="tabs-cashout" aria-selected="false">{{ __('message.hRetrait') }}</a>
                </li>
            </ul>

            <!--Tabs content-->
            <div class="mb-6">
                <div class="hidden opacity-100 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
                    id="tabs-cashin" role="tabpanel" aria-labelledby="tabs-home-tab01" data-te-tab-active>
                    @include('partials.recharge')
                </div>
                <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
                    id="tabs-transfert" role="tabpanel" aria-labelledby="tabs-profile-tab01">
                    @include('partials.transfert')
                </div>
                <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
                    id="tabs-cashout" role="tabpanel" aria-labelledby="tabs-profile-tab01">
                    @include('partials.retrait')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
