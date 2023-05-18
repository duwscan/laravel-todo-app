<template>
    <main style="min-height: 50vh; margin-top: 2rem;">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <!-- Add new Task -->
                    <div class="relative">
                        <input type="text" class="form-control form-control-lg padding-right-lg"
                               placeholder="+ Add new task. Press enter to save."/>
                    </div>
                    <!-- List of uncompleted tasks -->
                    <Tasks :tasks="uncompletedTasks"/>
                    <!--                    show toggle button-->
                    <div class="text-center my-3" v-show="showToggleCompletedBtn">
                        <button class="btn btn-sm btn-secondary"
                                @click="$event =>showCompletedTasks = !showCompletedTasks">
                            <span v-if="!showCompletedTasks">
                                    Show completed
                            </span>
                            <span v-else>
                                Hide completed
                            </span>
                        </button>
                    </div>
                    <!--                    list completed tasks-->
                    <Tasks :tasks="completedTasks" :show="completedTasksIsVisible && showCompletedTasks"/>
                </div>
            </div>
        </div>
    </main>
</template>
<script setup>
import {computed, onMounted, ref} from "vue";
import {allTasks} from "@/http/task-api"
import Tasks from "../components/tasks/Tasks.vue"

const tasks = ref([])
onMounted(async () => {
    const {data} = await allTasks();
    tasks.value = data.data;
})

const uncompletedTasks = computed(() => tasks.value.filter(task => !task.is_completed));
const completedTasks = computed(() => tasks.value.filter(task => task.is_completed));
const showToggleCompletedBtn = computed(() => uncompletedTasks.value.length > 0 && completedTasks.value.length > 0);
const completedTasksIsVisible = computed(() => uncompletedTasks.value.length === 0 || completedTasks.value.length > 0);
const showCompletedTasks = ref(false);
</script>
<style>
.form-check-input.completed {
    filter: none;
    opacity: 0.5;
}

.completed {
    color: #9ca3af;
    text-decoration: line-through;
}

.task-date {
    color: #6b7280;
    font-size: 11px;
    padding: 0 2px;
}

.editable-task {
    width: 100%;
    background-color: transparent;
    border: 0;
    /* outline: 0; */
    padding: 0;
    margin: 0;
}

.editable-task:focus {
    outline: none !important;
}

.edit-item input[type="text"] {
    color: #999;
}

.list-group-item:hover .task-actions {
    visibility: visible;
    opacity: 1;
}

.task-actions {
    position: absolute;
    top: 50%;
    right: 130px;
    transform: translateY(-50%);
    visibility: hidden;
    opacity: 0;
    transition: visibility 0.2s, opacity 0.3s linear;
}

.btn-circle {
    width: 30px;
    height: 30px;
    padding: 6px 0px;
    border-radius: 15px;
    text-align: center;
    font-size: 10px;
    line-height: 1.42857;
}
</style>
