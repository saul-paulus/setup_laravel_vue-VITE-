<template>
<PageComponent title="Dashboard">
    <div class="container">
        <div class=" flex align-baseline max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
          <svg class="w-[30px] h-[30px] text-blue-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3a2.5 2.5 0 1 1 2-4.5M19.5 17h.5c.6 0 1-.4 1-1a3 3 0 0 0-3-3h-1m0-3a2.5 2.5 0 1 0-2-4.5m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3c0 .6-.4 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
            </svg>
          <div class="ml-10">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Total Users</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">200</p>
          </div>
        </div>
    </div>
</PageComponent>
</template>

<script setup>
import PageComponent from "../../component/pageComponent.vue";
</script>
