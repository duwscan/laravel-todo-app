<template>
    <li class="list-group-item py-3">
        <div class="d-flex justify-content-start align-items-center">
            <input class="form-check-input mt-0"
                   type="checkbox"
                   :class="completedClass"
                   :checked="task.is_completed"
                   @change="markTaskAsComplete"
            />
            <div class="ms-2 flex-grow-1" :class="completedClass" title="Double click the text to edit or remove"
                 @dblclick="onEdit">
                <div class="relative" v-if="isEdit">
                    <input class="editable-task" type="text" ref="editRef" @blur="updateTask"
                           @keyup.enter="updateTask" v-model="editingTask"/>
                </div>
                <span v-else>{{ task.name }}</span>
            </div>
            <!--                                    <div class="task-date">24 Feb 12:00</div>-->
        </div>
        <TasksActions
            @edit="onEdit"
            @remove="removeTask"
        />
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
const emit = defineEmits(['updated', 'completed', 'removed'])
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
    if (event.target.value && event.target.value !== props.task.name) {
        const updatedTask = {...props.task, name: event.target.value}
        emit('updated', updatedTask);
    }
    isEdit.value = false
}
const editingTask = ref(props.task.name);

const markTaskAsComplete = (event) => {
    const updatedTask = {...props.task, is_completed: !props.task.is_completed}
    emit('completed', updatedTask);
}
const removeTask = () => {
    if (confirm("Are you sure to delete this task :" + props.task.name)) {
        emit('removed',props.task);
    }
}
</script>
