<script setup>
import { ref } from 'vue';

const leafPosition = ref(0);

defineProps({ messages: Object });


function next(){
    leafPosition.value ++ ;
}

function previous(){
    if(leafPosition.value > 0){
        leafPosition.value --;
    }
}

</script>

<template>
    <!-- <li v-for="message in messages">
        <p class="m-3 bg-red-500"> {{ message.id }} </p>
        <Branch :messages="message.branches"></Branch>
    </li> -->

    <li v-if="messages[leafPosition]">
        <button v-if="leafPosition > 0" @click="previous">Prev</button>
        <br/>
        <br/>
        <p>{{ leafPosition }}</p>
        <br/>
        <br/>
        <button  @click="next">Next</button>
        <p class="m-3 bg-red-500"> {{ messages[leafPosition].id }} </p>
        <Branch :messages="messages[leafPosition].branches"></Branch>
    </li>
</template>
