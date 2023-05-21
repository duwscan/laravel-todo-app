<template>
    <div class="card mt-2" v-if="tasks.length && show">
        <ul class="list-group list-group-flush">
            <Task v-for="task in tasks" :task="task" :key="task.id" @updated="$event => emit('updated',$event)"/>
        </ul>
    </div>
</template>
<script setup>
import Task from "./Task.vue";
import {watch} from "vue";

const props = defineProps({
        tasks: Array,
        show: {
            type: Boolean,
            default: true,
        }
    }
)
const emit = defineEmits(['updated']);
</script>
