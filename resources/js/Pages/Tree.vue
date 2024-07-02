<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
defineProps({ messages: Object })
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                History
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <ol v-for="message in messages">
                       <li class="m-3"> {{ message }} </li>
                    </ol>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
