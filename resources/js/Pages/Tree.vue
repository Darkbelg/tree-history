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
                    <ol v-for="message in messages">
                        <li class="m-3">
                            <p class="bg-blue-500">{{ message.id }}</p>
                            <!-- <p v-for="branchMessages in message.branches">
                                {{ branchMessages.id }}
                            </p> -->
                            <!-- {{ message.branches }} -->
                            <Branch :messages="message.branches"></Branch>
                        </li>
                    </ol>
                    <!-- <ol> -->
                        <!-- <li class="m-3"> -->
                            <!-- <p class="bg-blue-500">{{ message.id }}</p> -->
                            <!-- <p v-for="branchMessages in message.branches">
                                {{ branchMessages.id }}
                            </p> -->
                            <!-- {{ message.branches }} -->
                            <!-- <Branch :messages="messages"></Branch> -->
                        <!-- </li> -->
                    <!-- </ol> -->
                </div>
            </div>
        </div>
    </AppLayout>
</template>
