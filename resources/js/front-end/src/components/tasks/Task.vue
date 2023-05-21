<template>
    <li class="list-group-item py-3">
        <div class="d-flex justify-content-start align-items-center">
            <input class="form-check-input mt-0" :class="completedClass" type="checkbox" :checked="task.is_completed"/>
            <div class="ms-2 flex-grow-1" :class="completedClass" title="Double click the text to edit or remove"
                 @dblclick="onEdit">
                <div class="relative" v-if="isEdit">
                    <input class="editable-task" type="text" ref="editRef" @blur="updateTask"
                           @keyup.enter="updateTask"/>
                </div>
                <span v-else>{{ task.name }}</span>
            </div>
            <!--                                    <div class="task-date">24 Feb 12:00</div>-->
        </div>
        <TasksActions @edit="onEdit"/>
    </li>
</template>

<script setup>
import {computed, ref, nextTick, onMounted, watch} from "vue";
import TasksActions from "./TasksActions.vue";

const props = defineProps({
    task: Object
})
const editRef = ref(null);
const completedClass = computed(() => props.task.is_completed ? "completed" : "")
const isEdit = ref(false);
const emit = defineEmits(['updated'])
const onEdit = () => {
    isEdit.value = true;
    //ensure the input element is rendered before focusing it
    nextTick(() => {
        if (editRef.value) {
            editRef.value.focus();
        }
    });
}
const updateTask = (event) => {
    if (event.target.value) {
        const updatedTask = {...props.task, name: event.target.value}
        emit('updated', updatedTask);
    }
    isEdit.value = false
}
</script>
