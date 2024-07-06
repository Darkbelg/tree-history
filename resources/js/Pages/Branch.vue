<script setup>
import { ref } from 'vue';

const leafPosition = ref(0);

const props = defineProps({ messages: Object });


function next(){
    if(leafPosition.value < props.messages.length - 1) {
        leafPosition.value ++ ;
    }
}

function previous(){
    if(leafPosition.value >= 0){
        leafPosition.value --;
    }
}

</script>

<template>
    <li>
        <div>
            <button v-if="leafPosition > 0" @click="previous">Prev</button>
            <p>{{ leafPosition + 1 }} / {{ messages.length }}</p>
            <button v-if="leafPosition + 1 < messages.length" @click="next">Next</button>
        </div>
        <p class="m-3 bg-red-500"> {{ messages[leafPosition].id }} </p>
        <Branch v-if="messages[0].branches.length > 0" :messages="messages[leafPosition].branches"></Branch>
    </li>
</template>
