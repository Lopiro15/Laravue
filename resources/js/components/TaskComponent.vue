<template>
    <div class="container">

        <add-task @Task-added="refresh"></add-task>
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center" v-for="task in tasks.data" :key="task.id">
                <a href="#">{{ task.name }}</a>
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#EditModal" @click="getTask(task.id)">
                    <i class="bi bi-pencil-fill mr-2" style="color: white;"></i>Editer
                </button>
            </li>
            <edit-task v-bind:taskToEdit = 'tasktoedit'></edit-task>
        </ul>
        <pagination :data="tasks" @pagination-change-page="getResults" class="mt-5"></pagination>
    </div>
</template>

<script>
import AddTaskComponent from './AddTaskComponent.vue';
import EditTaskComponent from './EditTaskComponent.vue';
    export default {
  components: { AddTaskComponent, EditTaskComponent },

        data() {
            return {
                tasks: {},
                tasktoedit: ''
            }
        },
        created() {
            axios.get('http://127.0.0.1:8000/taskslist')
                .then(response => this.tasks = response.data)
                .catch(error => console.log(error));
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
		// Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
                axios.get('http://127.0.0.1:8000/taskslist?page=' + page)
                    .then(response => {
                        this.tasks = response.data;
                    });
            },
            getTask(id) {
                axios.get('http://127.0.0.1:8000/task/edit/' + id)
                    .then(response => this.tasktoedit = response.data.name)
                    .catch(error => console.log(error));
            },
            refresh(tasks) {
                this.tasks = tasks.data;
            }
        }
    }
</script>
