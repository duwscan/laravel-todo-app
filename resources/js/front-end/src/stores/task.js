import {defineStore} from "pinia"
import {allTasks} from "../http/task-api";
import {computed, reactive, ref} from "vue";

const tmp = {
    state: () => ({
        tasks: [],
    }),
    getters: {
        completedTasks: (state) => state.tasks.filter((task) => task.is_completed),
        uncompletedTasks: (state) => state.tasks.filter((task) => !task.is_completed)
    },
    actions: {
        async fetchAllTasks() {
            const {data} = await allTasks();
            this.tasks = data.data;
        }
    }
}
export const useTaskStore = defineStore('taskStore', () => {
    const tasks = ref([]);
    const task = reactive({
        id: null,
        name: null,
        is_completed: false,
    })

    const uncompletedTasks = computed(() =>
        tasks.value.filter((task) => !task.is_completed)
    );

    const completedTasks = computed(() =>
        tasks.value.filter((task) => task.is_completed)
    );
})
