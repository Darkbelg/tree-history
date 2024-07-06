<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Branch from './Branch.vue';

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
            <!-- <div class="bg-yellow-500" v-for="message in messages">
                <div class="bg-green-500" v-for="branch in message">
                    {{ branch.content }}
                </div>
            </div> -->
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <ul>
                        <Branch :messages="messages"></Branch>
                    </ul>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
