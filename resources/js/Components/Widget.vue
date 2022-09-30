<script setup>
defineProps(["title","value","icon","percentage","color"])
</script>
<template>
    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
        <div class="report-box zoom-in">
            <div class="box p-5">
                <div class="flex">
                    <i data-feather="shopping-cart" class="report-box__icon text-primary"></i>
                    <div class="ml-auto">
                        <div :class="color" class="report-box__indicator bg-success tooltip cursor-pointer" title="33% Higher than last month"> {{percentage}}% <i data-feather="chevron-up" class="w-4 h-4 ml-0.5"></i> </div>
                    </div>
                </div>
                <div class="text-3xl font-medium leading-8 mt-6">{{value}}</div>
                <div class="text-base text-slate-500 mt-1">{{title}}</div>
            </div>
        </div>
    </div>
</template>
